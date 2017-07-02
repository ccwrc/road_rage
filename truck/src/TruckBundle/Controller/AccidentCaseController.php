<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\AccidentCase;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller
{
    /**
     * @Route("/testCase")
     */
    public function testCaseAction()
    {
        return $this->render('TruckBundle:AccidentCase:test_case.html.twig', array(
            // ...
        ));
    }

}
