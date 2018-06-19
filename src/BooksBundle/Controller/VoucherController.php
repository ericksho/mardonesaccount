<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Voucher;
use BooksBundle\Entity\AccountL3;
use BooksBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Voucher controller.
 *
 * @Route("voucher")
 */
class VoucherController extends Controller
{
    /**
     * Lists all voucher entities.
     *
     * @Route("/", name="voucher_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vouchers = $em->getRepository('BooksBundle:Voucher')->findAll();

        return $this->render('voucher/index.html.twig', array(
            'vouchers' => $vouchers,
        ));
    }

    /**
     * Creates a new voucher entity.
     *
     * @Route("/new/{id}", name="voucher_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, AccountL3 $accountL3)
    {
        $voucher = new Voucher();
        $form = $this->createForm('BooksBundle\Form\VoucherType', $voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voucher->setAccountL3($accountL3);
            $em = $this->getDoctrine()->getManager();
            $em->persist($voucher);
            $em->flush();

            return $this->redirectToRoute('voucher_edit', array('id' => $voucher->getId()));
        }

        return $this->render('voucher/new.html.twig', array(
            'voucher' => $voucher,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a voucher entity.
     *
     * @Route("/{id}", name="voucher_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Voucher $voucher)
    {
        $deleteForm = $this->createDeleteForm($voucher);

        $itemForm = $this->createForm('BooksBundle\Form\MultiItemType', $voucher);
        $itemForm->handleRequest($request);

        if ($itemForm->isSubmitted() && $itemForm->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voucher_edit', array('id' => $voucher->getId()));
        }

        return $this->render('voucher/show.html.twig', array(
            'voucher' => $voucher,
            'delete_form' => $deleteForm->createView(),
            'itemForm' => $itemForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing voucher entity.
     *
     * @Route("/{id}/edit", name="voucher_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Voucher $voucher)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($voucher);
        $editForm = $this->createForm('BooksBundle\Form\VoucherType', $voucher);
        $editForm->handleRequest($request);

        $originalItems = new ArrayCollection();

        // Create an ArrayCollection of the current Items objects in the database
        foreach ($voucher->getItems() as $item) {
            $originalItems->add($item);
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // remove the relationship between the item and the Task
            foreach ($originalItems as $item) {
                if (false === $voucher->getItems()->contains($item)) {
                    // remove the Voucher from the item
                    $item->getVoucher()->removeElement($voucher);

                    //if it was a many-to-one relationship, remove the relationship like this
                    $item->setVoucher(null);

                    $entityManager->persist($item);

                    // if you wanted to delete the item entirely, you can also do that
                    $entityManager->remove($item);
                }
            }

            $entityManager->persist($voucher);
            $entityManager->flush();

            return $this->redirectToRoute('voucher_edit', array('id' => $voucher->getId()));
        }

        return $this->render('voucher/edit.html.twig', array(
            'voucher' => $voucher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a voucher entity.
     *
     * @Route("/{id}", name="voucher_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Voucher $voucher)
    {
        $form = $this->createDeleteForm($voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voucher);
            $em->flush();
        }

        return $this->redirectToRoute('voucher_index');
    }

    /**
     * Creates a form to delete a voucher entity.
     *
     * @param Voucher $voucher The voucher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Voucher $voucher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('voucher_delete', array('id' => $voucher->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
