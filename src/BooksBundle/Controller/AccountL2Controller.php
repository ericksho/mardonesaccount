<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\AccountL1;
use BooksBundle\Entity\AccountL2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Accountl2 controller.
 *
 * @Route("accountl2")
 */
class AccountL2Controller extends Controller
{
    /**
     * Lists all accountL2 entities.
     *
     * @Route("/", name="accountl2_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accountL2s = $em->getRepository('BooksBundle:AccountL2')->findAll();

        return $this->render('accountl2/index.html.twig', array(
            'accountL2s' => $accountL2s,
        ));
    }

    /**
     * Creates a new accountL2 entity.
     *
     * @Route("/new/{id}", name="accountl2_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, AccountL1 $accountL1)
    {
        $accountL2 = new Accountl2();
        $accountL2->setAccountL1($accountL1); 
        $form = $this->createForm('BooksBundle\Form\AccountL2Type', $accountL2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($accountL2);
            $em->flush();

            return $this->redirectToRoute('accountl2_show', array('id' => $accountL2->getId()));
        }

        return $this->render('accountl2/new.html.twig', array(
            'accountL2' => $accountL2,
            'accountL1' => $accountL1,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accountL2 entity.
     *
     * @Route("/{id}", name="accountl2_show")
     * @Method("GET")
     */
    public function showAction(AccountL2 $accountL2)
    {
        $deleteForm = $this->createDeleteForm($accountL2);

        return $this->render('accountl2/show.html.twig', array(
            'accountL2' => $accountL2,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accountL2 entity.
     *
     * @Route("/{id}/edit", name="accountl2_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AccountL2 $accountL2)
    {
        $deleteForm = $this->createDeleteForm($accountL2);
        $editForm = $this->createForm('BooksBundle\Form\AccountL2Type', $accountL2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accountl2_edit', array('id' => $accountL2->getId()));
        }

        return $this->render('accountl2/edit.html.twig', array(
            'accountL2' => $accountL2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accountL2 entity.
     *
     * @Route("/{id}", name="accountl2_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AccountL2 $accountL2)
    {
        $form = $this->createDeleteForm($accountL2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accountL2);
            $em->flush();
        }

        return $this->redirectToRoute('accountl2_index');
    }

    /**
     * Creates a form to delete a accountL2 entity.
     *
     * @param AccountL2 $accountL2 The accountL2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountL2 $accountL2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accountl2_delete', array('id' => $accountL2->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
