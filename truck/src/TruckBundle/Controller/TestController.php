<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response; //pdfTestAction

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\Document;
use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\User;
use TruckBundle\Entity\Vehicle;

/**
 * @Route("/test")
 * @Security("has_role('ROLE_ADMIN')")
 */
class TestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('TruckBundle:Test:test.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pdf")
     */
    public function pdfAction()
    {
        return $this->render('TruckBundle:Test:pdf.html.twig', array(
            // ...
        ));
    }
    
    //TODO pdfTestAction - to delete with view pdf_test
    /**
     * @Route("/pdfTest")
     */
    public function pdfTestAction() {
        $html = $this->renderView('TruckBundle:Test:pdf_test.html.twig');
        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
        ]);
    }    

}
