<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response; //pdfTestAction

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
     * @Route("/pdfTest")
     */
    public function pdfTestAction() {
        $html = $this->renderView('TruckBundle:Main:pdf_test.html.twig');
        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
        ]);
    }

}
