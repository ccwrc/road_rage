<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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

}
