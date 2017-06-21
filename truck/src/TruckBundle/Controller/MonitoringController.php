<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use TruckBundle\Entity\Monitoring;

class MonitoringController extends Controller
{
    /**
     * @Route("/testMon")
     */
    public function testMonAction()
    {
        return $this->render('TruckBundle:Monitoring:test_mon.html.twig', array(
            // ...
        ));
    }

}
