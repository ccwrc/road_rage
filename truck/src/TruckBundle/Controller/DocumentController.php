<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Dealer;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentController extends Controller {

    /**
     * @Route("/{monitoringPgId}/createAndSendPg", requirements={"monitoringPgId"="\d+"})
     */
    public function createAndSendPgAction($monitoringPgId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringPgId, "PG");

        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringPgId);
        $homeDealer = $monitoringPg->getHomeDealer();
        $accidentCase = $monitoringPg->getAccidentCase();
        
        // if dealer or case is not active -> redirect
        
        $accidentCaseId = $accidentCase->getId(); // for title
        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringPg->getOperator();
        $mainMail = $monitoringPg->getContactMail();
        $optionalMails = $this->getEmailsFromString($monitoringPg->getOptionalMails());

        $messagePg = $this->createMessagePg($vehicle);
        if ($this->get('mailer')->send($messagePg)) {
            $monitoringPg->setIsDocumentSend(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }



        return $this->redirectToRoute("truck_operator_panel", [
                    "caseId" => $accidentCaseId
        ]);
    }

    /**
     * @Route("/createAndSendRo")
     */
    public function createAndSendRoAction() {
        return $this->render('TruckBundle:Document:create_and_send_ro.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/createAndSendWpg")
     */
    public function createAndSendWpgAction() {
        return $this->render('TruckBundle:Document:create_and_send_wpg.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/createAndSendWro")
     */
    public function createAndSendWroAction() {
        return $this->render('TruckBundle:Document:create_and_send_wro.html.twig', array(
                        // ...
        ));
    }
    
    private function throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, $code) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) {
            throw $this->createNotFoundException("Wrong monitoring data");
        }
    }
    
    // https://swiftmailer.symfony.com/docs/messages.html
    // If you want to include multiple addresses then you must use an array:
    // $message->setTo(['some@address.tld', 'other@address.tld']);
    private function getEmailsFromString($string) {
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
    
    private function createMessagePg($vehicle) {
        $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('ccwrcltd@bla.com')
                ->setBody(
                $this->renderView(
                        'TruckBundle:Document:create_and_send_pg.html.twig', [
                    "vehicle" => $vehicle
                        ]
                ), 'text/html'
        );
        return $message;
    }

    private function isDealerIsActive(Dealer $dealer) {
        if ($dealer->getIsActive === "active") {
            return true;
        }
        return false;
    }
    
    private function isCaseIsActive($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        if ($case->getStatus === "active") {
            return true;
        }
        return false;
    }    

}
