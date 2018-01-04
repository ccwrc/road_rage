<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Monitoring; //for createCaseAction (monitoringStart)
use TruckBundle\Form\AccidentCase\AccidentCaseType;
use TruckBundle\Form\AccidentCase\AccidentCaseEditType;
use TruckBundle\Form\AccidentCase\AccidentCaseEditEndType;
use \DateTime;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller {



    /**
     * @Route("/caseProgressColorManual")
     */
    public function caseProgressColorManualAction() {
        
        return $this->render('TruckBundle:AccidentCase:case_progress_color_manual.html.twig');
    }

    /**
     * @Route("/{vehicleId}/createCase", requirements={"vehicleId"="\d+"})
     */
    public function createCaseAction(Request $req, $vehicleId) {
        $this->throwExceptionIfVehicleIdIsWrong($vehicleId);
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($vehicleId);
        $case = new AccidentCase();
        $case->setVehicle($vehicle)->setTimeStart(new DateTime("now"));
        $form = $this->createForm(AccidentCaseType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($case);

            $operatorName = $this->getOperatorName();
            $monitoringStart = new Monitoring();
            $monitoringStart->setAccidentCase($case)->setCode("START")->setOperator($operatorName)
                    ->setComments($case->getComment())->setContactThrough($case->getDriverContact());
            $em->persist($monitoringStart);
            $em->flush();
            $caseId = $case->getId();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:create_case.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{caseId}/editCase", requirements={"caseId"="\d+"})
     */
    public function editCaseAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        $form = $this->createForm(AccidentCaseEditType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:edit_case.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/firstEditCaseEnd", requirements={"caseId"="\d+"})
     */
    public function firstEditCaseEndAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $this->generateAndSaveEndCaseReport($caseId);
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:first_edit_case_end.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/editCaseEnd", requirements={"caseId"="\d+"})
     */
    public function editCaseEndAction(Request $req, $caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }
   
        return $this->render('TruckBundle:AccidentCase:edit_case_end.html.twig', [
                    "form" => $form->createView(),
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllCases", requirements={"caseId"="\d+"})
     */
    public function showAllCasesAction(Request $req, $caseId = 0) {
        //session from OperatorController, method panelAction

        $casesQuery = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->findAllCasesQuery();
        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
                $casesQuery, $req->getSession()->get('allPageNumber', 1)/* page number */, 
                500/* limit per page */);
        
        return $this->render('TruckBundle:AccidentCase:show_all_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllActiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllActiveCasesAction(Request $req, $caseId = 0) {
        //session from OperatorController, method panelAction

        $casesQuery = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->findAllActiveCasesQuery();
        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
                $casesQuery, $req->getSession()->get('activePageNumber', 1)/* page number */, 
                35/* limit per page */);

        return $this->render('TruckBundle:AccidentCase:show_all_active_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllInactiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllInactiveCasesAction(Request $req, $caseId = 0) {
        //session from OperatorController, method panelAction

        $casesQuery = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->findAllInactiveCasesQuery();

        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
                $casesQuery, $req->getSession()->get('inactivePageNumber', 1)/* page number */, 
                500/* limit per page */);

        return $this->render('TruckBundle:AccidentCase:show_all_inactive_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showStartCase", requirements={"caseId"="\d+"})
     */
    public function showStartCaseAction($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        return $this->render('TruckBundle:AccidentCase:show_start_case.html.twig', [
                    "case" => $case
        ]);
    }

    /**
     * @Route("/{caseId}/showEndCase", requirements={"caseId"="\d+"})
     */
    public function showEndCaseAction($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        return $this->render('TruckBundle:AccidentCase:show_end_case.html.twig', [
                    "case" => $case
        ]);
    }

    /**
     * @Route("/{caseId}/activateDeactivateCase", requirements={"caseId"="\d+"})
     */
    public function activateDeactivateCaseAction($caseId) {
        $this->throwExceptionIfCaseIdIsWrong($caseId);
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case->getStatus() === "active" && $case->getProgressColor() === "#E6E6E6") {
            $case->setStatus("inactive");
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => 0
            ]);
        } else {
            $case->setStatus("active");
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }
    }

    
    // (start) functions for generate end case report
    protected function getDateDifferenceInMinutesOrReturnZero($earlierDate, $laterDate) {
        $diff = date_diff($earlierDate, $laterDate, false);
        if ($diff->invert == 1) {
            return 0;
        }
        // http://php.net/manual/pl/class.dateinterval.php
        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i;
        return (int) $totalInMinutes;
    }

    protected function calculateArrivalTimeOrReturnZero($caseId) {
        $monitoringEta = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEtaByCaseId($caseId);
        $monitoringRo = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringRoByCaseId($caseId);
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringStrrByCaseId($caseId);

        if (!$monitoringEta || !$monitoringRo || !$monitoringStrr) {
            return 0;
        }
        $departureTime = $monitoringRo->getTimeSave();
        $timeOfArrival = $monitoringStrr->getTimeSet();

        return $this->getDateDifferenceInMinutesOrReturnZero($departureTime, $timeOfArrival);
    }

    protected function calculateServiceCarLateOrReturnZero($caseId) {
        $monitoringEta = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringStrrByCaseId($caseId);

        if (!$monitoringEta || !$monitoringStrr) {
            return 0;
        }
        $estimateTimeOfArrival = $monitoringEta->getTimeSet();
        $timeOfArrival = $monitoringStrr->getTimeSet();

        return $this->getDateDifferenceInMinutesOrReturnZero($estimateTimeOfArrival, $timeOfArrival);
    }

    protected function calculateRoadServiceTimeOrReturnZero($caseId) {
        $monitoringEta = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEndByCaseId($caseId);

        if (!$monitoringEta || !$monitoringStrr || !$monitoringEnd) {
            return 0;
        }
        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    protected function calculateNoRoadServiceTimeOrReturnZero($caseId) {
        $monitoringEta = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEndByCaseId($caseId);

        if ($monitoringEta || !$monitoringStrr || !$monitoringEnd) {
            return 0;
        }
        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    protected function calculateRepairTotalTimeOrReturnZero($caseId) {
        $monitoringStrr = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEndByCaseId($caseId);

        if (!$monitoringStrr || !$monitoringEnd) {
            return 0;
        }
        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    protected function calculateCaseTotalTimeOrReturnZero($caseId) {
        $monitoringStart = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findFirstMonitoringStartByCaseId($caseId);
        $monitoringEnd = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->findLastMonitoringEndByCaseId($caseId);

        if (!$monitoringStart || !$monitoringEnd) {
            return 0;
        }
        $startCaseTime = $monitoringStart->getTimeSave();
        $endCaseTime = $monitoringEnd->getTimeSave();

        return $this->getDateDifferenceInMinutesOrReturnZero($startCaseTime, $endCaseTime);
    }

    protected function generateAndSaveEndCaseReport($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        $arrivalTime = $this->calculateArrivalTimeOrReturnZero($caseId);
        $serviceCarLate = $this->calculateServiceCarLateOrReturnZero($caseId);
        $roadServiceTime = $this->calculateRoadServiceTimeOrReturnZero($caseId);
        $noRoadServiceTime = $this->calculateNoRoadServiceTimeOrReturnZero($caseId);
        $repairTotalTime = $this->calculateRepairTotalTimeOrReturnZero($caseId);
        $caseTotalTime = $this->calculateCaseTotalTimeOrReturnZero($caseId);

        $case->setReportArrivalTime($arrivalTime)->setReportLate($serviceCarLate)
                ->setReportRsTime($roadServiceTime)->setReportNrsTime($noRoadServiceTime)
                ->setReportRepairTotal($repairTotalTime)->setReportCaseTotal($caseTotalTime)
                ->setReportRepairStatus("canceled");

        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }
    // (end) functions for generate end case report
    
    protected function getOperatorName() {
        return $this->container->get("security.context")->getToken()->getUser()
                        ->getUsername();
    }

    protected function throwExceptionIfVehicleIdIsWrong($vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($vehicleId);
        if ($vehicle === null) {
            throw $this->createNotFoundException("Wrong vehicle ID");
        }
    }

    protected function throwExceptionIfCaseIdIsWrong($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case === null) {
            throw $this->createNotFoundException("Wrong case ID");
        }
    }    
}
