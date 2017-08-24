<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Vehicle;
use TruckBundle\Entity\Monitoring; //for createCaseAction
use TruckBundle\Form\AccidentCase\AccidentCaseType;
use TruckBundle\Form\AccidentCase\AccidentCaseEditType;
use TruckBundle\Form\AccidentCase\AccidentCaseEditEndType;
use \DateTime;

/**
 * @Route("/cases")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class AccidentCaseController extends Controller {
    
    /**
     * @Route("/{vehicleId}/createCase", requirements={"vehicleId"="\d+"})
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
           
            $operatorName = $this->container->get("security.context")->getToken()->getUser()
                    ->getUsername();
            $startMonitoring = new Monitoring();
            $startMonitoring->setAccidentCase($case)->setCode("START")->setOperator($operatorName)
                    ->setComments($case->getComment())->setContactThrough($case->getDriverContact())
                    ->setTimeSave(new DateTime("now"));
            $em->persist($startMonitoring);
            $em->flush();
            $caseId = $case->getId();

            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:create_case.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{caseId}/editCase", requirements={"caseId"="\d+"})
     */
    public function editCaseAction(Request $req, $caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        $form = $this->createForm(AccidentCaseEditType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:edit_case.html.twig', [
                    "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/{caseId}/firstEditCaseEnd", requirements={"caseId"="\d+"})
     */
    public function firstEditCaseEndAction(Request $req, $caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:first_edit_case_end.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{caseId}/editCaseEnd", requirements={"caseId"="\d+"})
     */
    public function editCaseEndAction(Request $req, $caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->find($caseId);
        $form = $this->createForm(AccidentCaseEditEndType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }

        return $this->render('TruckBundle:AccidentCase:edit_case_end.html.twig', [
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
    
    /**
     * @Route("/{caseId}/showStartCase", requirements={"caseId"="\d+"})
     */
    public function showStartCaseAction($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        return $this->render('TruckBundle:AccidentCase:show_start_case.html.twig', [
                    "case" => $case
        ]);
    }
    
    /**
     * @Route("/{caseId}/showEndCase", requirements={"caseId"="\d+"})
     */
    public function showEndCaseAction($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);

        return $this->render('TruckBundle:AccidentCase:show_end_case.html.twig', [
                    "case" => $case
        ]);
    }    

}
