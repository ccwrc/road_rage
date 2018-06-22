<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TruckBundle\Entity\Note;
use TruckBundle\Form\Note\{
    NoteType, NoteEditType
};

/**
 * @Route("/note")
 * @Security("has_role('ROLE_OPERATOR')")
 */
final class NoteController extends Controller
{

    /**
     * @Route("/createNote")
     */
    public function createNoteAction(Request $req): Response
    {
        $note = new Note();
        $note->setTimePublication(new \DateTime('now'));
        $form = $this->createForm(NoteType::class, $note);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $note->setUserId($this->getUserId())
                ->setUsername($this->getUsername());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('truck_note_showuseractualnotes');
        }

        return $this->render('TruckBundle:Note:create_note.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{noteId}/editNote", requirements={"noteId"="\d+"})
     */
    public function editNoteAction(Request $req, int $noteId): Response
    {
        $note = $this->throwExceptionIfIdOrUserIdIsWrongOrGetNoteBy($noteId);
        $form = $this->createForm(NoteEditType::class, $note);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if ($note->getTimePublication() > new \DateTime('now')) {
                return $this->redirectToRoute('truck_note_showuserfuturenotes');
            }
            return $this->redirectToRoute('truck_note_showuseractualnotes');
        }

        return $this->render('TruckBundle:Note:edit_note.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/showPublicNotes")
     */
    public function showPublicNotesAction(Request $req): Response
    {
        $notesQuery = $this->getDoctrine()->getRepository('TruckBundle:Note')
            ->findAllPublicNotesQuery();

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
            $notesQuery,
            $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_public_notes.html.twig', array(
            'notes' => $notes
        ));
    }

    /**
     * @Route("/showUserActualNotes")
     */
    public function showUserActualNotesAction(Request $req): Response
    {
        $notesQuery = $this->getDoctrine()->getRepository('TruckBundle:Note')
            ->findPrivateActualNotesByUserIdQuery($this->getUserId());

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
            $notesQuery,
            $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_user_actual_notes.html.twig', array(
            'notes' => $notes
        ));
    }

    /**
     * @Route("/showUserFutureNotes")
     */
    public function showUserFutureNotesAction(Request $req): Response
    {
        $notesQuery = $this->getDoctrine()->getRepository('TruckBundle:Note')
            ->findPrivateFutureNotesByUserIdQuery($this->getUserId());

        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate(
            $notesQuery,
            $req->query->get('page', 1)/* page number */, 20/* limit per page */);

        return $this->render('TruckBundle:Note:show_user_future_notes.html.twig', array(
            'notes' => $notes
        ));
    }

    /**
     * @Route("/{noteId}/deleteActualNote", requirements={"noteId"="\d+"})
     */
    public function deleteActualNoteAction(int $noteId): Response
    {
        $note = $this->throwExceptionIfIdOrUserIdIsWrongOrGetNoteBy($noteId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute('truck_note_showuseractualnotes');
    }

    /**
     * @Route("/{noteId}/deleteFutureNote", requirements={"noteId"="\d+"})
     */
    public function deleteFutureNoteAction(int $noteId): Response
    {
        $note = $this->throwExceptionIfIdOrUserIdIsWrongOrGetNoteBy($noteId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute('truck_note_showuserfuturenotes');
    }

    /**
     * @Route("/{noteId}/deleteNote", requirements={"noteId"="\d+"})
     */
    public function deleteNoteAction(int $noteId): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CONTROL', null, 'Access denied.');
        $note = $this->throwExceptionIfIdOrStatusIsWrongOrGetNoteBy($noteId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute('truck_note_showpublicnotes');
    }

    /**
     * @param int $noteId
     * @throws NotFoundHttpException
     * @return Note
     */
    private function throwExceptionIfIdOrUserIdIsWrongOrGetNoteBy(int $noteId): Note
    {
        $note = $this->getDoctrine()->getRepository('TruckBundle:Note')->find($noteId);

        if ($note === null) {
            throw $this->createNotFoundException('Wrong note ID.');
        } else if ($note->getUserId() != $this->getUserId()) {
            throw $this->createNotFoundException('No match.');
        }
        return $note;
    }

    private function throwExceptionIfIdOrStatusIsWrongOrGetNoteBy(int $noteId): Note
    {
        $note = $this->getDoctrine()->getRepository('TruckBundle:Note')->find($noteId);

        if ($note === null) {
            throw $this->createNotFoundException('Wrong note ID.');
        } else if ($note->getStatus() == Note::$statusPrivate) {
            throw $this->createNotFoundException('Private note.');
        }
        return $note;
    }

    private function getUserId(): int
    {
        return $this->getUser()->getId();
    }

    private function getUsername(): string
    {
        return $this->getUser()->getUsername();
    }

}
