<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\{
    Request, JsonResponse, Response
};
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\Vehicle;
use TruckBundle\Form\Vehicle\{
    VehicleType, VehicleEditType, VehicleSearchType
};

/**
 * @Route("/vehicle")
 * @Security("has_role('ROLE_DEALER')")
 */
final class VehicleController extends Controller
{

    /**
     * for view Vehicle:create_vehicle.html.twig
     * @Route("/checkVin")
     */
    public function checkVinAction(Request $req): JsonResponse
    {
        $responseVehicleId = 'fail';
        $vin = $req->query->get('vin');

        if (\preg_match('/^\w{8}$/', $vin) == 1) {
            $vehicle = $this->getDoctrine()->getRepository('TruckBundle:Vehicle')
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
    public function createVehicleAction(Request $req): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('truck_vehicle_showvehicle', [
                'vehicleId' => $vehicle->getId()
            ]);
        }

        return $this->render('TruckBundle:Vehicle:create_vehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{vehicleId}/showVehicle", requirements={"vehicleId"="\d+"})
     */
    public function showVehicleAction(int $vehicleId): Response
    {
        $vehicle = $this->throwExceptionIfVehicleIdIsWrongOrGetVehicleBy($vehicleId);
        $dealer = $vehicle->getDealer();
        $cases = $vehicle->getAccidentCases();

        return $this->render('TruckBundle:Vehicle:show_vehicle.html.twig', [
            'vehicle' => $vehicle,
            'dealer' => $dealer,
            'cases' => $cases
        ]);
    }

    /**
     * @Route("/{vehicleId}/editVehicle", requirements={"vehicleId"="\d+"})
     */
    public function editVehicleAction(Request $req, int $vehicleId): Response
    {
        $vehicle = $this->throwExceptionIfVehicleIdIsWrongOrGetVehicleBy($vehicleId);
        $form = $this->createForm(VehicleEditType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_vehicle_showvehicle', [
                'vehicleId' => $vehicleId
            ]);
        }

        return $this->render('TruckBundle:Vehicle:edit_vehicle.html.twig', [
            'form' => $form->createView(),
            'vehicleId' => $vehicleId
        ]);
    }

    /**
     * @Route("/searchVehicle")
     */
    public function searchVehicleAction(Request $req): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleSearchType::class, $vehicle);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleForm = $form->getData();
            $companyName = $vehicleForm->getCompanyName();
            $city = $vehicleForm->getCity();
            $street = $vehicleForm->getStreet();
            $registrationNumber = $vehicleForm->getRegistrationNumber();

            $vehiclesQuery = $this->getDoctrine()
                ->getRepository('TruckBundle:Vehicle')
                ->findAllVehiclesByQuery(
                    $companyName,
                    $city,
                    $street,
                    $registrationNumber);

            $paginator = $this->get('knp_paginator');
            $vehicles = $paginator->paginate(
                $vehiclesQuery,
                $req->query->get('page', 1)/* page number */, 20/* limit per page */);

            return $this->render('TruckBundle:Vehicle:show_search_vehicles.html.twig', [
                'vehicles' => $vehicles
            ]);
        }

        return $this->render('TruckBundle:Vehicle:search_vehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param mixed $vehicleId
     * @throws NotFoundHttpException
     * @return Vehicle
     */
    private function throwExceptionIfVehicleIdIsWrongOrGetVehicleBy($vehicleId): Vehicle
    {
        $vehicle = $this->getDoctrine()->getRepository('TruckBundle:Vehicle')->find($vehicleId);
        if ($vehicle === null) {
            throw $this->createNotFoundException('Wrong vehicle ID');
        }
        return $vehicle;
    }
}
