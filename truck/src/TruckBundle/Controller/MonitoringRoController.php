<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringRoType;
use TruckBundle\Form\Monitoring\MonitoringRoEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringRoController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringRo", requirements={"caseId"="\d+"})
     */
    public function createMonitoringRoAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();
// TODO get last CPG from case -> get amount + currency to RO
        $monitoringRo = new Monitoring();
        $monitoringRo->setAccidentCase($case)->setOperator($operatorName)->setAmount(2000)
                ->setCurrency("EUR")->setHomeDealer($homeDealer)->setCode("RO");
        $form = $this->createForm(MonitoringRoType::class, $monitoringRo);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringRo = $form->getData();
            $this->throwExceptionIfDealerIsNotActive($monitoringRo->getRepairDealer());
            $this->setColorProgressOrangeForCase($case);
            $contactMailForDocument = $monitoringRo->getRepairDealer()->getMainMail();
            $monitoringRo->setContactMail($contactMailForDocument);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringRo);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_ro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringRo", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringRoAction(Request $req, $monitoringId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, "RO");
        $monitoringRo = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringRo->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringRoEditType::class, $monitoringRo);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringRo = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoringRo->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_ro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
