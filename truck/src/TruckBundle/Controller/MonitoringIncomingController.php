<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringIncomingType;
use TruckBundle\Form\Monitoring\MonitoringIncomingEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringIncomingController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringIncoming", requirements={"caseId"="\d+"})
     */
    public function createMonitoringIncomingAction(Request $req, $caseId) {
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("Incoming");
        $form = $this->createForm(MonitoringIncomingType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:create_monitoring_incoming.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringIncomig", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringIncomingAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringIncomingEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoring->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_incoming.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}