<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// use Symfony\Component\HttpFoundation\Request; // to delete after refactor

//use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\AccidentCase; 
//use \DateTime;  // to delete after refactor

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller {

    //TODO redirectIfMonitoringHasWrongCodeOrCaseId

    protected function getOperatorName() {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        return $operatorName;
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
   
    /**
     * @Route("/{caseId}/showAllMonitoringsForCase", requirements={"caseId"="\d+"})
     */
    public function showAllMonitoringsForCaseAction($caseId) {
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

}
