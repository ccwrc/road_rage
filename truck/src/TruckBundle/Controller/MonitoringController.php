<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Monitoring;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller {

    /**
     * @Route("/showAllMonitoringsForCase/{caseId}", requirements={"caseId"="\d+"})
     */
    public function showAllMonitoringsForCaseAction($caseId) {
        $monitorings = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findMonitoringsByCaseId($caseId);

        return $this->render('TruckBundle:Monitoring:show_all_monitorings_for_case.html.twig', [
                    "monitorings" => $monitorings
        ]);
    }
    
    /**
     * @Route("/createMonitoring/{caseId}", requirements={"caseId"="\d+"})
     */
    public function createMonitoringAction(Request $req, $caseId) {
        // form !

        return $this->render('TruckBundle:Monitoring:create_monitoring.html.twig', [
                    "form" => $form->createView()
        ]);
    }

}
