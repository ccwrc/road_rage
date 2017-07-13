<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Vehicle;
use TruckBundle\Form\VehicleType;

/**
 * @Security("has_role('ROLE_DEALER')")
 */
class VehicleController extends Controller {

    /**
     * @Route("/createVehicle")
     */
    public function createVehicleAction() {
        //

        return $this->render('TruckBundle:Vehicle:create_vehicle.html.twig', [
                        //
        ]);
    }

}
