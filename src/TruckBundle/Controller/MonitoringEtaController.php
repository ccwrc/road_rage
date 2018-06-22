<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringEtaType, MonitoringEtaEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringEtaController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringEta", requirements={"caseId"="\d+"})
     */
    public function createMonitoringEtaAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringEta = new Monitoring();
        $monitoringEta->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setCode(Monitoring::$codeEta)
            ->setTimeSet(new \DateTime('now'));
        $form = $this->createForm(MonitoringEtaType::class, $monitoringEta);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressOrangeForCase($case);
            $monitoringEta = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringEta);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_eta.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringEta", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringEtaAction(Request $req, int $monitoringId): Response
    {
        $monitoringEta = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeEta);
        $caseId = $monitoringEta->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringEtaEditType::class, $monitoringEta);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringEta = $form->getData();
            $monitoringEta->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_eta.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
