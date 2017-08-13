<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {

        return $this->render('TruckBundle:Main:index.html.twig', [
                        //...
        ]);
    }

    /**
     * @Route("wrongParameterInfo")
     */
    public function wrongParameterInfoAction() {

        return $this->render('TruckBundle:Main:wrong_parameter_info.html.twig', [
                        //...
        ]);
    }

}
