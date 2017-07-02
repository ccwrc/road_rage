<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use TruckBundle\Entity\Dealer;

/**
 * @Route("/dealer")
 */
class DealerController extends Controller
{
    /**
     * @Route("/testDealer")
     */
    public function testDealerAction()
    {
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

}
