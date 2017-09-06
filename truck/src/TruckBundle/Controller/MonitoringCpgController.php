<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringCpgType;
use TruckBundle\Form\Monitoring\MonitoringCpgEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringCpgController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringCpg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringCpgAction(Request $req, $caseId) {
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        $monitoringCpg = new Monitoring();
        $monitoringCpg->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("CPG");
        $form = $this->createForm(MonitoringCpgType::class, $monitoringCpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringCpg = $form->getData();
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringCpg);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_cpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringCpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringCpgAction(Request $req, $monitoringId) {
        $monitoringCpg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringCpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringCpgEditType::class, $monitoringCpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringCpg = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoringCpg->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_cpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
