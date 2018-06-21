<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\Dealer;
use TruckBundle\Form\Dealer\DealerEditType;
use TruckBundle\Form\Dealer\DealerType;

/**
 * @Route("/dealer")
 * @Security("has_role('ROLE_DEALER')")
 */
class DealerController extends Controller
{

    /**
     * @Route("/showAllDealers")
     */
    public function showAllDealersAction(Request $req): Response
    {
        $dealersQuery = $this->getDoctrine()->getRepository('TruckBundle:Dealer')
            ->findAllDealersQuery();
        $paginator = $this->get('knp_paginator');
        $dealers = $paginator->paginate(
            $dealersQuery,
            $req->query->get('page', 1)/* page number */, 50/* limit per page */);

        return $this->render('TruckBundle:Dealer:show_all_dealers.html.twig', [
            'dealers' => $dealers
        ]);
    }

    /**
     * @Route("/showAllActiveDealers")
     */
    public function showAllActiveDealersAction(Request $req): Response
    {
        $dealersQuery = $this->getDoctrine()->getRepository('TruckBundle:Dealer')
            ->findAllActiveDealersQuery();

        $paginator = $this->get('knp_paginator');
        $dealers = $paginator->paginate(
            $dealersQuery,
            $req->query->get('page', 1)/* page number */, 50/* limit per page */);

        return $this->render('TruckBundle:Dealer:show_all_active_dealers.html.twig', [
            'dealers' => $dealers
        ]);
    }

    /**
     * @Route("/{dealerId}/showDealer", requirements={"dealerId"="\d+"})
     */
    public function showDealerAction(Request $req, int $dealerId): Response
    {
        $dealer = $this->throwExceptionOrGetDealerBy($dealerId);
        $vehiclesQuery = $this->getDoctrine()->getRepository('TruckBundle:Vehicle')
            ->findVehiclesByDealerIdQuery($dealerId);

        $paginator = $this->get('knp_paginator');
        $vehicles = $paginator->paginate(
            $vehiclesQuery,
            $req->query->get('page', 1)/* page number */, 40/* limit per page */);

        return $this->render('TruckBundle:Dealer:show_dealer.html.twig', [
            'dealer' => $dealer,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * @Route("/createDealer")
     */
    public function createDealerAction(Request $req): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CONTROL', null, 'Access denied.');

        $dealer = new Dealer();
        $form = $this->createForm(DealerType::class, $dealer);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $dealer = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($dealer);
            $em->flush();
            $dealerId = $dealer->getId();

            return $this->redirectToRoute('truck_dealer_showdealer', [
                'dealerId' => $dealerId
            ]);
        }

        return $this->render('TruckBundle:Dealer:create_dealer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{dealerId}/editDealer", requirements={"dealerId"="\d+"})
     */
    public function editDealerAction(Request $req, int $dealerId): Response
    {
        $this->denyAccessUnlessGranted('ROLE_OPERATOR', null, 'Access denied.');

        $dealer = $this->throwExceptionOrGetDealerBy($dealerId);
        $form = $this->createForm(DealerEditType::class, $dealer);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_dealer_showdealer', [
                'dealerId' => $dealerId
            ]);
        }

        return $this->render('TruckBundle:Dealer:edit_dealer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $dealerId
     * @throws NotFoundHttpException
     * @return Dealer
     */
    private function throwExceptionOrGetDealerBy(int $dealerId): Dealer
    {
        $dealer = $this->getDoctrine()->getRepository('TruckBundle:Dealer')->find($dealerId);
        if ($dealer === null) {
            throw $this->createNotFoundException('Wrong dealer ID');
        }
        return $dealer;
    }
}
