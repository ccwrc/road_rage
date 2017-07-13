<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

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
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);

        return $this->render('TruckBundle:Vehicle:create_vehicle.html.twig', [
                       "form" => $form->createView()
        ]);
    }

}
