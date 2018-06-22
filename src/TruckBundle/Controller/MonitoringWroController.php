<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringWroType, MonitoringWroEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringWroController extends MonitoringController
{

    /**
     * @Route("/{monitoringRoId}/createMonitoringWro", requirements={"monitoringRoId"="\d+"})
     */
    public function createMonitoringWroAction(Request $req, int $monitoringRoId): Response
    {
        $monitoringRo = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringRoId, Monitoring::$codeRo);
        $case = $monitoringRo->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringRo->getHomeDealer();
        $repairDealer = $monitoringRo->getRepairDealer();
        $mailForDocument = $repairDealer->getMainMail();
        $stringWithOptionalMails = $monitoringRo->getOptionalMails();
        $amount = $monitoringRo->getAmount();
        $currency = $monitoringRo->getCurrency();

        $monitoringWro = new Monitoring();
        $monitoringWro->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codeWro)
            ->setRepairDealer($repairDealer)
            ->setContactMail($mailForDocument)
            ->setOptionalMails($stringWithOptionalMails)
            ->setAmount($amount)
            ->setCurrency($currency);
        $form = $this->createForm(MonitoringWroType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWro);
            $em->flush();

            return $this->redirectToRoute('truck_documentwro_createandsendwro', [
                'monitoringWroId' => $monitoringWro->getId()
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wro.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringWro", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWroAction(Request $req, int $monitoringId): Response
    {
        $monitoringWro = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeWro);
        $caseId = $monitoringWro->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWroEditType::class, $monitoringWro);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWro->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wro.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
