<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/operator")
 */
final class OperatorController extends Controller
{
    public const PANEL_CASES_STATUS_ACTIVE = 'active';
    public const PANEL_CASES_STATUS_INACTIVE = 'inactive';
    public const PANEL_CASES_STATUS_ALL = 'all';

    /**
     * @Route("/panel/{caseId}/{casesStatus}", requirements={"caseId"="\d+", "casesStatus"="\w{0,9}"})
     */
    public function panelAction(
        Request $req,
        int $caseId = 0,
        string $casesStatus = OperatorController::PANEL_CASES_STATUS_ACTIVE): Response
    {
        $pageNumber = $this->checkVarIsNumberOrReturnOne($req->query->get('page', 1));
        /* session for AccidentCaseController, methods:
         * - showAllCasesAction
         * - showAllActiveCasesAction
         * - showAllInactiveCasesAction  */
        $session = $req->getSession();

        if ($casesStatus === OperatorController::PANEL_CASES_STATUS_ACTIVE) {
            $session->set('activePageNumber', $pageNumber);
        }
        if ($casesStatus === OperatorController::PANEL_CASES_STATUS_INACTIVE) {
            $session->set('inactivePageNumber', $pageNumber);
        }
        if ($casesStatus === OperatorController::PANEL_CASES_STATUS_ALL) {
            $session->set('allPageNumber', $pageNumber);
        }

        $userId = $this->getUser()->getId();

        try {
            $countPrivateNote = $this->getDoctrine()->getRepository('TruckBundle:Note')
                ->countUserPrivateNotesFromLast24h($userId);
        } catch (\Exception $e) {
            $countPrivateNote = '0';
        }

        try {
            $countPublicNote = $this->getDoctrine()->getRepository('TruckBundle:Note')
                ->countPublicNotesFromLast24h();
        } catch (\Exception $e) {
            $countPublicNote = '0';
        }

        return $this->render('TruckBundle:Operator:panel.html.twig', [
            'caseId' => $caseId,
            'casesStatus' => $casesStatus,
            'countPrivateNote' => $countPrivateNote,
            'countPublicNote' => $countPublicNote
        ]);
    }

    /**
     * @param mixed $var
     * @return int
     */
    private function checkVarIsNumberOrReturnOne($var): int
    {
        if (is_numeric($var)) {
            return (int)$var;
        }
        return 1;
    }
}
