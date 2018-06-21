<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\{
    AccidentCase, Dealer, Monitoring
};

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller
{

    /**
     * @Route("/{caseId}/showAllMonitoringsForCase", requirements={"caseId"="\d+"})
     */
    public function showAllMonitoringsForCaseAction(int $caseId): Response
    {
        $this->throwExceptionIfCaseIdIsWrongExcludingZero($caseId);
        $monitorings = $this->getDoctrine()->getRepository('TruckBundle:Monitoring')
            ->findMonitoringsByCaseId($caseId);

        return $this->render('TruckBundle:Monitoring:show_all_monitorings_for_case.html.twig', [
            'monitorings' => $monitorings
        ]);
    }

    /**
     * @Route("/monitoringCodesManual")
     */
    public function monitoringCodesManualAction(): Response
    {
        return $this->render('TruckBundle:Monitoring:monitoring_codes_manual.html.twig');
    }

    protected function getOperatorName(): string
    {
        return $this->getUser()->getUsername();
    }

    // (start) set colors
    protected function setColorProgressRedForCase(AccidentCase $case): void
    {
        $case->setProgressColor(AccidentCase::$progressColorRed);
    }

    protected function setColorProgressOrangeForCase(AccidentCase $case): void
    {
        $case->setProgressColor(AccidentCase::$progressColorOrange);
    }

    protected function setColorProgressGreenForCase(AccidentCase $case): void
    {
        $case->setProgressColor(AccidentCase::$progressColorGreen);
    }

    protected function setColorProgressGreyForCase(AccidentCase $case): void
    {
        $case->setProgressColor(AccidentCase::$progressColorLightGrey);
    }
    // (end) set colors

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

    /**
     * @param int $caseId
     * @throws NotFoundHttpException
     */
    protected function throwExceptionIfCaseIdIsWrongExcludingZero(int $caseId): void
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);
        if ($case === null && $caseId != 0) { //0 is default for operator panel
            throw $this->createNotFoundException('Wrong case ID');
        }
    }

    /**
     * @param int $caseId
     * @throws NotFoundHttpException
     * @return AccidentCase
     */
    protected function throwExceptionIfWrongIdOrGetCaseBy(int $caseId): AccidentCase
    {
        $case = $this->getDoctrine()->getRepository('TruckBundle:AccidentCase')->find($caseId);
        if ($case === null) {
            throw $this->createNotFoundException('Wrong case ID');
        }
        return $case;
    }

    /**
     * @param Dealer $dealer
     * @throws NotFoundHttpException
     */
    protected function throwExceptionIfDealerIsNotActive(Dealer $dealer): void
    {
        if ($dealer->getIsActive() !== Dealer::$dealerIsActive) {
            throw $this->createNotFoundException('Dealer is not active!');
        }
    }

    protected function checkIfDealerIsActive(Dealer $dealer): bool
    {
        if ($dealer->getIsActive() === Dealer::$dealerIsActive) {
            return true;
        }
        return false;
    }
}
