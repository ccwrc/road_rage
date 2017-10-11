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
     * @Route("/warningInformation/{message}", requirements={"message"="[\s\w\.\,]{0,5000}"})
     */
    public function warningInformationAction($message = "No warnings.") {

        return $this->render('TruckBundle:Main:warning_information.html.twig', [
                    "message" => $message
        ]);
    }

    //TODO pdfTestAction - to delete with view pdf_test
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
