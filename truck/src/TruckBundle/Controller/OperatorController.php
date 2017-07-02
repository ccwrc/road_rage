<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 */
class OperatorController extends Controller
{
    /**
     * @Route("/operator")
     */
    public function operatorAction()
    {
        return $this->render('TruckBundle:Operator:operator.html.twig', array(
            // ...
        ));
    }

}
