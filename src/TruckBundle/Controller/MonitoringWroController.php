<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringWroType;
use TruckBundle\Form\Monitoring\MonitoringWroEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringWroController extends MonitoringController {

    /**
     * @Route("/{monitoringRoId}/createMonitoringWro", requirements={"monitoringRoId"="\d+"})
     */
    public function createMonitoringWroAction(Request $req, $monitoringRoId) {
        $monitoringRo = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringRoId, "RO");
        $case = $monitoringRo->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();
        $mailForDocument = $repairDealer->getMainMail();
        $stringWithOptionalMails = $monitoringRo->getOptionalMails();
        $amount = $monitoringRo->getAmount();
        $currency = $monitoringRo->getCurrency();

        $monitoringWro = new Monitoring();
        $monitoringWro->setAccidentCase($case)->setOperator($this->getOperatorName())->setHomeDealer($homeDealer)
                ->setCode("WRO")->setRepairDealer($repairDealer)->setContactMail($mailForDocument)
                ->setOptionalMails($stringWithOptionalMails)->setAmount($amount)->setCurrency($currency);
        $form = $this->createForm(MonitoringWroType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringWro = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWro);
            $em->flush();

            return $this->redirectToRoute("truck_documentwro_createandsendwro", [
                        "monitoringWroId" => $monitoringWro->getId()
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
        $monitoringWro = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "WRO");
        $caseId = $monitoringWro->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWroEditType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWro = $form->getData();
            $monitoringWro->setOperator($this->getOperatorName());
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