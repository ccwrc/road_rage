<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\AccidentCase;
use TruckBundle\Form\Monitoring\MonitoringType;
use TruckBundle\Form\Monitoring\MonitoringPgType;
use TruckBundle\Form\Monitoring\MonitoringPgEditType;
use TruckBundle\Form\Monitoring\MonitoringCpgType;
use TruckBundle\Form\Monitoring\MonitoringCpgEditType;
use TruckBundle\Form\Monitoring\MonitoringIncomingType;
use TruckBundle\Form\Monitoring\MonitoringIncomingEditType;
use TruckBundle\Form\Monitoring\MonitoringRoType;
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller {

    /**
     * @Route("/{caseId}/showAllMonitoringsForCase", requirements={"caseId"="\d+"})
     */
    public function showAllMonitoringsForCaseAction($caseId) {
        $monitorings = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findMonitoringsByCaseId($caseId);

        return $this->render('TruckBundle:Monitoring:show_all_monitorings_for_case.html.twig', [
                    "monitorings" => $monitorings
        ]);
    }
    
    /**
     * @Route("/monitoringCodesManual")
     */
    public function monitoringCodesManualAction() {

        return $this->render('TruckBundle:Monitoring:monitoring_codes_manual.html.twig', [
                        //...
        ]);
    }

    /**
     * @Route("/{caseId}/createMonitoring", requirements={"caseId"="\d+"})
     */
    public function createMonitoringAction(Request $req, $caseId) {
        // only for tests (testCode)
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"));
        $form = $this->createForm(MonitoringType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring.html.twig', [
                    "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/{caseId}/createMonitoringPg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringPgAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("PG");
        $form = $this->createForm(MonitoringPgType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_pg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringPg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringPgAction(Request $req, $monitoringId) {
        //TODO protection->check PG code, check if id exist
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringPgEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_pg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/createMonitoringCpg", requirements={"caseId"="\d+"})
     */
    public function createMonitoringCpgAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("CPG");
        $form = $this->createForm(MonitoringCpgType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_cpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringCpg", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringCpgAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringCpgEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $operatorName = $this->container->get("security.context")->getToken()->getUser()
                    ->getUsername();
            $monitoring->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_cpg.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{caseId}/createMonitoringIncoming", requirements={"caseId"="\d+"})
     */
    public function createMonitoringIncomingAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("Incoming");
        $form = $this->createForm(MonitoringIncomingType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_incoming.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringIncomig", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringIncomingAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringIncomingEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $operatorName = $this->container->get("security.context")->getToken()->getUser()
                    ->getUsername();
            $monitoring->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_incoming.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }    
    
    /**
     * @Route("/{caseId}/createMonitoringRo", requirements={"caseId"="\d+"})
     */
    public function createMonitoringRoAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $homeDealer = $case->getVehicle()->getDealer();

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)->setHomeDealer($homeDealer)
                ->setTimeSave(new DateTime("now"))->setCode("RO");
        $form = $this->createForm(MonitoringRoType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($monitoring);
            $em->flush();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:create_monitoring_ro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringRo", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringRoAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringRoEditType::class, $monitoring);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $monitoring = $form->getData();
            $operatorName = $this->container->get("security.context")->getToken()->getUser()
                    ->getUsername();
            $monitoring->setOperator($operatorName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:Monitoring:edit_monitoring_ro.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
