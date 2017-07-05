<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\AccidentCase;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller {
    
    /**
     * @Route("/showAllCases")
     */
    public function showAllCasesAction() {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->findAll();

        return $this->render('TruckBundle:AccidentCase:show_all_cases.html.twig', [
                    "cases" => $cases,
        ]);
    }

}
