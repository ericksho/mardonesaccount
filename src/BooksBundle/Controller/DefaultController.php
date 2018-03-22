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
    	$setted_enterprise = "";
    	if(!is_null($this->get('session')->get('enterprise')))
    	{
    		$setted_enterprise = $this->get('session')->get('enterprise')->getName();
    	}
        return $this->render('BooksBundle:Default:index.html.twig', array(
        	'setted_enterprise'=>$setted_enterprise
        	));
    }
}
