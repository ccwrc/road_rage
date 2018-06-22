<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\{
    MonitoringEndType, MonitoringEndEditType
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class MonitoringEndController extends MonitoringController
{

    /**
     * @Route("/{caseId}/createMonitoringEnd", requirements={"caseId"="\d+"})
     */
    public function createMonitoringEndAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringEnd = new Monitoring();
        $monitoringEnd->setAccidentCase($case)
            ->setOperator($this->getOperatorName())
            ->setCode(Monitoring::$codeEnd)
            ->setTimeSet(new \DateTime('now'));
        $form = $this->createForm(MonitoringEndType::class, $monitoringEnd);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressGreyForCase($case);
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringEnd);
            $em->flush();

            return $this->redirectToRoute('truck_accidentcase_firsteditcaseend', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_end.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringEnd", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringEndAction(Request $req, int $monitoringId): Response
    {
        $monitoringEnd = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, Monitoring::$codeEnd);
        $caseId = $monitoringEnd->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringEndEditType::class, $monitoringEnd);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringEnd->setOperator($this->getOperatorName());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_accidentcase_editcaseend', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_end.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }
}
