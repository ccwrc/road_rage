<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CaseController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('TruckBundle:Case:test.html.twig', array(
            // ...
        ));
    }

}
