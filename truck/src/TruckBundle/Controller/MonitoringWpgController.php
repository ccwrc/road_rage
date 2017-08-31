<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringWpgType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringEndController extends MonitoringController {

    /**
     * @Route("/{monitoringPgId}/createMonitoringWpg", requirements={"monitoringPgId"="\d+"})
     */
    public function createMonitoringWpgAction(Request $req, $monitoringId) {
        $operatorName = $this->getOperatorName();
        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $case = $monitoringPg->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringPg->getHomeDealer();

        $monitoringWpg = new Monitoring();
        $monitoringWpg->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("WPG");
        $form = $this->createForm(MonitoringWpgType::class, $monitoringWpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWpg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWpg);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}