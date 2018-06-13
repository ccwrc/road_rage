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
    
    protected function throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, $code) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) {
            throw $this->createNotFoundException("Wrong monitoring data");
        }
        return $monitoring;
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
