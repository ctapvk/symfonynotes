<?php

namespace SerNotesBundle\Controller;

use SerNotesBundle\Entity\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Notetype controller.
 *
 * @Route("notetype")
 */
class NoteTypeController extends Controller
{
    /**
     * Lists all noteType entities.
     *
     * @Route("/", name="notetype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $noteTypes = $em->getRepository('SerNotesBundle:NoteType')->findAll();

        return $this->render('notetype/index.html.twig', array(
            'noteTypes' => $noteTypes,
        ));
    }

    /**
     * Creates a new noteType entity.
     *
     * @Route("/new", name="notetype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $noteType = new Notetype();
        $form = $this->createForm('SerNotesBundle\Form\NoteTypeType', $noteType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($noteType);
            $em->flush();

            return $this->redirectToRoute('notetype_show', array('id' => $noteType->getId()));
        }

        return $this->render('notetype/new.html.twig', array(
            'noteType' => $noteType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a noteType entity.
     *
     * @Route("/{id}", name="notetype_show")
     * @Method("GET")
     */
    public function showAction(NoteType $noteType)
    {
        $deleteForm = $this->createDeleteForm($noteType);

        return $this->render('notetype/show.html.twig', array(
            'noteType' => $noteType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing noteType entity.
     *
     * @Route("/{id}/edit", name="notetype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NoteType $noteType)
    {
        $deleteForm = $this->createDeleteForm($noteType);
        $editForm = $this->createForm('SerNotesBundle\Form\NoteTypeType', $noteType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('notetype_edit', array('id' => $noteType->getId()));
        }

        return $this->render('notetype/edit.html.twig', array(
            'noteType' => $noteType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a noteType entity.
     *
     * @Route("/{id}", name="notetype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NoteType $noteType)
    {
        $form = $this->createDeleteForm($noteType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($noteType);
            $em->flush();
        }

        return $this->redirectToRoute('notetype_index');
    }

    /**
     * Creates a form to delete a noteType entity.
     *
     * @param NoteType $noteType The noteType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NoteType $noteType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notetype_delete', array('id' => $noteType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
