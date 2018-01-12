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
 * @Security("has_role('ROLE_DEALER')")
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

            return $this->redirectToRoute("truck_note_showusernotes");
        }

        return $this->render('TruckBundle:Note:create_note.html.twig', array(
                    "form" => $form->createView()
        ));
    }
    
    /**
     * @Route("/{noteId}/editNote", requirements={"noteId"="\d+"})
     */
    public function editNoteAction(Request $req, $noteId) {
        // TODO $this->throwExceptionIf...
        $note = $this->getDoctrine()->getRepository("TruckBundle:Note")
                ->find($noteId);
        $form = $this->createForm(NoteEditType::class, $note);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("truck_note_showusernotes");
        }

        return $this->render('TruckBundle:Note:edit_note.html.twig', array(
                    "form" => $form->createView()
        ));
    }

    /**
     * @Route("/showPublicNotes")
     */
    public function showPublicNotesAction() {
        return $this->render('TruckBundle:Note:show_public_notes.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/showUserNotes")
     */
    public function showUserNotesAction() {
        return $this->render('TruckBundle:Note:show_user_notes.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/deleteNote")
     */
    public function deleteNoteAction() {
        return $this->render('TruckBundle:Note:delete_note.html.twig', array(
                        // ...
        ));
    }
    
    protected function throwExceptionIfIdOrUserIdIsWrong($noteId) {
        $note = $this->getDoctrine()->getRepository("TruckBundle:Note")->find($noteId);
        $userId = $this->getUser()->getId();
        
        if ($note === null) {
            throw $this->createNotFoundException("Wrong note ID");
        } else if ($note->getUserId() != $userId) {
             throw $this->createNotFoundException("Wrong note ID");
        }
    }    

}
