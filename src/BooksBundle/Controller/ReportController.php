<?php

namespace BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReportController extends Controller
{
    /**
     * @Route("/minor")
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

        $accountL1s = $em->getRepository('BooksBundle:AccountL1')->findByEnterprise($this->get('session')->get('enterprise'));

        return $this->render('BooksBundle:Report:minor.html.twig', array(
            'accountL1s' => $accountL1s,
        ));
    }

    /**
     * @Route("/mayor")
     */
    public function mayorAction()
    {
        return $this->render('BooksBundle:Report:mayor.html.twig', array(
            // ...
        ));
    }

}
