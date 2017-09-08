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
    
    protected function getOperatorName() {
        return $this->container->get("security.context")->getToken()->getUser()
                ->getUsername();
    }    
    
    /**
     * @Route("/caseProgressColorManual")
     */
    public function caseProgressColorManualAction() {
        return $this->render('TruckBundle:AccidentCase:case_progress_color_manual.html.twig');
    }  
    
    /**
     * @Route("/{vehicleId}/createCase", requirements={"vehicleId"="\d+"})
     */
    public function createCaseAction(Request $req, $vehicleId) {
        $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($vehicleId);
        $case = new AccidentCase();
        $case->setVehicle($vehicle)->setProgressColor("#FF7575")->setStatus("active")
                ->setReportLate(0)->setReportRsTime(0)->setReportNrsTime(0)
                ->setReportRepairTotal(0)->setReportArrivalTime(0)->setReportCaseTotal(0)
                ->setReportRepairStatus("initialization"); 
        $form = $this->createForm(AccidentCaseType::class, $case);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $case = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($case);
           
            $operatorName = $this->getOperatorName();
            $monitoringStart = new Monitoring();
            $monitoringStart->setAccidentCase($case)->setCode("START")->setOperator($operatorName)
                    ->setComments($case->getComment())->setContactThrough($case->getDriverContact())
                    ->setTimeSave(new DateTime("now"));
            $em->persist($monitoringStart);
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
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
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
        // TODO add caseId + info in view
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
       // TODO add caseId + info in view
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
       // TODO add caseId + info in view
        return $this->render('TruckBundle:AccidentCase:edit_case_end.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{caseId}/showAllCases", requirements={"caseId"="\d+"})
     */
    public function showAllCasesAction($caseId = 0) {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->findAll();

        return $this->render('TruckBundle:AccidentCase:show_all_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
        ]);
    }

    /**
     * @Route("/{caseId}/showAllActiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllActiveCasesAction($caseId = 0) {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->findAllActiveCases();

        return $this->render('TruckBundle:AccidentCase:show_all_active_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
        ]);
    }
    
    /**
     * @Route("/{caseId}/showAllInactiveCases", requirements={"caseId"="\d+"})
     */
    public function showAllInactiveCasesAction($caseId = 0) {
        $cases = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                ->findAllInactiveCases();

        return $this->render('TruckBundle:AccidentCase:show_all_inactive_cases.html.twig', [
                    "cases" => $cases,
                    "caseId" => $caseId
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
    
    /**
     * @Route("/{caseId}/activateDeactivateCase", requirements={"caseId"="\d+"})
     */
    public function activateDeactivateCaseAction($caseId) {
        $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")->find($caseId);
        if ($case->getStatus() === "active" && $case->getProgressColor() === "#E6E6E6") {
            $case->setStatus("inactive");
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => 0
            ]);
        } else {
            $case->setStatus("active");
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $caseId
            ]);
        }
    }

}
