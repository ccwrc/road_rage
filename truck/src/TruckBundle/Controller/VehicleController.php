<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use TruckBundle\Entity\Vehicle;
use TruckBundle\Form\Vehicle\VehicleType;
use TruckBundle\Form\Vehicle\VehicleEditType;
use TruckBundle\Form\Vehicle\VehicleSearchType; // test only

/**
 * @Route("/vehicle")
 * @Security("has_role('ROLE_DEALER')")
 */
class VehicleController extends Controller {
    
    /**
     * @Route("/checkVin")
     */
    public function checkVinAction(Request $req) {
        $responseVehicleId = "fail";
        $vin = $req->query->get('vin');

        if (preg_match('/^\w{8}$/', $vin) == 1) {
            $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                    ->findOneByVin($vin);
            if ($vehicle !== null) {
                $responseVehicleId = $vehicle->getId();
            }
        }

        return new JsonResponse($responseVehicleId);
    }

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
     * @Route("/{vehicleId}/showVehicle", requirements={"vehicleId"="\d+"})
     */
    public function showVehicleAction($vehicleId) {
        $this->throwExceptionIfVehicleIdIsWrong($vehicleId);
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
     * @Route("/{vehicleId}/editVehicle", requirements={"vehicleId"="\d+"})
     */
    public function editVehicleAction(Request $req, $vehicleId) {
        $this->throwExceptionIfVehicleIdIsWrong($vehicleId);
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                ->find($vehicleId);
        $form = $this->createForm(VehicleEditType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_vehicle_showvehicle", [
                        "vehicleId" => $vehicleId
            ]);
        }

        return $this->render('TruckBundle:Vehicle:edit_vehicle.html.twig', [
                    "form" => $form->createView(),
                    "vehicleId" => $vehicleId
        ]);
    }
    
    protected function throwExceptionIfVehicleIdIsWrong($vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($vehicleId);
        if ($vehicle === null) {
            throw $this->createNotFoundException("Wrong vehicle ID");
        }
    }    
    
    //TODO search by ($field, $data) {} ////////////////////////////////////
    
        /**
     * @Route("/searchVehicle")
     */
    public function searchVehicleAction(Request $req) {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleSearchType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();

            var_dump($vehicle); exit;

            return $this->redirectToRoute("truck_vehicle_showvehicle", [
                        "vehicleId" => $vehicleId
            ]);
        }

        return $this->render('TruckBundle:Vehicle:search_vehicle.html.twig', [
                    "form" => $form->createView()
        ]);
    }

}
