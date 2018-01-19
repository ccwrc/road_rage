<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentWroController extends DocumentController {

    /**
     * @Route("/{monitoringWroId}/createAndSendWro", requirements={"monitoringWroId"="\d+"})
     */
    public function createAndSendWroAction($monitoringWroId) {
        $monitoringWro = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringWroId, "WRO");
        $accidentCase = $monitoringWro->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase)) {
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $accidentCaseId
            ]);
        }
        
        $homeDealer = $monitoringWro->getHomeDealer();
        $repairDealer = $monitoringWro->getRepairDealer();
        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringWro->getOperator();
        $mainMail = $monitoringWro->getContactMail();
        $optionalMails = $this->getEmailsFromString($monitoringWro->getOptionalMails());
        $outComment = $monitoringWro->getOutComment();

        $messageWro = $this->createMessageWro($accidentCaseId, $mainMail, $optionalMails, $vehicle, 
                $homeDealer, $repairDealer, $outComment, $operatorName, $accidentCase);
        if ($this->get('mailer')->send($messageWro)) {
            $monitoringWro->setIsDocumentSend(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute("truck_operator_panel", [
                    "caseId" => $accidentCaseId
        ]);
    }

    private function createMessageWro($accidentCaseId, $mainMail, $optionalMails, $vehicle, 
            $homeDealer, $repairDealer, $outComment, $operatorName, $accidentCase) {
        $message = \Swift_Message::newInstance();
        $companyLogoSrc = $message->embed(\Swift_Image::fromPath('images/companyLogo.png'));
        $message->setSubject("Case number " . $accidentCaseId . " - Repair Order: Withdrawal")
                ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
                ->setTo($mainMail)
                ->setCc($optionalMails)
                ->setBody(
                        $this->renderView(
                                'TruckBundle:Document:create_and_send_wro.html.twig', [
                            "accidentCaseId" => $accidentCaseId,
                            "vehicle" => $vehicle,
                            "homeDealer" => $homeDealer,
                            "repairDealer" => $repairDealer,
                            "outComment" => $outComment,
                            "operatorName" => $operatorName,
                            "accidentCase" => $accidentCase,
                            "companyLogoSrc" => $companyLogoSrc
                                ]
                        ), 'text/html'
        );
        return $message;
    }

}
