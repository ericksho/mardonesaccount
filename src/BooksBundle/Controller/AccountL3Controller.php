<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\AccountL3;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Accountl3 controller.
 *
 * @Route("accountl3")
 */
class AccountL3Controller extends Controller
{
    /**
     * Lists all accountL3 entities.
     *
     * @Route("/", name="accountl3_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accountL3s = $em->getRepository('BooksBundle:AccountL3')->findAll();

        return $this->render('accountl3/index.html.twig', array(
            'accountL3s' => $accountL3s,
        ));
    }

    /**
     * Creates a new accountL3 entity.
     *
     * @Route("/new", name="accountl3_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $accountL3 = new Accountl3();
        $form = $this->createForm('BooksBundle\Form\AccountL3Type', $accountL3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($accountL3);
            $em->flush();

            return $this->redirectToRoute('accountl3_show', array('id' => $accountL3->getId()));
        }

        return $this->render('accountl3/new.html.twig', array(
            'accountL3' => $accountL3,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accountL3 entity.
     *
     * @Route("/{id}", name="accountl3_show")
     * @Method("GET")
     */
    public function showAction(AccountL3 $accountL3)
    {
        $deleteForm = $this->createDeleteForm($accountL3);

        return $this->render('accountl3/show.html.twig', array(
            'accountL3' => $accountL3,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accountL3 entity.
     *
     * @Route("/{id}/edit", name="accountl3_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AccountL3 $accountL3)
    {
        $deleteForm = $this->createDeleteForm($accountL3);
        $editForm = $this->createForm('BooksBundle\Form\AccountL3Type', $accountL3);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accountl3_edit', array('id' => $accountL3->getId()));
        }

        return $this->render('accountl3/edit.html.twig', array(
            'accountL3' => $accountL3,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accountL3 entity.
     *
     * @Route("/{id}", name="accountl3_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AccountL3 $accountL3)
    {
        $form = $this->createDeleteForm($accountL3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accountL3);
            $em->flush();
        }

        return $this->redirectToRoute('accountl3_index');
    }

    /**
     * Creates a form to delete a accountL3 entity.
     *
     * @param AccountL3 $accountL3 The accountL3 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountL3 $accountL3)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accountl3_delete', array('id' => $accountL3->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
