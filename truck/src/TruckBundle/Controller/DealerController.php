<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Dealer;
use TruckBundle\Form\DealerType;

/**
 * @Route("/dealer")
 * @Security("has_role('ROLE_DEALER')")
 */
class DealerController extends Controller {

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
     * @Route("/showDealer/{id}", requirements={"id"="\d+"})
     */
    public function showDealerAction($id) {
        $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->find($id);
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
                        "id" => $dealerId
            ]);
        }

        return $this->render('TruckBundle:Dealer:create_dealer.html.twig', [
                    "form" => $form->createView()
        ]);
    }

}
