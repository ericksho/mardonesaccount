<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Enterprise;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Enterprise controller.
 *
 * @Route("enterprise")
 */
class EnterpriseController extends Controller
{
    /**
     * Lists all enterprise entities.
     *
     * @Route("/", name="enterprise_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $enterprises = $em->getRepository('BooksBundle:Enterprise')->findAll();

        return $this->render('enterprise/index.html.twig', array(
            'enterprises' => $enterprises,
        ));
    }

    /**
     * Creates a new enterprise entity.
     *
     * @Route("/new", name="enterprise_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $enterprise = new Enterprise();
        $form = $this->createForm('BooksBundle\Form\EnterpriseType', $enterprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enterprise);
            $em->flush();

            return $this->redirectToRoute('enterprise_show', array('id' => $enterprise->getId()));
        }

        return $this->render('enterprise/new.html.twig', array(
            'enterprise' => $enterprise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a enterprise entity.
     *
     * @Route("/{id}", name="enterprise_show")
     * @Method("GET")
     */
    public function showAction(Enterprise $enterprise)
    {
        $deleteForm = $this->createDeleteForm($enterprise);

        return $this->render('enterprise/show.html.twig', array(
            'enterprise' => $enterprise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing enterprise entity.
     *
     * @Route("/{id}/edit", name="enterprise_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Enterprise $enterprise)
    {
        $deleteForm = $this->createDeleteForm($enterprise);
        $editForm = $this->createForm('BooksBundle\Form\EnterpriseType', $enterprise);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enterprise_edit', array('id' => $enterprise->getId()));
        }

        return $this->render('enterprise/edit.html.twig', array(
            'enterprise' => $enterprise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a enterprise entity.
     *
     * @Route("/{id}", name="enterprise_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Enterprise $enterprise)
    {
        $form = $this->createDeleteForm($enterprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($enterprise);
            $em->flush();
        }

        return $this->redirectToRoute('enterprise_index');
    }

    /**
     * Creates a form to delete a enterprise entity.
     *
     * @param Enterprise $enterprise The enterprise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Enterprise $enterprise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enterprise_delete', array('id' => $enterprise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
