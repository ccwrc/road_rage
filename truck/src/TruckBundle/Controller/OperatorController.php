<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/operator")
 */
class OperatorController extends Controller {
    
    /**
     * @Route("/panel")
     */
    public function panelAction()
    {
        return $this->render('TruckBundle:Operator:panel.html.twig', array(
            // ...
        ));
    }

}
