<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Monitoring;
use \DateTime;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseReportController extends AccidentCaseController {
    
    /**
     * @Route("/{caseId}/testEcho", requirements={"caseId"="\d+"})
     */
    public function testEcho($caseId) {
        $case = $this->calculateArrivalTimeOrReturnZero($caseId);
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
        // https://stackoverflow.com/questions/365191/how-to-get-time-difference-in-minutes-in-php
        // http://php.net/manual/pl/class.dateinterval.php
//        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 
//                + $diff->i + $diff->s / 60;
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

}
