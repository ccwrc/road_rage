<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringEtaType;
use TruckBundle\Form\Monitoring\MonitoringEtaEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringEtaController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringEta", requirements={"caseId"="\d+"})
     */
    public function createMonitoringEtaAction(Request $req, $caseId) {
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("ETA")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringEtaType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:create_monitoring_eta.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringEta", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringEtaAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringEtaEditType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:edit_monitoring_eta.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}