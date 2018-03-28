<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\AccountL1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Accountl1 controller.
 *
 * @Route("accountl1")
 */
class AccountL1Controller extends Controller
{
    /**
     * Lists all accountL1 entities.
     *
     * @Route("/", name="accountl1_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findAll();

        return $this->render('accountl1/index.html.twig', array(
            'accountL1s' => $accountL1s,
        ));
    }

    /**
     * Creates a new accountL1 entity.
     *
     * @Route("/new", name="accountl1_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if(is_null($this->get('session')->get('enterprise')))
        {
            $this->addFlash(
                'notice',
                array(
                    'alert' => 'warning',// danger, warning, info, success
                    'title' => 'Sin Empresa: ',
                    'message' => 'Debe seleccionar la empresa con la que va a trabajar primero'
                )
            );

            return $this->redirectToRoute('enterprise_show');
        }

        $setted_enterprise = $this->get('session')->get('enterprise');

        $em = $this->getDoctrine()->getManager();
        $enterprise = $em->getRepository('BooksBundle:Enterprise')->find($setted_enterprise->getId());

        $accountL1 = new Accountl1();
        $accountL1->setEnterprise($enterprise);
        $form = $this->createForm('BooksBundle\Form\AccountL1Type', $accountL1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($accountL1);
            $em->flush();

            return $this->redirectToRoute('accountl1_show', array('id' => $accountL1->getId()));
        }

        return $this->render('accountl1/new.html.twig', array(
            'accountL1' => $accountL1,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a accountL1 entity.
     *
     * @Route("/{id}", name="accountl1_show")
     * @Method("GET")
     */
    public function showAction(AccountL1 $accountL1)
    {
        $deleteForm = $this->createDeleteForm($accountL1);

        return $this->render('accountl1/show.html.twig', array(
            'accountL1' => $accountL1,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing accountL1 entity.
     *
     * @Route("/{id}/edit", name="accountl1_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AccountL1 $accountL1)
    {
        $deleteForm = $this->createDeleteForm($accountL1);
        $editForm = $this->createForm('BooksBundle\Form\AccountL1Type', $accountL1);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accountl1_edit', array('id' => $accountL1->getId()));
        }

        return $this->render('accountl1/edit.html.twig', array(
            'accountL1' => $accountL1,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a accountL1 entity.
     *
     * @Route("/{id}", name="accountl1_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AccountL1 $accountL1)
    {
        $form = $this->createDeleteForm($accountL1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($accountL1);
            $em->flush();
        }

        return $this->redirectToRoute('accountl1_index');
    }

    /**
     * Creates a form to delete a accountL1 entity.
     *
     * @param AccountL1 $accountL1 The accountL1 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AccountL1 $accountL1)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accountl1_delete', array('id' => $accountL1->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
