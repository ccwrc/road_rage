<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_OPERATOR')")
 * @Route("/document")
 */
class DocumentPgController extends DocumentController {

    /**
     * @Route("/{monitoringPgId}/createAndSendPg", requirements={"monitoringPgId"="\d+"})
     */
    public function createAndSendPgAction($monitoringPgId) {
        $this->throwExceptionIfMonitoringHasWrongCodeOrId($monitoringPgId, "PG");

        $monitoringPg = $this->getDoctrine()->getRepository("TruckBundle:Monitoring")
                ->find($monitoringPgId);
        $homeDealer = $monitoringPg->getHomeDealer();
        $accidentCase = $monitoringPg->getAccidentCase();
        $accidentCaseId = $accidentCase->getId();

        if (!$this->isCaseIsActive($accidentCase) || !$this->isDealerIsActive($homeDealer)) {
            return $this->redirectToRoute("truck_operator_panel", [
                        "caseId" => $accidentCaseId
            ]);
        }

        $vehicle = $accidentCase->getVehicle();
        $operatorName = $monitoringPg->getOperator();
        $mainMail = $monitoringPg->getContactMail();
        $optionalMails = $this->getEmailsFromString($monitoringPg->getOptionalMails());
        $amount = $monitoringPg->getAmount();
        $currency = $monitoringPg->getCurrency();
        $outComment = $monitoringPg->getOutComment();

        $messagePg = $this->createMessagePg($accidentCaseId, $amount, $currency, $mainMail, 
                $optionalMails, $vehicle, $homeDealer, $outComment, $operatorName, $accidentCase);
        if ($this->get('mailer')->send($messagePg)) {
            $monitoringPg->setIsDocumentSend(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute("truck_operator_panel", [
                    "caseId" => $accidentCaseId
        ]);
    }

    private function createMessagePg($accidentCaseId, $amount, $currency, $mainMail, $optionalMails,
            $vehicle, $homeDealer, $outComment, $operatorName, $accidentCase) {
        $message = \Swift_Message::newInstance();
        $companyLogoSrc = $message->embed(\Swift_Image::fromPath('images/companyLogo.png'));
        $message->setSubject("Case number " . $accidentCaseId . " - Payment Guarantee request: " .
                        $amount . " " . $currency)
                ->setFrom(['ccwrcbadtruck@gmail.com' => 'BAD TRUCK'])
                ->setTo($mainMail)
                ->setCc($optionalMails)
                ->setBody(
                        $this->renderView(
                                'TruckBundle:Document:create_and_send_pg.html.twig', [
                            "accidentCaseId" => $accidentCaseId,
                            "amount" => $amount,
                            "currency" => $currency,
                            "vehicle" => $vehicle,
                            "homeDealer" => $homeDealer,
                            "outComment" => $outComment,
                            "operatorName" => $operatorName,
                            "accidentCase" => $accidentCase,
                            "companyLogoSrc" => $companyLogoSrc
                                ]
                        ), 'text/html'
        );
        return $message;
    }

}
