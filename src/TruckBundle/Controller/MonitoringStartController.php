<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringStartEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringStartController extends MonitoringController
{

    /* START: START new case (automatic code) 
       created automatically when the case starts in AccidentCaseController
       look -> createCaseAction */

    /**
     * @Route("/{monitoringId}/editMonitoringStart", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStartAction(Request $req, int $monitoringId): Response
    {
        $monitoringStart = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeStart);
        $caseId = $monitoringStart->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStartEditType::class, $monitoringStart);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringStart->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_start.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
