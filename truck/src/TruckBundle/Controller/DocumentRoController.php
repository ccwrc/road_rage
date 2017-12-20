<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentRoController extends DocumentController {

    /**
     * @Route("/{monitoringRoId}/createAndSendRo", requirements={"monitoringRoId"="\d+"})
     */
    public function createAndSendRoAction($monitoringRoId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringRoId, "RO");

        $monitoringRo = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringRoId);
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();
        $accidentCase = $monitoringRo->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase) || !$this->isDealerIsActive($homeDealer) 
                || !$this->isDealerIsActive($repairDealer)) {
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $accidentCaseId
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringRo->getOperator();
        $mainMail = $monitoringRo->getContactMail();
        $optionalMails = $this->getEmailsFromString($monitoringRo->getOptionalMails());
        $amount = $monitoringRo->getAmount();
        $currency = $monitoringRo->getCurrency();
        $outComment = $monitoringRo->getOutComment();

        $messageRo = $this->createMessageRo($accidentCaseId, $amount, $currency, $mainMail, 
                $optionalMails, $vehicle, $homeDealer, $repairDealer, $outComment, $operatorName, 
                $accidentCase);
        if ($this->get('mailer')->send($messageRo)) {
            $monitoringRo->setIsDocumentSend(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute("truck_operator_panel", [
                    "caseId" => $accidentCaseId
        ]);
    }

    private function createMessageRo($accidentCaseId, $amount, $currency, $mainMail, $optionalMails,
            $vehicle, $homeDealer, $repairDealer, $outComment, $operatorName, $accidentCase) {
        $message = \Swift_Message::newInstance()
                ->setSubject("Case number " . $accidentCaseId . " - Repair Order: " .
                        $amount . " " . $currency)
                ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
                ->setTo($mainMail)
                ->setCc($optionalMails)
                ->attach(\Swift_Attachment::fromPath('images/companyLogo.png'))
                ->setBody(
                $this->renderView(
                        'TruckBundle:Document:create_and_send_ro.html.twig', [
                    "accidentCaseId" => $accidentCaseId,
                    "amount" => $amount,
                    "currency" => $currency,
                    "vehicle" => $vehicle,
                    "homeDealer" => $homeDealer,
                    "repairDealer" => $repairDealer,
                    "outComment" => $outComment,
                    "operatorName" => $operatorName,
                    "accidentCase" => $accidentCase
                        ]
                ), 'text/html'
        );
        return $message;
    }

}
