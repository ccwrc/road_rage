<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Note;
use TruckBundle\Form\Note\NoteType;
use TruckBundle\Form\Note\NoteEditType;
use DateTime;

/**
 * @Route("/note")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class NoteController extends Controller {

    /**
     * @Route("/createNote")
     */
    public function createNoteAction(Request $req) {
        $userId = $this->getUser()->getId();
        $username = $this->getUser()->getUsername();
        $note = new Note();
        $note->setTimePublication(new DateTime("now"));
        $form = $this->createForm(NoteType::class, $note);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUserId($userId)->setUsername($username);
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute("truck_note_showuseractualnotes");
        }

        return $this->render('TruckBundle:Note:create_note.html.twig', array(
                    "form" => $form->createView()
        ));
    }
    
    /**
     * @Route("/{noteId}/editNote", requirements={"noteId"="\d+"})
     */
    public function editNoteAction(Request $req, $noteId) {
        $this->throwExceptionIfIdOrUserIdIsWrong($noteId);
        $note = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->find($noteId);
        $form = $this->createForm(NoteEditType::class, $note);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_note_showuseractualnotes");
        }

        return $this->render('TruckBundle:Note:edit_note.html.twig', array(
                    "form" => $form->createView()
        ));
    }

    /**
     * @Route("/showPublicNotes")
     */
    public function showPublicNotesAction(Request $req) {
        $notesQuery = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->findAllPublicNotesQuery();

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
                $notesQuery, $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_public_notes.html.twig', array(
                    "notes" => $notes
        ));
    }

    /**
     * @Route("/showUserActualNotes")
     */
    public function showUserActualNotesAction(Request $req) {
        $userId = $this->getUser()->getId();
        $notesQuery = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->findPrivateActualNotesByUserIdQuery($userId);

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
                $notesQuery, $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_user_actual_notes.html.twig', array(
                    "notes" => $notes
        ));
    }

    /**
     * @Route("/showUserFutureNotes")
     */
    public function showUserFutureNotesAction(Request $req) {
        $userId = $this->getUser()->getId();
        $notesQuery = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->findPrivateFutureNotesByUserIdQuery($userId);

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
                $notesQuery, $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_user_future_notes.html.twig', array(
                    "notes" => $notes
        ));
    }

    /**
     * @Route("/{noteId}/deleteActualNote", requirements={"noteId"="\d+"})
     */
    public function deleteActualNoteAction($noteId) {
        $this->throwExceptionIfIdOrUserIdIsWrong($noteId);
        $note = $this->getDoctrine()->getRepository("TruckBundle:Note")->find($noteId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute("truck_note_showuseractualnotes");
    }

    protected function throwExceptionIfIdOrUserIdIsWrong($noteId) {
        $note = $this->getDoctrine()->getRepository("TruckBundle:Note")->find($noteId);
        $userId = $this->getUser()->getId();

        if ($note === null) {
            throw $this->createNotFoundException("Wrong note ID.");
        } else if ($note->getUserId() != $userId) {
            throw $this->createNotFoundException("No match.");
        }
    }

}
