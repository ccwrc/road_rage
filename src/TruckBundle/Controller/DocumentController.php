<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Monitoring;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentController extends Controller
{

    protected function isDealerIsActive(Dealer $dealer): bool
    {
        if ($dealer->getIsActive() === Dealer::$dealerIsActive) {
            return true;
        }
        return false;
    }

    protected function isCaseIsActive(AccidentCase $case): bool
    {
        if ($case->getStatus() === AccidentCase::$statusActive) {
            return true;
        }
        return false;
    }

    /**
     * @param int $monitoringId
     * @param string $code
     * @throws NotFoundHttpException
     * @return Monitoring
     */
    protected function throwExceptionIfHasWrongDataOrGetMonitoringBy(int $monitoringId, string $code): Monitoring
    {
        $monitoring = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->find($monitoringId);
        if ($monitoring === null || $monitoring->getCode() != $code) {
            throw $this->createNotFoundException('Wrong monitoring data');
        }
        return $monitoring;
    }

    public static function getEmailsFromString(string $string): array
    {
        $unverifiedEmails = [];
        $emails = [];
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $unverifiedEmails);

        $counter = count($unverifiedEmails[0]);
        for ($i = 0; $i < $counter; $i++) {
            if (filter_var($unverifiedEmails[0][$i], FILTER_VALIDATE_EMAIL)) {
                $emails[] = $unverifiedEmails[0][$i];
            }
        }
        return $emails;
    }
}
