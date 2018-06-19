<?php

namespace BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
    	$setted_enterprise = null;
    	if(!is_null($this->get('session')->get('enterprise')))
    	{
    	   return $this->redirectToRoute('enterprise_index');
    	}
        else
        {
            return $this->redirectToRoute('enterprise_index');
        }
        return $this->render('BooksBundle:Default:index.html.twig');
    }

    /**
     * @Route("/salirEmpresa", name="exit_enterprise")
     */
    public function exitEnterpriseAction()
    {
        $this->get('session')->remove('enterprise');
        return $this->redirectToRoute('home');
    }
}
