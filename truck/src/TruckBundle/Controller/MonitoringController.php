<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Monitoring;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 */
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
