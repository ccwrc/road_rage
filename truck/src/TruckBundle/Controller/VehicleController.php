<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use TruckBundle\Entity\Vehicle;

class VehicleController extends Controller
{
    /**
     * @Route("/testVehicle")
     */
    public function testAction()
    {
        return $this->render('TruckBundle:Vehicle:test.html.twig', array(
            // ...
        ));
    }

}
