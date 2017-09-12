<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringOutType;
use TruckBundle\Form\Monitoring\MonitoringOutEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringOutController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringOut", requirements={"caseId"="\d+"})
     */
    public function createMonitoringOutAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoringOut = new Monitoring();
        $monitoringOut->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("Out");
        $form = $this->createForm(MonitoringOutType::class, $monitoringOut);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringOut = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringOut);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_out.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringOut", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringOutAction(Request $req, $monitoringId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringId, "Out");
        $monitoringOut = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringOut->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringOutEditType::class, $monitoringOut);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringOut = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoringOut->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_out.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
