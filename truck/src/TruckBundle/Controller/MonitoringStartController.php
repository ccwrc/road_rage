<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

// use TruckBundle\Form\Monitoring\MonitoringStartEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringStartController extends MonitoringController {

    /**
     * @Route("/{monitoringId}/editMonitoringStart", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStartAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStartEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
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
