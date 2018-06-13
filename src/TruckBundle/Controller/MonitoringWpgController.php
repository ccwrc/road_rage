<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Form\Monitoring\MonitoringWpgType;
use TruckBundle\Form\Monitoring\MonitoringWpgEditType;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringWpgController extends MonitoringController {

    /**
     * @Route("/{monitoringPgId}/createMonitoringWpg", requirements={"monitoringPgId"="\d+"})
     */
    public function createMonitoringWpgAction(Request $req, $monitoringPgId) {
        $monitoringPg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringPgId, "PG");
        $case = $monitoringPg->getAccidentCase();
        $caseId = $case->getId();
        $homeDealer = $monitoringPg->getHomeDealer();
        $mailForDocument = $monitoringPg->getContactMail();
        $stringWithOptionalMails = $monitoringPg->getOptionalMails();
        $amount = $monitoringPg->getAmount();
        $currency = $monitoringPg->getCurrency();

        $monitoringWpg = new Monitoring();
        $monitoringWpg->setAccidentCase($case)->setOperator($this->getOperatorName())
                ->setHomeDealer($homeDealer)->setCode("WPG")->setContactMail($mailForDocument)
                ->setOptionalMails($stringWithOptionalMails)->setAmount($amount)->setCurrency($currency);
        $form = $this->createForm(MonitoringWpgType::class, $monitoringWpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->setColorProgressRedForCase($case);
            $monitoringWpg = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoringWpg);
            $em->flush();

            return $this->redirectToRoute("truck_documentwpg_createandsendwpg", [
                        "monitoringWpgId" => $monitoringWpg->getId()
            ]);            
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_wpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringWpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringWpgAction(Request $req, $monitoringId) {
        $monitoringWpg = $this->throwExceptionIfHasWrongDataOrGetMonitoringBy($monitoringId, "WPG");
        $caseId = $monitoringWpg->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringWpgEditType::class, $monitoringWpg);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoringWpg = $form->getData();
            $monitoringWpg->setOperator($this->getOperatorName());
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_wpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
