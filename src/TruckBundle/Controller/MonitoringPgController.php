<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringPgType, MonitoringPgEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringPgController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringPg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringPgAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $homeDealer = $case->getVehicle()->getDealer();
        if (!$this->checkIfDealerIsActive($homeDealer)) {
            return $this->redirectToRoute('truck_main_warninginformation', [
                'message' => 'Dealer is not active, can not confirm PG.'
            ]);
        }

        $monitoringPg = new Monitoring();
        $monitoringPg->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setHomeDealer($homeDealer)
            ->setCode(Monitoring::$codePg)
            ->setAmount(2000)
            ->setCurrency(Monitoring::$currencyEur)
            ->setContactMail($homeDealer->getMainMail());
        $form = $this->createForm(MonitoringPgType::class, $monitoringPg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringPg);
            $em->flush();

            return $this->redirectToRoute('truck_documentpg_createandsendpg', [
                'monitoringPgId' => $monitoringPg->getId()
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_pg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringPg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringPgAction(Request $req, int $monitoringId): Response
    {
        $monitoringPg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codePg);
        $caseId = $monitoringPg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringPgEditType::class, $monitoringPg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringPg->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_pg.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
