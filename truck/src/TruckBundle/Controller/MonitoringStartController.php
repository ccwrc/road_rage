<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Form\Monitoring\MonitoringStartEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringStartController extends MonitoringController {
    
    /* START: START new case (automatic code) 
       created automatically when the case starts in AccidentCaseController
       look -> createCaseAction */

    /**
     * @Route("/{monitoringId}/editMonitoringStart", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStartAction(Request $req, $monitoringId) {
        $monitoringStart = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "START");
        $caseId = $monitoringStart->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStartEditType::class, $monitoringStart);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringStart = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_start.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
