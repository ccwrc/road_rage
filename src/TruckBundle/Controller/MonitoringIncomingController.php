<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringIncomingType, MonitoringIncomingEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringIncomingController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringIncoming", requirements={"caseId"="\d+"})
     */
    public function createMonitoringIncomingAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringIncoming = new Monitoring();
        $monitoringIncoming->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setCode(Monitoring::$codeIncoming);
        $form = $this->createForm(MonitoringIncomingType::class, $monitoringIncoming);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringIncoming);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_incoming.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringIncoming", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringIncomingAction(Request $req, int $monitoringId): Response
    {
        $monitoringIncoming = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeIncoming);
        $caseId = $monitoringIncoming->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringIncomingEditType::class, $monitoringIncoming);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringIncoming->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_incoming.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
