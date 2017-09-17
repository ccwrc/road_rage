<?php

namespace TruckBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\AccidentCase;
// use TruckBundle\Entity\Monitoring; 
// use \DateTime;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseReportController extends AccidentCaseController {
    
    /**
     * @Route("/{caseId}/testEcho", requirements={"caseId"="\d+"})
     */
    public function testEcho($caseId) {
        $case = $this->generateAndSaveEndCaseReport($caseId);
//        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
//                ->findLastMonitoringEndByCaseId($caseId);
        $res = $case;

        return $this->render('TruckBundle:AccidentCase:test_echo.html.twig', [
                        "res" => $res
        ]);
    }

    protected function getDateDifferenceInMinutesOrReturnZero($earlierDate, $laterDate) {
        $diff = date_diff($earlierDate, $laterDate, false);
        if ($diff->invert == 1) {
            return 0;
        }
        // http://php.net/manual/pl/class.dateinterval.php
        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60
                + $diff->i;
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
    
    public function generateAndSaveEndCaseReport($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
      
        $arrivalTime = $this->calculateArrivalTimeOrReturnZero($caseId);
        $serviceCarLate = $this->calculateServiceCarLateOrReturnZero($caseId);
        $roadServiceTime = $this->calculateRoadServiceTimeOrReturnZero($caseId);
        $noRoadServiceTime = $this->calculateNoRoadServiceTimeOrReturnZero($caseId);
        $repairTotalTime = $this->calculateRepairTotalTimeOrReturnZero($caseId);
        $caseTotalTime = $this->calculateCaseTotalTimeOrReturnZero($caseId);

        $case->setReportArrivalTime($arrivalTime)->setReportLate($serviceCarLate)
                ->setReportRsTime($roadServiceTime)->setReportNrsTime($noRoadServiceTime)
                ->setReportRepairTotal($repairTotalTime)->setReportCaseTotal($caseTotalTime);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

}
