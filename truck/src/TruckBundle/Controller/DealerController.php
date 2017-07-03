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
     * @Route("/testDealer")
     */
    public function testDealerAction() {
        return $this->render('TruckBundle:Dealer:test_dealer.html.twig', array(
                        // ...
        ));
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
     * @Route("/showDealer/{id}", requirements={"id"="\d+"})
     */
    public function showDealerAction($id) {
        $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->find($id);

        return $this->render('TruckBundle:Dealer:show_dealer.html.twig', [
                    "dealer" => $dealer
        ]);
    }

}
