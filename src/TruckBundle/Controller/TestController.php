<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// use Symfony\Component\HttpFoundation\Response; //pdfTestAction
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use DateTime;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\Document;
use TruckBundle\Entity\Monitoring;
use TruckBundle\Entity\User;
use TruckBundle\Entity\Vehicle;

/**
 * @Route("/test")
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 */
class TestController extends Controller {
    
    /**
     * @Route("/jsonTest")
     */
    public function jsonTestAction(Request $req) {
        $data = "fail";
        $vin = $req->query->get('vin');

        if (preg_match('/^\w{8}$/', $vin) == 1) {
            $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                    ->findOneByVin($vin);
            if ($vehicle !== null) {
                $data = $vehicle->getId();
            }
        }

        //$data = "fail";
        return new JsonResponse($data);
    }
    
    /**
     * @Route("/dumpUser")
     */
    public function dumpUserAction() {
        $user = $this->getUser();
        $container = $this->container;

        return $this->render('TruckBundle:Test:dump_user.html.twig', array(
                    "user" => $user,
                    "container" => $container
        ));
    }

    /**
     * @Route("/test")
     */
    public function testAction() {
        $userId = $this->getUser()->getId();
        
        $result = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->countUserPrivateNotesFromLast24h($userId);

        return $this->render('TruckBundle:Test:test.html.twig', array(
                    "result" => $result
        ));
    }

//    /**
//     * @Route("/pdfTest")
//     */
//    public function pdfTestAction() {
//        // https://github.com/barryvdh/laravel-snappy/issues/9
//        //  rvanlaak commented on 7 Mar 2016 
//        // $this->get('knp_snappy.pdf')->getInternalGenerator()->setTimeout(300);
//        $html = $this->renderView('TruckBundle:Test:pdf_test.html.twig');
//        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
//
//        return new Response(
//                $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
//        ]);
//    }    
    
    /**
     * for stress test in sim. prod. env.
     * @Route("/fillDatabase")
     */
    public function fillDatabaseAction() {
        $dealerActiveGenerate = false;
        // $dealerActiveGenerate = true;
        $dealerInactiveGenerate = false;
        // $dealerInactiveGenerate = true;
        $dealerSuspendedGenerate = false;
        // $dealerSuspendedGenerate = true;
        $vehicleGenerate = false;
        // $vehicleGenerate = true;
        $accidentCaseActiveGenerate = false;
        // $accidentCaseActiveGenerate = true;
        $accidentCaseInactiveGenerate = false;
        // $accidentCaseInactiveGenerate = true;
        $monitoringIncomingGenerate = false;
        // $monitoringIncomingGenerate = true;
        $monitoringOutGenerate = false;
        // $monitoringOutGenerate = true;
        
        $em = $this->getDoctrine()->getManager();
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
            // vin: XY + $i (last 8 characters from vin -> $i must be 6 digit)
            for ($i = 200100; $i <= 202100; $i++) {
                $vehicle = new Vehicle();
                $vehicle->setCity("city" . $i);
                $vehicle->setCompanyName("com name" . $i);
                $vehicle->setContactPerson("person" . $i);
                
                $dealer = $this->getDoctrine()->getRepository("TruckBundle:Dealer")
                        ->find(mt_rand(2, 300));
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

                $em->persist($vehicle);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' vehicleDone || ';
        }       
        
        if ($accidentCaseActiveGenerate) {
            for ($i = 1; $i <= 40; $i++) {
                $ac = new AccidentCase();
                $ac->setComment("case comment" . $i);
                $ac->setDamageDescription("damage description" . $i);
                $ac->setDriverContact("contact to driver" . $i);
                $ac->setLocation("vehicle location " . $i);

                $date = new \DateTime("now - " . mt_rand(1, 2000) . "minutes");
                $ac->setTimeStart($date);

                $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                        ->find(mt_rand(2, 1990));
                $ac->setVehicle($vehicle);
                //
                $em->persist($ac);

                $monitoringStart = new Monitoring();
                $monitoringStart->setAccidentCase($ac)->setCode("START")->setOperator("op name")
                        ->setComments($ac->getComment())
                        ->setContactThrough($ac->getDriverContact());
                $em->persist($monitoringStart);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' accidentCaseActiveDone || ';
        }
        
        if ($accidentCaseInactiveGenerate) {
            for ($i = 1; $i <= 3000; $i++) {
                $ac = new AccidentCase();
                $ac->setComment("case comment" . $i);
                $ac->setDamageDescription("damage description" . $i);
                $ac->setDriverContact("contact to driver" . $i);
                $ac->setLocation("vehicle location " . $i);
                $ac->setStatus("inactive");
                $ac->setProgressColor("#E6E6E6");

                $date = new \DateTime("now - " . mt_rand(1, 2000) . "hours");
                $ac->setTimeStart($date);

                $vehicle = $this->getDoctrine()->getRepository("TruckBundle:Vehicle")
                        ->find(mt_rand(2, 1990));
                $ac->setVehicle($vehicle);

                $em->persist($ac);

                $monitoringStart = new Monitoring();
                $monitoringStart->setAccidentCase($ac)->setCode("START")->setOperator("op name")
                        ->setComments($ac->getComment())
                        ->setContactThrough($ac->getDriverContact());
                $em->persist($monitoringStart);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' accidentCaseInactiveDone || ';
        }    
        
        if ($monitoringIncomingGenerate) {
            for ($i = 1; $i <= 3000; $i++) {
                $monitoring = new Monitoring();

                $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                        ->find(mt_rand(2, 2990));
                $monitoring->setAccidentCase($case)->setOperator("opName")
                        ->setCode("Incoming")->setContactThrough("test con")
                        ->setComments("test comment");

                $em->persist($monitoring);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' monitoringIncomingDone || ';
        }
        
        if ($monitoringOutGenerate) {
            for ($i = 1; $i <= 5000; $i++) {
                $monitoring = new Monitoring();

                $case = $this->getDoctrine()->getRepository("TruckBundle:AccidentCase")
                        ->find(mt_rand(2, 2990));
                $monitoring->setAccidentCase($case)->setOperator("opName")
                        ->setCode("Out")->setContactThrough("test con out")
                        ->setComments("test comment monitoring out");

                $em->persist($monitoring);
            }
            $em->flush();
            $message .= (date('H:i:s')) . ' monitoringOutDone || ';
        }        

        return $this->render('TruckBundle:Test:fill_database.html.twig', array(
                    "message" => $message
        ));
    }

}
