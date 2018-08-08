<?php

namespace BooksBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReportController extends Controller
{
    /**
     * @Route("/minor", name="minor_book")
     * @Method({"GET", "POST"})
     */
    public function minorAction(Request $request)
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
            ->add('from', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Incluir desde', 'required' => false,))
            ->add('until', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Incluir hasta', 'required' => false,))
            ->add('state', ChoiceType::class,array('choices'  => array(
                'Vigente' => 'Vigente',
                'Nulo' => 'Nulo', 
                'Pendiente' => 'Pendiente', 
                'Vigente-nulo' => 'Vigente-nulo'
                ),'label' => 'Estado','attr' => array('class'=>'js-basic-single')))
            ->add('submit', SubmitType::class, array('label' => 'Buscar', 'attr' => array('class'=>"btn btn-default")))
            ->getForm();

        $searchForm->handleRequest($request);

        $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findByEnterprise($this->get('session')->get('enterprise'));

        if ($searchForm->isSubmitted() && $searchForm->isValid()) 
        {
            $data = $searchForm->getData();
            $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findByForm($this->get('session')->get('enterprise'), $data);
        }

        return $this->render('BooksBundle:Report:minor.html.twig', array(
            'accountL1s' => $accountL1s,
            'searchForm' => $searchForm->createView()
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
