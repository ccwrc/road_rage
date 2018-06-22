<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringStrrType, MonitoringStrrEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringStrrController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringStrr", requirements={"caseId"="\d+"})
     */
    public function createMonitoringStrrAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringStrr = new Monitoring();
        $monitoringStrr->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setCode(Monitoring::$codeStrr)
            ->setTimeSet(new \DateTime('now'));
        $form = $this->createForm(MonitoringStrrType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressGreenForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringStrr);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_strr.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringStrr", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStrrAction(Request $req, int $monitoringId): Response
    {
        $monitoringStrr = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeStrr);
        $caseId = $monitoringStrr->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStrrEditType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringStrr->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_strr.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
