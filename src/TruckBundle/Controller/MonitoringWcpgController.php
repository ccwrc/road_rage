<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringWcpgType;
use TruckBundle\Form\Monitoring\MonitoringWcpgEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringWcpgController extends MonitoringController {

    /**
     * @Route("/{monitoringCpgId}/createMonitoringWcpg", requirements={"monitoringCpgId"="\d+"})
     */
    public function createMonitoringWcpgAction(Request $req, $monitoringCpgId) {
        $monitoringCpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringCpgId, "CPG");
        $case = $monitoringCpg->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringCpg->getHomeDealer();
        $amount = $monitoringCpg->getAmount();
        $currency = $monitoringCpg->getCurrency();

        $monitoringWcpg = new Monitoring();
        $monitoringWcpg->setAccidentCase($case)->setOperator($this->getOperatorName())
                ->setHomeDealer($homeDealer)->setCode("WCPG")->setAmount($amount)
                ->setCurrency($currency);
        $form = $this->createForm(MonitoringWcpgType::class, $monitoringWcpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringWcpg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWcpg);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wcpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringWcpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWcpgAction(Request $req, $monitoringId) {
        $monitoringWcpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "WCPG");
        $caseId = $monitoringWcpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWcpgEditType::class, $monitoringWcpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWcpg = $form->getData();
            $monitoringWcpg->setOperator($this->getOperatorName());
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wcpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}