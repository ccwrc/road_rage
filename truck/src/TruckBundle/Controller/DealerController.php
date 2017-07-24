<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Dealer;

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
    public function createDealerAction() {
        $this->denyAccessUnlessGranted('ROLE_CONTROL', null, 'Access denied.');
        
        return $this->render('TruckBundle:Dealer:create_dealer.html.twig', [
            //        "form" => $form->createView()
        ]);        
    }

}
