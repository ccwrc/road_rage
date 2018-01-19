<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringStrrType;
use TruckBundle\Form\Monitoring\MonitoringStrrEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringStrrController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringStrr", requirements={"caseId"="\d+"})
     */
    public function createMonitoringStrrAction(Request $req, $caseId) {
        $case = $this->throwExceptionIfWrongIdOrGetCaseBy($caseId);

        $monitoringStrr = new Monitoring();
        $monitoringStrr->setAccidentCase($case)->setOperator($this->getOperatorName())
                ->setCode("STRR")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringStrrType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressGreenForCase($case);
            $monitoringStrr = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringStrr);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_strr.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringStrr", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStrrAction(Request $req, $monitoringId) {
        $monitoringStrr = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "STRR");
        $caseId = $monitoringStrr->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStrrEditType::class, $monitoringStrr);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringStrr = $form->getData();
            $monitoringStrr->setOperator($this->getOperatorName());
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_strr.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
