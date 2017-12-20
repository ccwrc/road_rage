<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\AccidentCase;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentController extends Controller {

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

    /**
     * @Route("/createAndSendWro")
     */
    public function createAndSendWroAction() {
        return $this->render('TruckBundle:Document:create_and_send_wro.html.twig', array(
                        // ...
        ));
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

    protected function isDealerIsActive(Dealer $dealer) {
        if ($dealer->getIsActive() === "active") {
            return true;
        }
        return false;
    }

    protected function isCaseIsActive(AccidentCase $case) {
        if ($case->getStatus() === "active") {
            return true;
        }
        return false;
    }
    
    protected function throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, $code) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) {
            throw $this->createNotFoundException("Wrong monitoring data");
        }
    }
    
    protected function getEmailsFromString($string) {
        $unverifiedEmails = [];
        $emails = [];
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $unverifiedEmails);

        $counter = count($unverifiedEmails[0]);
        for ($i = 0; $i < $counter; $i++) {
            if (filter_var($unverifiedEmails[0][$i], FILTER_VALIDATE_EMAIL)) {
                $emails[] = $unverifiedEmails[0][$i];
            }
        }
        return $emails;
    }    

}
