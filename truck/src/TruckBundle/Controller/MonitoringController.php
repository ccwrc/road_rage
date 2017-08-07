<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\AccidentCase;
use TruckBundle\Form\Monitoring\MonitoringType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller {

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

        return $this->render('TruckBundle:Monitoring:monitoring_codes_manual.html.twig', [
                        //...
        ]);
    }

    /**
     * @Route("/{caseId}/createMonitoring", requirements={"caseId"="\d+"})
     */
    public function createMonitoringAction(Request $req, $caseId) {
        // only for tests (testCode)
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case);
        $monitoring->setOperator($operatorName);
        $form = $this->createForm(MonitoringType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring.html.twig', [
                    "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/{caseId}/createMonitoringPg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringPgAction(Request $req, $caseId) {
        //
        
        return $this->render('TruckBundle:Monitoring:create_monitoring_pg.html.twig', [
                    "form" => $form->createView()
        ]);        
    }

}
