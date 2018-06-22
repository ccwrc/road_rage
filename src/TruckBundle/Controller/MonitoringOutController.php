<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringOutType, MonitoringOutEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringOutController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringOut", requirements={"caseId"="\d+"})
     */
    public function createMonitoringOutAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringOut = new Monitoring();
        $monitoringOut->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setCode(Monitoring::$codeOut);
        $form = $this->createForm(MonitoringOutType::class, $monitoringOut);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringOut);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_out.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringOut", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringOutAction(Request $req, int $monitoringId): Response
    {
        $monitoringOut = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeOut);
        $caseId = $monitoringOut->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringOutEditType::class, $monitoringOut);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringOut->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_out.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
