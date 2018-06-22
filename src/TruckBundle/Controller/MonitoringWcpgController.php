<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringWcpgType, MonitoringWcpgEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringWcpgController extends MonitoringController
{

    /**
     * @Route("/{monitoringCpgId}/createMonitoringWcpg", requirements={"monitoringCpgId"="\d+"})
     */
    public function createMonitoringWcpgAction(Request $req, int $monitoringCpgId): Response
    {
        $monitoringCpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringCpgId, Monitoring::$codeCpg);
        $case = $monitoringCpg->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringCpg->getHomeDealer();
        $amount = $monitoringCpg->getAmount();
        $currency = $monitoringCpg->getCurrency();

        $monitoringWcpg = new Monitoring();
        $monitoringWcpg->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codeWcpg)
            ->setAmount($amount)
            ->setCurrency($currency);
        $form = $this->createForm(MonitoringWcpgType::class, $monitoringWcpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWcpg);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wcpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringWcpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWcpgAction(Request $req, int $monitoringId): Response
    {
        $monitoringWcpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeWcpg);
        $caseId = $monitoringWcpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWcpgEditType::class, $monitoringWcpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWcpg->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wcpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
