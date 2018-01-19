<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\AccidentCase; 
use TruckBundle\Entity\Dealer;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller {
    
    /**
     * @Route("/{caseId}/showAllMonitoringsForCase", requirements={"caseId"="\d+"})
     */
    public function showAllMonitoringsForCaseAction($caseId) {
        $this->throwExceptionIfCaseIdIsWrongExcludingZero($caseId);
        $monitorings = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findMonitoringsByCaseId($caseId);

        return $this->render('TruckBundle:Monitoring:show_all_monitorings_for_case.html.twig', [
                    "monitorings" => $monitorings
        ]);
    }

    /**
     * @Route("/monitoringCodesManual")
     */
    public function monitoringCodesManualAction() {

        return $this->render('TruckBundle:Monitoring:monitoring_codes_manual.html.twig');
    }    

    protected function getOperatorName() {
//        return $this->container->get("security.context")->getToken()->getUser()
//                ->getUsername();
        return $this->getUser()->getUsername();
    }

    protected function setColorProgressRedForCase(AccidentCase $case) {
        $case->setProgressColor("#FF7575");
    }

    protected function setColorProgressOrangeForCase(AccidentCase $case) {
        $case->setProgressColor("#FF9C42");
    }
    
    protected function setColorProgressGreenForCase(AccidentCase $case) {
        $case->setProgressColor("#93EEAA");
    }    

    protected function setColorProgressGreyForCase(AccidentCase $case) {
        $case->setProgressColor("#E6E6E6");
    }  
    
    // TODO to delete
    protected function throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, $code) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) { 
            throw $this->createNotFoundException("Wrong monitoring data");
        }
    }  
    
    protected function throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, $code) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) { 
            throw $this->createNotFoundException("Wrong monitoring data");
        }
        return $monitoring;
    }     
    
    protected function throwExceptionIfCaseIdIsWrongExcludingZero($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case === null && $caseId != 0) { //0 is default for operator panel
            throw $this->createNotFoundException("Wrong case ID");
        }
    }
    
    // TODO to delete
    protected function throwExceptionIfCaseIdIsWrong($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case === null) {
            throw $this->createNotFoundException("Wrong case ID");
        }
    }
    
    protected function throwExceptionIfWrongIdOrGetCaseBy($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case === null) {
            throw $this->createNotFoundException("Wrong case ID");
        }
        return $case;
    }    
    
    protected function throwExceptionIfDealerIsNotActive(Dealer $dealer) {
        if ($dealer->getIsActive() !== "active") {
            throw $this->createNotFoundException("Dealer is not active!");
        }
    }

    protected function checkIfDealerIsActive(Dealer $dealer) {
        if($dealer->getIsActive() === "active") {
            return true;
        }
        return false;
    }

}
