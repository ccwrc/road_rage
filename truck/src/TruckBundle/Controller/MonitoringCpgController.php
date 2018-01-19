<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringCpgType;
use TruckBundle\Form\Monitoring\MonitoringCpgEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringCpgController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringCpg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringCpgAction(Request $req, $caseId) {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);
        $homeDealer = $case->getVehicle()->getDealer();
        
        if (!$this->checkIfDealerIsActive($homeDealer)) {
            return $this->redirectToRoute("truck_main_warninginformation", [
                        "message" => "Dealer is not active, can not confirm PG."
            ]);
        }

        $monitoringCpg = new Monitoring();
        $operatorName = $this->getOperatorName();
        $amount = $this->getAmountFromLastPgOrReturnZero($caseId);
        $currency = $this->getCurrencyFromLastPgOrReturnEur($caseId);
        $monitoringCpg->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setCode("CPG")->setAmount($amount)->setCurrency($currency);
        $form = $this->createForm(MonitoringCpgType::class, $monitoringCpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringCpg = $form->getData();
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
        $monitoringCpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "CPG");
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
    
    private function getAmountFromLastPgOrReturnZero($caseId) {
        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringPgByCaseId($caseId);
        if($monitoringPg !== null) {
            return $monitoringPg->getAmount();
        }
        return 0;
    }
    
    private function getCurrencyFromLastPgOrReturnEur($caseId) {
        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringPgByCaseId($caseId);
        if($monitoringPg !== null) {
            return $monitoringPg->getCurrency();
        }
        return "EUR";
    }    

}
