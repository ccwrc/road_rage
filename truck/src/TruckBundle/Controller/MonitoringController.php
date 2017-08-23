<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\AccidentCase;
use TruckBundle\Form\Monitoring\MonitoringPgType;
use TruckBundle\Form\Monitoring\MonitoringPgEditType;
use TruckBundle\Form\Monitoring\MonitoringCpgType;
use TruckBundle\Form\Monitoring\MonitoringCpgEditType;
use TruckBundle\Form\Monitoring\MonitoringRoType;
use TruckBundle\Form\Monitoring\MonitoringRoEditType;
use TruckBundle\Form\Monitoring\MonitoringEtaType;
use TruckBundle\Form\Monitoring\MonitoringEtaEditType;
use TruckBundle\Form\Monitoring\MonitoringStrrType;
use TruckBundle\Form\Monitoring\MonitoringStrrEditType;
use TruckBundle\Form\Monitoring\MonitoringIncomingType;
use TruckBundle\Form\Monitoring\MonitoringIncomingEditType;
use TruckBundle\Form\Monitoring\MonitoringOutType;
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

    /**
     * @Route("/{caseId}/createMonitoringEta", requirements={"caseId"="\d+"})
     */
    public function createMonitoringEtaAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("ETA")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringEtaType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:create_monitoring_eta.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringEta", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringEtaAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringEtaEditType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:edit_monitoring_eta.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }   
    
    /**
     * @Route("/{caseId}/createMonitoringStrr", requirements={"caseId"="\d+"})
     */
    public function createMonitoringStrrAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("STRR")->setTimeSet(new DateTime("now"));
        $form = $this->createForm(MonitoringStrrType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:create_monitoring_strr.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringStrr", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringStrrAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringStrrEditType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:edit_monitoring_strr.html.twig', [
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
     * @Route("/{caseId}/createMonitoringOut", requirements={"caseId"="\d+"})
     */
    public function createMonitoringOutAction(Request $req, $caseId) {
        $operatorName = $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $monitoring = new Monitoring();
        $monitoring->setAccidentCase($case)->setOperator($operatorName)
                ->setTimeSave(new DateTime("now"))->setCode("Out");
        $form = $this->createForm(MonitoringOutType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:create_monitoring_out.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{monitoringId}/editMonitoringOut", requirements={"monitoringId"="\d+"})
     */
    public function editMonitoringOutAction(Request $req, $monitoringId) {
        $monitoring = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringId);
        $caseId = $monitoring->getAccidentCase()->getId();
        $form = $this->createForm(MonitoringOutEditType::class, $monitoring);

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

        return $this->render('TruckBundle:Monitoring:edit_monitoring_out.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

}
