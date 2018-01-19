<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringPgType;
use TruckBundle\Form\Monitoring\MonitoringPgEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringPgController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringPg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringPgAction(Request $req, $caseId) {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);
        $homeDealer = $case->getVehicle()->getDealer();
        if (!$this->checkIfDealerIsActive($homeDealer)) {
            return $this->redirectToRoute("truck_main_warninginformation", [
                        "message" => "Dealer is not active, can not confirm PG."
            ]);
        }        
        $contactMailForSendDocument = $homeDealer->getMainMail();
        $operatorName = $this->getOperatorName();

        $monitoringPg = new Monitoring();
        $monitoringPg->setAccidentCase($case)->setOperator($operatorName)
                ->setHomeDealer($homeDealer)->setCode("PG")->setAmount(2000)
                ->setCurrency("EUR")->setContactMail($contactMailForSendDocument);
        $form = $this->createForm(MonitoringPgType::class, $monitoringPg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringPg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringPg);
            $em->flush();

            return $this->redirectToRoute("truck_documentpg_createandsendpg", [
                        "monitoringPgId" => $monitoringPg->getId()
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
        $monitoringPg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "PG");
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
