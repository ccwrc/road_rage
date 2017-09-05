<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// use Symfony\Component\HttpFoundation\Request; // to delete after refactor

//use TruckBundle\Entity\Monitoring;
//use TruckBundle\Entity\AccidentCase; // to delete after refactor
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

    protected function setColorProgressRedForCase($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $case->setProgress("#FF7575");
    }

    protected function setColorProgressOrangeForCase($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $case->setProgress("#FF9C42");
    }
    
    protected function setColorProgressGreenForCase($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $case->setProgress("#93EEAA");
    }    

    protected function setColorProgressGreyForCase($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $case->setProgress("#E6E6E6");
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
