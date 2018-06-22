<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringCpgType, MonitoringCpgEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringCpgController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringCpg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringCpgAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        if (!$this->checkIfDealerIsActive($homeDealer)) {
            return $this->redirectToRoute('truck_main_warninginformation', [
                'message' => 'Dealer is not active, can not confirm PG.'
            ]);
        }

        $monitoringCpg = new Monitoring();
        $amount = $this->getAmountFromLastPgOrReturnZero($caseId);
        $currency = $this->getCurrencyFromLastPgOrReturnEur($caseId);
        $monitoringCpg->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codeCpg)
            ->setAmount($amount)
            ->setCurrency($currency);
        $form = $this->createForm(MonitoringCpgType::class, $monitoringCpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringCpg);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_cpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringCpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringCpgAction(Request $req, int $monitoringId): Response
    {
        $monitoringCpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeCpg);
        $caseId = $monitoringCpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringCpgEditType::class, $monitoringCpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringCpg->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_cpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    private function getAmountFromLastPgOrReturnZero(int $caseId): int
    {
        $monitoringPg = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->findLastMonitoringPgByCaseId($caseId);
        if ($monitoringPg !== null) {
            return $monitoringPg->getAmount();
        }
        return 0;
    }

    private function getCurrencyFromLastPgOrReturnEur(int $caseId): string
    {
        $monitoringPg = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->findLastMonitoringPgByCaseId($caseId);
        if ($monitoringPg !== null) {
            return $monitoringPg->getCurrency();
        }
        return Monitoring::$currencyEur;
    }

}
