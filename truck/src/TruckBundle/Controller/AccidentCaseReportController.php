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

    protected function getDateDifferenceInMinutesOrReturnZero($earlierDate, $laterDate) {
        $diff = date_diff($earlierDate, $laterDate, false);
        if ($diff->invert == 1) {
            return 0;
        }
        // http://php.net/manual/pl/class.dateinterval.php
//        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 
//                + $diff->i + $diff->s / 60;
        $totalInMinutes = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 
                + $diff->i;        
        return (int) $totalInMinutes;
    }

}
