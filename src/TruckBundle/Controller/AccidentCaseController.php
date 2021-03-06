<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\{
    AccidentCase, Monitoring, Vehicle
};
use TruckBundle\Form\AccidentCase\{
    AccidentCaseEditEndType, AccidentCaseEditType, AccidentCaseSearchType, AccidentCaseType
};
use TruckBundle\Presenter\AccidentCaseSearchPresenter;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller
{

    /**
     * @Route("/caseProgressColorManual")
     */
    public function caseProgressColorManualAction(): Response
    {
        return $this->render('TruckBundle:AccidentCase:case_progress_color_manual.html.twig');
    }

    /**
     * @Route("/searchCase")
     */
    public function searchCaseAction(Request $req): Response
    {
        $accidentCaseSearchPresenter = new AccidentCaseSearchPresenter();
        $form = $this->createForm(AccidentCaseSearchType::class, $accidentCaseSearchPresenter, [
            'method' => 'GET'
        ]);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {

            if (is_int($accidentCaseSearchPresenter->getCaseId()) &&
                $this->checkIsCaseExists($accidentCaseSearchPresenter->getCaseId())) {
                return $this->redirectToOperatorPanelBy($accidentCaseSearchPresenter->getCaseId());
            }

            $casesQuery = $this->getDoctrine()->getManager()->getRepository('TruckBundle:AccidentCase')->findAllCasesBy(
                $accidentCaseSearchPresenter->getCompanyName(),
                $accidentCaseSearchPresenter->getDamageDescription(),
                $accidentCaseSearchPresenter->getTruckLocation()
            );

            $paginator = $this->get('knp_paginator');
            $cases = $paginator->paginate(
                $casesQuery,
                $req->query->get('page', 1), 20);

            return $this->render('TruckBundle:AccidentCase:show_all_found_cases.html.twig', [
                'cases' => $cases
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:search_case.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{vehicleId}/createCase", requirements={"vehicleId"="\d+"})
     */
    public function createCaseAction(Request $req, int $vehicleId): Response
    {
        $vehicle = $this->throwExceptionOrGetVehicleBy($vehicleId);
        $case = new AccidentCase();
        $case->setVehicle($vehicle);
        $form = $this->createForm(AccidentCaseType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($case);

            $monitoringStart = new Monitoring();
            $monitoringStart->setAccidentCase($case)
                ->setCode(Monitoring::$codeStart)
                ->setOperator($this->getUser()->getUsername())
                ->setComments($case->getComment())
                ->setContactThrough($case->getDriverContact());
            $em->persist($monitoringStart);
            $em->flush();

            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $case->getId()
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:create_case.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{caseId}/editCase", requirements={"caseId"="\d+"})
     */
    public function editCaseAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionOrGetCaseBy($caseId);
        $form = $this->createForm(AccidentCaseEditType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:edit_case.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/firstEditCaseEnd", requirements={"caseId"="\d+"})
     */
    public function firstEditCaseEndAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionOrGetCaseBy($caseId);
        $this->generateAndSaveEndCaseReport($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:first_edit_case_end.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/editCaseEnd", requirements={"caseId"="\d+"})
     */
    public function editCaseEndAction(Request $req, int $caseId): Response
    {
        $case = $this->throwExceptionOrGetCaseBy($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:edit_case_end.html.twig', [
            'form' => $form->createView(),
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllCases", requirements={"caseId"="\d+"})
     */
    public function showAllCasesAction(Request $req, int $caseId = 0): Response
    {
        //session from OperatorController, method panelAction
        $casesQuery = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')
            ->findAllCasesQuery();
        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
            $casesQuery,
            $req->getSession()->get('allPageNumber', 1)/* page number */, 200/* limit per page */);

        return $this->render('TruckBundle:AccidentCase:show_all_cases.html.twig', [
            'cases' => $cases,
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllActiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllActiveCasesAction(Request $req, int $caseId = 0): Response
    {
        //session from OperatorController, method panelAction
        $casesQuery = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')
            ->findAllActiveCasesQuery();
        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
            $casesQuery,
            $req->getSession()->get('activePageNumber', 1)/* page number */, 35/* limit per page */);

        return $this->render('TruckBundle:AccidentCase:show_all_active_cases.html.twig', [
            'cases' => $cases,
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllInactiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllInactiveCasesAction(Request $req, int $caseId = 0): Response
    {
        //session from OperatorController, method panelAction
        $casesQuery = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')
            ->findAllInactiveCasesQuery();

        $paginator = $this->get('knp_paginator');
        $cases = $paginator->paginate(
            $casesQuery,
            $req->getSession()->get('inactivePageNumber', 1)/* page number */, 200/* limit per page */);

        return $this->render('TruckBundle:AccidentCase:show_all_inactive_cases.html.twig', [
            'cases' => $cases,
            'caseId' => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showStartCase", requirements={"caseId"="\d+"})
     */
    public function showStartCaseAction(int $caseId): Response
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);
        // do not throw exception above
        return $this->render('TruckBundle:AccidentCase:show_start_case.html.twig', [
            'case' => $case
        ]);
    }

    /**
     * @Route("/{caseId}/showEndCase", requirements={"caseId"="\d+"})
     */
    public function showEndCaseAction(int $caseId): Response
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);
        // do not throw exception above
        return $this->render('TruckBundle:AccidentCase:show_end_case.html.twig', [
            'case' => $case
        ]);
    }

    /**
     * @Route("/{caseId}/activateDeactivateCase", requirements={"caseId"="\d+"})
     */
    public function activateDeactivateCaseAction(int $caseId): Response
    {
        $case = $this->throwExceptionOrGetCaseBy($caseId);

        if ($case->getStatus() === AccidentCase::$statusActive && $case->getProgressColor() === AccidentCase::$progressColorLightGrey) {
            $case->setStatus(AccidentCase::$statusInactive);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => 0
            ]);
        } else {
            $case->setStatus(AccidentCase::$statusActive);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('truck_operator_panel', [
                'caseId' => $caseId
            ]);
        }
    }

    // (start) functions for generate end case report
    private function getDateDifferenceInMinutesOrReturnZero(\DateTime $earlierDate, \DateTime $laterDate): int
    {
        // http://php.net/manual/pl/class.dateinterval.php
        $diff = \date_diff($earlierDate, $laterDate, false);
        if ($diff->invert == 1) {
            return 0;
        }
        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i;
        return (int)$totalInMinutes;
    }

    private function calculateArrivalTimeOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringEta = $monitoringRepository->findLastMonitoringEtaByCaseId($caseId);
        $monitoringRo = $monitoringRepository->findLastMonitoringRoByCaseId($caseId);
        $monitoringStrr = $monitoringRepository->findLastMonitoringStrrByCaseId($caseId);
        if (!$monitoringEta || !$monitoringRo || !$monitoringStrr) {
            return 0;
        }

        $departureTime = $monitoringRo->getTimeSave();
        $timeOfArrival = $monitoringStrr->getTimeSet();
        if ($departureTime === null || $timeOfArrival === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($departureTime, $timeOfArrival);
    }

    private function calculateServiceCarLateOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringEta = $monitoringRepository->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $monitoringRepository->findLastMonitoringStrrByCaseId($caseId);
        if (!$monitoringEta || !$monitoringStrr) {
            return 0;
        }

        $estimateTimeOfArrival = $monitoringEta->getTimeSet();
        $timeOfArrival = $monitoringStrr->getTimeSet();
        if ($estimateTimeOfArrival === null || $timeOfArrival === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($estimateTimeOfArrival, $timeOfArrival);
    }

    private function calculateRoadServiceTimeOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringEta = $monitoringRepository->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $monitoringRepository->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $monitoringRepository->findLastMonitoringEndByCaseId($caseId);
        if (!$monitoringEta || !$monitoringStrr || !$monitoringEnd) {
            return 0;
        }

        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();
        if ($startRepairTime === null || $endRepairTime === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    private function calculateNoRoadServiceTimeOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringEta = $monitoringRepository->findLastMonitoringEtaByCaseId($caseId);
        $monitoringStrr = $monitoringRepository->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $monitoringRepository->findLastMonitoringEndByCaseId($caseId);
        if ($monitoringEta || !$monitoringStrr || !$monitoringEnd) {
            return 0;
        }

        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();
        if ($startRepairTime === null || $endRepairTime === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    private function calculateRepairTotalTimeOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringStrr = $monitoringRepository->findLastMonitoringStrrByCaseId($caseId);
        $monitoringEnd = $monitoringRepository->findLastMonitoringEndByCaseId($caseId);
        if (!$monitoringStrr || !$monitoringEnd) {
            return 0;
        }

        $startRepairTime = $monitoringStrr->getTimeSet();
        $endRepairTime = $monitoringEnd->getTimeSet();
        if ($startRepairTime === null || $endRepairTime === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($startRepairTime, $endRepairTime);
    }

    private function calculateCaseTotalTimeOrReturnZero(int $caseId): int
    {
        $monitoringRepository = $this->getDoctrine()->getRepository('TruckBundle:Monitoring');

        $monitoringStart = $monitoringRepository->findFirstMonitoringStartByCaseId($caseId);
        $monitoringEnd = $monitoringRepository->findLastMonitoringEndByCaseId($caseId);
        if (!$monitoringStart || !$monitoringEnd) {
            return 0;
        }

        $startCaseTime = $monitoringStart->getTimeSave();
        $endCaseTime = $monitoringEnd->getTimeSave();
        if ($startCaseTime === null || $endCaseTime === null) {
            return 0;
        }

        return $this->getDateDifferenceInMinutesOrReturnZero($startCaseTime, $endCaseTime);
    }

    private function generateAndSaveEndCaseReport(int $caseId): void
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);

        $arrivalTime = $this->calculateArrivalTimeOrReturnZero($caseId);
        $serviceCarLate = $this->calculateServiceCarLateOrReturnZero($caseId);
        $roadServiceTime = $this->calculateRoadServiceTimeOrReturnZero($caseId);
        $noRoadServiceTime = $this->calculateNoRoadServiceTimeOrReturnZero($caseId);
        $repairTotalTime = $this->calculateRepairTotalTimeOrReturnZero($caseId);
        $caseTotalTime = $this->calculateCaseTotalTimeOrReturnZero($caseId);

        $case->setReportArrivalTime($arrivalTime)->setReportLate($serviceCarLate)
            ->setReportRsTime($roadServiceTime)->setReportNrsTime($noRoadServiceTime)
            ->setReportRepairTotal($repairTotalTime)->setReportCaseTotal($caseTotalTime)
            ->setReportRepairStatus(AccidentCase::$reportRepairStatusCanceled);

        $this->getDoctrine()->getManager()->flush();
    }
    // (end) functions for generate end case report

    /**
     * @param int $vehicleId
     * @throws NotFoundHttpException
     * @return Vehicle
     */
    private function throwExceptionOrGetVehicleBy(int $vehicleId): Vehicle
    {
        $vehicle = $this->getDoctrine()->getRepository('TruckBundle:Vehicle')->find($vehicleId);
        if ($vehicle === null) {
            throw $this->createNotFoundException('Wrong vehicle ID');
        }
        return $vehicle;
    }

    /**
     * @param int $caseId
     * @throws NotFoundHttpException
     * @return AccidentCase
     */
    private function throwExceptionOrGetCaseBy(int $caseId): AccidentCase
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);
        if ($case === null) {
            throw $this->createNotFoundException('Wrong case ID');
        }
        return $case;
    }

    /**
     * @param int $caseId
     * @return bool
     */
    private function checkIsCaseExists(int $caseId): bool
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->findOneById($caseId);
        if ($case instanceof AccidentCase) {
            return true;
        }
        return false;
    }

    /**
     * @param int $existingCaseId
     * @return Response
     */
    private function redirectToOperatorPanelBy(int $existingCaseId): Response
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->findOneById($existingCaseId);
        $casesStatus = $case->getStatus();
        return $this->redirectToRoute('truck_operator_panel', [
            'caseId' => $existingCaseId,
            'casesStatus' => $casesStatus
        ]);
    }
}
