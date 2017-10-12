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
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringRoId, "RO");
        $operatorName = $this->getOperatorName();
        $monitoringRo = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringRoId);
        $case = $monitoringRo->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();
        $mailForDocument = $repairDealer->getMainMail();
        $stringWithOptionalMails = $monitoringRo->getOptionalMails();

        $monitoringWro = new Monitoring();
        $monitoringWro->setAccidentCase($case)->setOperator($operatorName)
                ->setHomeDealer($homeDealer)->setCode("WRO")->setRepairDealer($repairDealer)
                ->setContactMail($mailForDocument)->setOptionalMails($stringWithOptionalMails);
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
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, "WRO");
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
