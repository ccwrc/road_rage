<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/operator")
 */
class OperatorController extends Controller {

    /**
     * @Route("/panel/{caseId}/{casesStatus}", requirements={"caseId"="\d+", "casesStatus"="\w{0,9}"})
     */
    public function panelAction(Request $req, $caseId = 0, $casesStatus = "active") {
        $pageNumber = $this->checkVarIsNumberOrReturnOne($req->query->get('page', 1)); 
        // session for AccidentCaseController, methods:
        // - showAllCasesAction
        // - showAllActiveCasesAction
        // - showAllInactiveCasesAction
        $session = $req->getSession();

        if ($casesStatus === "active") {
            $session->set('activePageNumber', $pageNumber);
        }
        if ($casesStatus === "inactive") {
            $session->set('inactivePageNumber', $pageNumber);
        }
        if ($casesStatus === "all") {
            $session->set('allPageNumber', $pageNumber);
        }

        return $this->render('TruckBundle:Operator:panel.html.twig', [
                    "caseId" => $caseId,
                    "casesStatus" => $casesStatus
        ]);
    }
    
    private function checkVarIsNumberOrReturnOne($var) {
        if(is_numeric($var)){
            return $var;
        }
        return 1;
    }

}
