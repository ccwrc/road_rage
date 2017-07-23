<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Vehicle;
use TruckBundle\Form\VehicleType;

/**
 * @Route("/vehicle")
 * @Security("has_role('ROLE_DEALER')")
 */
class VehicleController extends Controller {

    /**
     * @Route("/createVehicle")
     */
    public function createVehicleAction(Request $req) {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();
            $vehicleId = $vehicle->getId();

            return $this->redirectToRoute("truck_vehicle_showvehicle", [
                        "vehicleId" => $vehicleId
            ]);
        }

        return $this->render('TruckBundle:Vehicle:create_vehicle.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/showVehicle/{vehicleId}", requirements={"vehicleId"="\d+"})
     */
    public function showVehicleAction($vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                ->find($vehicleId);
        $dealer = $vehicle->getDealer();
        $cases = $vehicle->getAccidentCases();

        return $this->render('TruckBundle:Vehicle:show_vehicle.html.twig', [
                    "vehicle" => $vehicle,
                    "dealer" => $dealer,
                    "cases" => $cases
        ]);
    }
    
    /**
     * @Route("/editVehicle/{vehicleId}", requirements={"vehicleId"="\d+"})
     */
    public function editVehicleAction($vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                ->find($vehicleId);
        //
        
        return $this->render('TruckBundle:Vehicle:edit_vehicle.html.twig', [
                     //
        ]);        
    }

}
