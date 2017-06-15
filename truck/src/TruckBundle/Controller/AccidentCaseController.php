<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use TruckBundle\Entity\AccidentCase;

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
