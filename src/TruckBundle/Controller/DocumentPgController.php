<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\Vehicle;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
final class DocumentPgController extends DocumentController {

    /**
     * @Route("/{monitoringPgId}/createAndSendPg", requirements={"monitoringPgId"="\d+"})
     */
    public function createAndSendPgAction(int $monitoringPgId): Response
    {
        $monitoringPg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringPgId, Monitoring::$codePg);
        $homeDealer = $monitoringPg->getHomeDealer();
        $accidentCase = $monitoringPg->getAccidentCase();

        if (!$this->isCaseIsActive($accidentCase) || !$this->isDealerIsActive($homeDealer)) {
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $accidentCase->getId()
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringPg->getOperator();
        $mainMail = $monitoringPg->getContactMail();
        $optionalMails = self::getEmailsFromString($monitoringPg->getOptionalMails());
        $amount = $monitoringPg->getAmount();
        $currency = $monitoringPg->getCurrency();
        $outComment = $monitoringPg->getOutComment();

        $messagePg = $this->createMessagePg(
            $accidentCase->getId(),
            $amount,
            $currency,
            $mainMail,
            $optionalMails,
            $vehicle,
            $homeDealer,
            $outComment,
            $operatorName,
            $accidentCase
        );

        if ($this->get('mailer')->send($messagePg)) {
            $monitoringPg->setIsDocumentSend(Monitoring::$documentSend);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('truck_operator_panel', [
            'caseId' => $accidentCase->getId()
        ]);
    }

    private function createMessagePg(
        int $accidentCaseId,
        string $amount,
        string $currency,
        string $mainMail,
        array $optionalMails,
        Vehicle $vehicle,
        Dealer $homeDealer,
        string $outComment,
        string $operatorName,
        AccidentCase $accidentCase
    ): \Swift_Message
    {
        $message = \Swift_Message::newInstance();
        $companyLogoSrc = $message->embed(\Swift_Image::fromPath('images/companyLogo.png'));
        $message->setSubject('Case number ' . $accidentCaseId . ' - Payment Guarantee request: ' .
            $amount . ' ' . $currency)
            ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
            ->setTo($mainMail)
            ->setCc($optionalMails)
            ->setBody(
                $this->renderView(
                    'TruckBundle:Document:create_and_send_pg.html.twig', [
                        'accidentCaseId' => $accidentCaseId,
                        'amount' => $amount,
                        'currency' => $currency,
                        'vehicle' => $vehicle,
                        'homeDealer' => $homeDealer,
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
