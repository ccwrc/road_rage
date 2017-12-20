<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentWpgController extends DocumentController {

    /**
     * @Route("/{monitoringWpgId}/createAndSendWpg", requirements={"monitoringWpgId"="\d+"})
     */
    public function createAndSendWpgAction($monitoringWpgId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringWpgId, "WPG");

        $monitoringWpg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringWpgId);
        $homeDealer = $monitoringWpg->getHomeDealer();
        $accidentCase = $monitoringWpg->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase)) {
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $accidentCaseId
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringWpg->getOperator();
        $mainMail = $monitoringWpg->getContactMail();
        $optionalMails = $this->getEmailsFromString($monitoringWpg->getOptionalMails());
        $outComment = $monitoringWpg->getOutComment();

        $messageWpg = $this->createMessageWpg($accidentCaseId, $mainMail, $optionalMails, $vehicle, 
                $homeDealer, $outComment, $operatorName, $accidentCase);
        if ($this->get('mailer')->send($messageWpg)) {
            $monitoringWpg->setIsDocumentSend(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute("truck_operator_panel", [
                    "caseId" => $accidentCaseId
        ]);
    }

    private function createMessageWpg($accidentCaseId, $mainMail, $optionalMails, $vehicle, 
            $homeDealer, $outComment, $operatorName, $accidentCase) {
        $message = \Swift_Message::newInstance()
                ->setSubject("Case number " . $accidentCaseId . " - Payment Guarantee Withdrawal")
                ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
                ->setTo($mainMail)
                ->setCc($optionalMails)
                ->attach(\Swift_Attachment::fromPath('images/companyLogo.png'))
                ->setBody(
                $this->renderView(
                        'TruckBundle:Document:create_and_send_wpg.html.twig', [
                    "accidentCaseId" => $accidentCaseId,
                    "vehicle" => $vehicle,
                    "homeDealer" => $homeDealer,
                    "outComment" => $outComment,
                    "operatorName" => $operatorName,
                    "accidentCase" => $accidentCase
                        ]
                ), 'text/html'
        );
        return $message;
    }

}
