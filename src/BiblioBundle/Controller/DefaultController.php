<?php

namespace BiblioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueilBiblio")
     * @Method({"POST","GET"})
     */
    public function indexAction(Request $request)
    {
        //return $this->render('BiblioBundle:Default:index.html.twig');
        
        return $this->render('@Biblio/default/index.html.twig', [
        ]);
        
    }
}
