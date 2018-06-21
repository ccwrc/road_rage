<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\{
    AccidentCase, Dealer, Monitoring, Vehicle
};

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
final class DocumentRoController extends DocumentController
{

    /**
     * @Route("/{monitoringRoId}/createAndSendRo", requirements={"monitoringRoId"="\d+"})
     */
    public function createAndSendRoAction(int $monitoringRoId): Response
    {
        $monitoringRo = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringRoId, Monitoring::$codeRo);
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();
        $accidentCase = $monitoringRo->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase) || !$this->isDealerIsActive($homeDealer)
            || !$this->isDealerIsActive($repairDealer)) {
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $accidentCaseId
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringRo->getOperator();
        $mainMail = $monitoringRo->getContactMail();
        $optionalMails = self::getEmailsFromString($monitoringRo->getOptionalMails());
        $amount = (string)$monitoringRo->getAmount();
        $currency = $monitoringRo->getCurrency();
        $outComment = $monitoringRo->getOutComment();

        $messageRo = $this->createMessageRo(
            $accidentCaseId,
            $amount,
            $currency,
            $mainMail,
            $optionalMails,
            $vehicle,
            $homeDealer,
            $repairDealer,
            $outComment,
            $operatorName,
            $accidentCase
        );
        if ($this->get('mailer')->send($messageRo)) {
            $monitoringRo->setIsDocumentSend(Monitoring::$documentSend);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('truck_operator_panel', [
            'caseId' => $accidentCaseId
        ]);
    }

    private function createMessageRo(
        int $accidentCaseId,
        ?string $amount,
        string $currency,
        string $mainMail,
        array $optionalMails,
        Vehicle $vehicle,
        Dealer $homeDealer,
        Dealer $repairDealer,
        ?string $outComment,
        string $operatorName,
        AccidentCase $accidentCase
    ): \Swift_Message
    {
        $message = \Swift_Message::newInstance();
        $companyLogoSrc = $message->embed(\Swift_Image::fromPath('images/companyLogo.png'));
        $message->setSubject('Case number ' . $accidentCaseId . ' - Repair Order: ' .
            $amount . ' ' . $currency)
            ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
            ->setTo($mainMail)
            ->setCc($optionalMails)
            ->setBody(
                $this->renderView(
                    'TruckBundle:Document:create_and_send_ro.html.twig', [
                        'accidentCaseId' => $accidentCaseId,
                        'amount' => $amount,
                        'currency' => $currency,
                        'vehicle' => $vehicle,
                        'homeDealer' => $homeDealer,
                        'repairDealer' => $repairDealer,
                        'outComment' => $outComment,
                        'operatorName' => $operatorName,
                        'accidentCase' => $accidentCase,
                        'companyLogoSrc' => $companyLogoSrc
                    ]
                ), 'text/html'
            );
        return $message;
    }
}
