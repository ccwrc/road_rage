<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentWroController extends DocumentController {

    /**
     * @Route("/createAndSendWro")
     */
    public function createAndSendWroAction() {
        
        return $this->render('TruckBundle:Document:create_and_send_wro.html.twig', array(
                        // ...
        ));
    }



}
