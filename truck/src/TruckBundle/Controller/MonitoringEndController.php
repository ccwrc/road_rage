<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
//use TruckBundle\EntityAccidentCase;
use TruckBundle\Form\Monitoring\MonitoringEndType;
use TruckBundle\Form\Monitoring\MonitoringEndEditType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringEndController extends MonitoringController {

    /**
     * @Route("/{caseId}/createMonitoringEnd", requirements={"caseId"="\d+"})
     */
    public function createMonitoringEndAction(Request $req, $caseId) {
        $operatorName = $this->getOperatorName();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoringEnd = new Monitoring();
        $monitoringEnd->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("END")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringEndType::class, $monitoringEnd);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
         //   $this->setColorProgressGreyForCase($case);
            $monitoringEnd = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringEnd);
            $em->flush();

            return $this->redirectToRoute("truck_accidentcase_firsteditcaseend", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_end.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{monitoringId}/editMonitoringEnd", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringEndAction(Request $req, $monitoringId) {
        $monitoringEnd = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoringEnd->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringEndEditType::class, $monitoringEnd);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringEnd = $form->getData();
            $operatorName = $this->getOperatorName();
            $monitoringEnd->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        //TODO case end -> make calculations
            return $this->redirectToRoute("truck_accidentcase_editcaseend", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_end.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
