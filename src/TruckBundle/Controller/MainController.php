<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {

        return $this->render('TruckBundle:Main:index.html.twig');
    }

    /**
     * @Route("/warningInformation/{message}", requirements={"message"="[\s\w\.\,]{0,5000}"})
     */
    public function warningInformationAction($message = "No warnings.") {

        return $this->render('TruckBundle:Main:warning_information.html.twig', [
                    "message" => $message
        ]);
    }

}
