<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringRoType, MonitoringRoEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringRoController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringRo", requirements={"caseId"="\d+"})
     */
    public function createMonitoringRoAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);
        $homeDealer = $case->getVehicle()->getDealer();
        $amount = $this->getAmountFromLastCpgOrReturnZero($caseId);
        $currency = $this->getCurrencyFromLastCpgOrReturnEur($caseId);

        $monitoringRo = new Monitoring();
        $monitoringRo->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setAmount($amount)
            ->setCurrency($currency)
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codeRo);
        $form = $this->createForm(MonitoringRoType::class, $monitoringRo);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->throwExceptionIfDealerIsNotActive($monitoringRo->getRepairDealer());
            $this->setColorProgressOrangeForCase($case);
            $monitoringRo->setContactMail($monitoringRo->getRepairDealer()->getMainMail());
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringRo);
            $em->flush();

            return $this->redirectToRoute('truck_documentro_createandsendro', [
                'monitoringRoId' => $monitoringRo->getId()
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_ro.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringRo", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringRoAction(Request $req, int $monitoringId): Response
    {
        $monitoringRo = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeRo);
        $caseId = $monitoringRo->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringRoEditType::class, $monitoringRo);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringRo->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_ro.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    private function getAmountFromLastCpgOrReturnZero(int $caseId): int
    {
        $monitoringCpg = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->findLastMonitoringCpgByCaseId($caseId);
        if ($monitoringCpg !== null) {
            return $monitoringCpg->getAmount();
        }
        return 0;
    }

    private function getCurrencyFromLastCpgOrReturnEur(int $caseId): string
    {
        $monitoringCpg = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->findLastMonitoringCpgByCaseId($caseId);
        if ($monitoringCpg !== null) {
            return $monitoringCpg->getCurrency();
        }
        return Monitoring::$currencyEur;
    }
}
