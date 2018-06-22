<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringWpgType, MonitoringWpgEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringWpgController extends MonitoringController
{

    /**
     * @Route("/{monitoringPgId}/createMonitoringWpg", requirements={"monitoringPgId"="\d+"})
     */
    public function createMonitoringWpgAction(Request $req, int $monitoringPgId): Response
    {
        $monitoringPg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringPgId, Monitoring::$codePg);
        $case = $monitoringPg->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringPg->getHomeDealer();
        $mailForDocument = $monitoringPg->getContactMail();
        $stringWithOptionalMails = $monitoringPg->getOptionalMails();
        $amount = $monitoringPg->getAmount();
        $currency = $monitoringPg->getCurrency();

        $monitoringWpg = new Monitoring();
        $monitoringWpg->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codeWpg)
            ->setContactMail($mailForDocument)
            ->setOptionalMails($stringWithOptionalMails)
            ->setAmount($amount)
            ->setCurrency($currency);
        $form = $this->createForm(MonitoringWpgType::class, $monitoringWpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWpg);
            $em->flush();

            return $this->redirectToRoute('truck_documentwpg_createandsendwpg', [
                'monitoringWpgId' => $monitoringWpg->getId()
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringWpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWpgAction(Request $req, int $monitoringId): Response
    {
        $monitoringWpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeWpg);
        $caseId = $monitoringWpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWpgEditType::class, $monitoringWpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWpg->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wpg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
