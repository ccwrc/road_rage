<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringStrrType;
use TruckBundle\Form\Monitoring\MonitoringStrrEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringStrrController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringStrr", requirements={"caseId"="\d+"})
     */
    public function createMonitoringStrrAction(Request $req, $caseId) {
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoringStrr = new Monitoring();
        $monitoringStrr->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("STRR")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringStrrType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressGreenForCase($case);
            $monitoringStrr = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringStrr);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_strr.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringStrr", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStrrAction(Request $req, $monitoringId) {
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringStrr->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStrrEditType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringStrr = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoringStrr->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_strr.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
