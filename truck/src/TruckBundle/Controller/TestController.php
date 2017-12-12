<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response; //pdfTestAction

use DateTime;

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
class TestController extends Controller {

    /**
     * @Route("/test")
     */
    public function testAction() {
        return $this->render('TruckBundle:Test:test.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/pdf")
     */
    public function pdfAction() {
        return $this->render('TruckBundle:Test:pdf.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/pdfTest")
     */
    public function pdfTestAction() {
        // https://github.com/barryvdh/laravel-snappy/issues/9
        //  rvanlaak commented on 7 Mar 2016 
        // $this->get('knp_snappy.pdf')->getInternalGenerator()->setTimeout(300);
        $html = $this->renderView('TruckBundle:Test:pdf_test.html.twig');
        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
        ]);
    }    
    
    /**
     * for stress test in sim. prod. env.
     * @Route("/fillDatabase")
     */
    public function fillDatabaseAction() {
        $dealerActiveGenerate = false;
        $dealerInactiveGenerate = false;
        $dealerSuspendedGenerate = false;
        $vehicleGenerate = true;
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $message = (date('H:i:s')) . ' START || ';
        
        if ($dealerActiveGenerate) {
            for ($i = 1; $i <= 50; $i++) {
                $dealer = new Dealer();
                $dealer->setAltMail1("yu@pp.elo");
                $dealer->setAltPhone2("123456789");
                $dealer->setCity("city" . $i);
                $dealer->setIsActive("active");
                $dealer->setMainFax("123456788");
                $dealer->setMainMail($i . "mail@gmail.elo");
                $dealer->setMainPhone($i . "123456789");
                $dealer->setName("dealer" . $i);
                $dealer->setOtherComments("comment " . $i);
                $dealer->setPhone24h($i . "999000888");
                $dealer->setPhoneServiceCar("888" . $i . "123123");
                $dealer->setStreet("dealer street" . $i);
                $dealer->setZipCode(mt_rand(10, 99) . "-223");
                $em->persist($dealer);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' dealerActiveDone || ';
        }
        
        if ($dealerInactiveGenerate) {
            for ($i = 1; $i <= 250; $i++) {
                $dealer = new Dealer();
                $dealer->setAltMail1("yu@pp.elo");
                $dealer->setAltPhone2("123456789");
                $dealer->setCity("city" . $i);
                $dealer->setIsActive("inactive");
                $dealer->setMainFax("123456788");
                $dealer->setMainMail($i . "mailp@gmail.elo");
                $dealer->setMainPhone($i . "123456789");
                $dealer->setName("inact dealer" . $i);
                $dealer->setOtherComments("comment " . $i);
                $dealer->setPhone24h($i . "999000888");
                $dealer->setPhoneServiceCar("888" . $i . "123123");
                $dealer->setStreet("dealer street" . $i);
                $dealer->setZipCode(mt_rand(10, 99) . "-223");
                $em->persist($dealer);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' dealerInactiveDone || ';
        }   
        
        if ($dealerSuspendedGenerate) {
            for ($i = 1; $i <= 20; $i++) {
                $dealer = new Dealer();
                $dealer->setAltMail1("yu@pp.elo");
                $dealer->setAltPhone2("123456789");
                $dealer->setCity("city" . $i);
                $dealer->setIsActive("suspended");
                $dealer->setMainFax("123456788");
                $dealer->setMainMail($i . "mails@gmail.elo");
                $dealer->setMainPhone($i . "123456789");
                $dealer->setName("sus dealer" . $i);
                $dealer->setOtherComments("comment " . $i);
                $dealer->setPhone24h($i . "999000888");
                $dealer->setPhoneServiceCar("888" . $i . "123123");
                $dealer->setStreet("dealer street" . $i);
                $dealer->setZipCode(mt_rand(10, 99) . "-223");
                $em->persist($dealer);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' dealerSuspendedDone || ';
        }         
        
        if ($vehicleGenerate) { 
            // vin: XY + $i (last 8 characters from vin)
            for ($i = 20100; $i <= 22100; $i++) {
                $vehicle = new Vehicle();
                $vehicle->setCity("city" . $i);
                $vehicle->setCompanyName("com name" . $i);
                $vehicle->setContactPerson("person" . $i);
                
                $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")->find(mt_rand(2, 300));
                $vehicle->setDealer($dealer);
                $vehicle->setGuaranteeType("dummy");
                $vehicle->setMileage("22" . $i);
                $vehicle->setNameType("truck" . $i);
                $vehicle->setPhone("1231231233");
                
                $date = new \DateTime("now - " . mt_rand(1, 2000) . "days");
                $vehicle->setPurchaseDate($date);
                $vehicle->setRegistrationNumber("reg" . $i);
                $vehicle->setStreet("street" . $i);
                $vehicle->setTaxIdNumber("taxie" . $i);
                $vehicle->setVin("XY" . $i); 
                $vehicle->setZipCode(mt_rand(10, 99) . "-998");
                //
                $em->persist($vehicle);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' vehicleDone || ';
        }         

        return $this->render('TruckBundle:Test:fill_database.html.twig', array(
                    "message" => $message
        ));
    }

}
