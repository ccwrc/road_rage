<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DocumentController extends Controller
{
    /**
     * @Route("/createAndSendPg")
     */
    public function createAndSendPgAction()
    {
        return $this->render('TruckBundle:Document:create_and_send_pg.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/createAndSendRo")
     */
    public function createAndSendRoAction()
    {
        return $this->render('TruckBundle:Document:create_and_send_ro.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/createAndSendWpg")
     */
    public function createAndSendWpgAction()
    {
        return $this->render('TruckBundle:Document:create_and_send_wpg.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/createAndSendWro")
     */
    public function createAndSendWroAction()
    {
        return $this->render('TruckBundle:Document:create_and_send_wro.html.twig', array(
            // ...
        ));
    }

}
