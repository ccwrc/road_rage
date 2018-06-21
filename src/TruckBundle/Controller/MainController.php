<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

final class MainController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction(): Response
    {
        return $this->render('TruckBundle:Main:index.html.twig');
    }

    /**
     * @Route("/warningInformation/{message}", requirements={"message"="[\s\w\.\,]{0,5000}"})
     */
    public function warningInformationAction(?string $message = "No warnings."): Response
    {
        return $this->render('TruckBundle:Main:warning_information.html.twig', [
            "message" => $message
        ]);
    }
}
