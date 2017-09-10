<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Dealer;
use TruckBundle\Form\Dealer\DealerType;
use TruckBundle\Form\Dealer\DealerEditType;

/**
 * @Route("/dealer")
 * @Security("has_role('ROLE_DEALER')")
 */
class DealerController extends Controller {
    
    protected function throwExceptionIfDealerIdIsWrong($dealerId) {
        $dealer = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")->find($dealerId);
        if ($dealer === null) {
            throw $this->createNotFoundException("Wrong dealer ID");
        }
    }    

    /**
     * @Route("/showAllDealers")
     */
    public function showAllDealersAction() {
        $dealers = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->findAll();

        return $this->render('TruckBundle:Dealer:show_all_dealers.html.twig', [
                    "dealers" => $dealers
        ]);
    }
    
    /**
     * @Route("/showAllActiveDealers")
     */
    public function showAllActiveDealersAction() {
        $dealers = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->findAllActiveDealers();

        return $this->render('TruckBundle:Dealer:show_all_active_dealers.html.twig', [
                    "dealers" => $dealers
        ]);
    }    

    /**
     * @Route("/{dealerId}/showDealer", requirements={"dealerId"="\d+"})
     */
    public function showDealerAction($dealerId) {
        $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->find($dealerId);
        $vehicles = $dealer->getVehicles();

        return $this->render('TruckBundle:Dealer:show_dealer.html.twig', [
                    "dealer" => $dealer,
                    "vehicles" => $vehicles
        ]);
    }
    
    /**
     * @Route("/createDealer")
     */
    public function createDealerAction(Request $req) {
        $this->denyAccessUnlessGranted('ROLE_CONTROL', null, 'Access denied.');

        $dealer = new Dealer();
        $form = $this->createForm(DealerType::class, $dealer);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $dealer = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($dealer);
            $em->flush();
            $dealerId = $dealer->getId();

            return $this->redirectToRoute("truck_dealer_showdealer", [
                        "dealerId" => $dealerId
            ]);
        }

        return $this->render('TruckBundle:Dealer:create_dealer.html.twig', [
                    "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/{dealerId}/editDealer", requirements={"dealerId"="\d+"})
     */
    public function editDealerAction(Request $req, $dealerId) {
        $this->denyAccessUnlessGranted('ROLE_OPERATOR', null, 'Access denied.');
        $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")
                ->find($dealerId);
        $form = $this->createForm(DealerEditType::class, $dealer);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $dealer = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("truck_dealer_showdealer", [
                        "dealerId" => $dealerId
            ]);
        }

        return $this->render('TruckBundle:Dealer:edit_dealer.html.twig', [
                    "form" => $form->createView()
        ]);
    }

}
