<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringWroType;
use TruckBundle\Form\Monitoring\MonitoringWroEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringWroController extends MonitoringController {

    /**
     * @Route("/{monitoringRoId}/createMonitoringWro", requirements={"monitoringRoId"="\d+"})
     */
    public function createMonitoringWroAction(Request $req, $monitoringRoId) {
        $operatorName = $this->getOperatorName();
        $monitoringRo = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringRoId);
        $case = $monitoringRo->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();

        $monitoringWro = new Monitoring();
        $monitoringWro->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("WRO")->setRepairDealer($repairDealer);
        $form = $this->createForm(MonitoringWroType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringWro = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWro);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringWro", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWroAction(Request $req, $monitoringId) {
        $monitoringWro = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringWro->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWroEditType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWro = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
