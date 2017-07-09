<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use TruckBundle\Entity\Monitoring;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringController extends Controller
{
    /**
     * @Route("/testMon/{id}")
     */
    public function testMonAction($id = 54)
    {
        return $this->render('TruckBundle:Monitoring:test_mon.html.twig', array(
            "id" => $id
        ));
    }
    
    /**
     * @Route("/showAllMonitoringsForCase/{caseId}")
     */
    public function showAllMonitoringsForCaseAction($caseId) {
        
        return $this->render('TruckBundle:Monitoring:show_all_monitorings_for_case.html.twig', [
            //
        ]);        
    }

}
