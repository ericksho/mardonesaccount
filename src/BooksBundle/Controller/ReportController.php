<?php

namespace BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReportController extends Controller
{
    /**
     * @Route("/minor", name="minor_book")
     */
    public function minorAction()
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

        $em = $this->getDoctrine()->getManager();

        $searchForm = $this->createFormBuilder()
            ->add('from', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Creado después del', 'required' => false,))
            ->add('until', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Creado antes del', 'required' => false,))
            ->add('state', null,array('label' => 'Nombre','attr' => array('class'=>'form-control', 'placeholder' => 'Nombre de la Oportunidad',), 'required' => false))
            ->add('submit', SubmitType::class, array('label' => 'Buscar', 'attr' => array('class'=>"btn btn-default")))
            ->getForm();

        $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findByEnterprise($this->get('session')->get('enterprise'));

        return $this->render('BooksBundle:Report:minor.html.twig', array(
            'accountL1s' => $accountL1s,
        ));
    }

    /**
     * @Route("/mayor", name="mayor_book")
     */
    public function mayorAction()
    {
        return $this->render('BooksBundle:Report:mayor.html.twig', array(
            // ...
        ));
    }

}
