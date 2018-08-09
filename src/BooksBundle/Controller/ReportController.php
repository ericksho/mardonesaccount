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
            ->add('from', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Incluir desde', 'required' => true,))
            ->add('until', DateType::class, array('widget' => 'single_text', 'attr' => array('class'=>'form-control'), 'label' => 'Incluir hasta', 'required' => true,))
            ->add('state', ChoiceType::class,array('choices'  => array(
                'Vigente' => 'Vigente',
                'Nulo' => 'Nulo', 
                'Pendiente' => 'Pendiente', 
                'Vigente-nulo' => 'Vigente-nulo'
                ),'label' => 'Estado','attr' => array('class'=>'js-basic-single')))
            ->add('submit', SubmitType::class, array('label' => 'Buscar', 'attr' => array('class'=>"btn btn-default")))
            ->getForm();

        $searchForm->handleRequest($request);
        $from = '';
        $until = '';

        $vouchers = $em->getRepository('BooksBundle:Voucher')->findByEnterprise($this->get('session')->get('enterprise'));

        if ($searchForm->isSubmitted() && $searchForm->isValid()) 
        {
            $data = $searchForm->getData();
            $from = $data['from'];
            $until = $data['until'];
            
            $vouchers = $em->getRepository('BooksBundle:Voucher')->findByForm($this->get('session')->get('enterprise'), $data);
        }

        return $this->render('BooksBundle:Report:minor.html.twig', array(
            'vouchers' => $vouchers,
            'searchForm' => $searchForm->createView(),
            'from' => $from,
            'until' => $until
        ));
    }

    /**
     * @Route("/mayor", name="mayor_book")
     * @Method({"GET", "POST"})
     */
    public function mayorAction(Request $request)
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

        $from = '';
        $until = '';

        if ($searchForm->isSubmitted() && $searchForm->isValid()) 
        {
            $data = $searchForm->getData();
            
            $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findByForm($this->get('session')->get('enterprise'), $data);

            $state = $data['state'];
            $from = $data['from'];
            $until = $data['until'];

            foreach ($accountL1s as $al1) 
            {
                foreach ($al1->getAccountsL2() as $al2) 
                {
                    if(!$al2->fitMinorFilter($state, $from, $until))
                    {
                        $al1->removeAccountsL2($al2);
                    }
                    else
                    {
                        foreach ($al2->getAccountsL3() as $al3) 
                        {
                            if(!$al3->fitMinorFilter($state, $from, $until))
                            {
                                $al2->removeAccountsL3($al3);
                            }
                            else
                            {
                                foreach ($al3->getVouchers() as $v) 
                                {
                                    if(!$v->fitMinorFilter($state, $from, $until))
                                    {
                                        $al3->removeVoucher($v);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->render('BooksBundle:Report:mayor.html.twig', array(
            'accountL1s' => $accountL1s,
            'searchForm' => $searchForm->createView(),
            'from' => $from,
            'until' => $until
        ));
    }

}
