<?php

namespace BiblioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use BiblioBundle\Entity\Livre;
use BiblioBundle\Form\Type\LivreFormType;


/**
 * @Route("/livres")
 */

class LivreController extends Controller
{
    /**
     * @Route("/add", name="addbook")
     * @Method({"POST","GET"})
     */
    public function addAction(Request $request)
    {
        $f = new Livre();
        $form = $this->createForm( LivreFormType::class, $f);
        
        $form->handleRequest($request);
        if($form->isValid()){
            
            //$duree = $form['duree']->getData();
            
            
            $f->setAnnee("2010-10-10");
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($f);
            $em -> flush();
            Return $this->redirectToRoute('listbooks');
        }
        //return $this->render('BiblioBundle:Default:index.html.twig');
        return $this->render('@Biblio/Livre/add.html.twig', [
            'formulaire'      =>  $form->createView()
        ]);
        
    }
    /**
     * @Route("/list", name="listbooks")
     * @Method({"POST","GET"})
     */
    public function listAction(Request $request)
    {
        $doctrine = $this -> getDoctrine();
        $repository = $doctrine ->getRepository("BiblioBundle:Livre");
        $livres = $repository->findAll();
        return $this->render('@Biblio/Livre/list.html.twig', [
            'livres' => $livres
        ]);
    }
    
    /**
     * @Route("/modify/{id}", name="modifybooks")
     * @Method({"POST","GET"})
     */
    public function modifyAction(Request $request)
    {
        $id = $request->get('id');
        
        $doctrine = $this -> getDoctrine();
        $repository = $doctrine ->getRepository("BiblioBundle:Livre");
        $livre = $repository->find($id);
        $form = $this->createForm( LivreFormType::class, $livre);
        
        
        $form->handleRequest($request);
        if($form->isValid()){

            
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($livre);
            $em -> flush();
            return $this->redirectToRoute('listbooks');
        }
        return $this->render('@Biblio/Livre/list.html.twig', [
            'formulaire' => $form
        ]);
    }
}
