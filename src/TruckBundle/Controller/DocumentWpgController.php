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
final class DocumentWpgController extends DocumentController
{

    /**
     * @Route("/{monitoringWpgId}/createAndSendWpg", requirements={"monitoringWpgId"="\d+"})
     */
    public function createAndSendWpgAction(int $monitoringWpgId): Response
    {
        $monitoringWpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringWpgId, Monitoring::$codeWpg);
        $homeDealer = $monitoringWpg->getHomeDealer();
        $accidentCase = $monitoringWpg->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase)) {
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $accidentCaseId
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringWpg->getOperator();
        $mainMail = $monitoringWpg->getContactMail();
        $optionalMails = self::getEmailsFromString($monitoringWpg->getOptionalMails());
        $outComment = $monitoringWpg->getOutComment();

        $messageWpg = $this->createMessageWpg(
            $accidentCaseId,
            $mainMail,
            $optionalMails,
            $vehicle,
            $homeDealer,
            $outComment,
            $operatorName,
            $accidentCase
        );
        if ($this->get('mailer')->send($messageWpg)) {
            $monitoringWpg->setIsDocumentSend(Monitoring::$documentSend);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('truck_operator_panel', [
            'caseId' => $accidentCaseId
        ]);
    }

    private function createMessageWpg(
        int $accidentCaseId,
        string $mainMail,
        array $optionalMails,
        Vehicle $vehicle,
        Dealer $homeDealer,
        ?string $outComment,
        string $operatorName,
        AccidentCase $accidentCase
    ): \Swift_Message
    {
        $message = \Swift_Message::newInstance();
        $companyLogoSrc = $message->embed(\Swift_Image::fromPath('images/companyLogo.png'));
        $message->setSubject('Case number ' . $accidentCaseId . ' - Payment Guarantee Withdrawal')
            ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
            ->setTo($mainMail)
            ->setCc($optionalMails)
            ->setBody(
                $this->renderView(
                    'TruckBundle:Document:create_and_send_wpg.html.twig', [
                        'accidentCaseId' => $accidentCaseId,
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
