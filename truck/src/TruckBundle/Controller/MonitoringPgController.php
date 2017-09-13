<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringPgType;
use TruckBundle\Form\Monitoring\MonitoringPgEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringPgController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringPg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringPgAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        $monitoringPg = new Monitoring();
        $monitoringPg->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("PG");
        $form = $this->createForm(MonitoringPgType::class, $monitoringPg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringPg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringPg);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_pg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringPg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringPgAction(Request $req, $monitoringId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, "PG");
        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringPg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringPgEditType::class, $monitoringPg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringPg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_pg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
