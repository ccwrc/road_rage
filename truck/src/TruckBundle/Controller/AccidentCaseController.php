<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Vehicle;
use TruckBundle\Form\AccidentCaseType;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller {
    
    /**
     * @Route("/createCase/{vehicleId}", requirements={"vehicleId"="\d+"})
     */
    public function createCaseAction(Request $req, $vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($vehicleId);
        $case = new AccidentCase();
        $case->setVehicle($vehicle);
        $form = $this->createForm(AccidentCaseType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($case);
            $em->flush();
            $caseId = $case->getId();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:create_case.html.twig', [
                    "vehicleId" => $vehicleId,
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/showAllCases")
     */
    public function showAllCasesAction() {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->findAll();

        return $this->render('TruckBundle:AccidentCase:show_all_cases.html.twig', [
                    "cases" => $cases,
        ]);
    }

    /**
     * @Route("/showAllActiveCases")
     */
    public function showAllActiveCasesAction() {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->findAllActiveCases();

        return $this->render('TruckBundle:AccidentCase:show_all_active_cases.html.twig', [
                    "cases" => $cases
        ]);
    }

}
