<?php

namespace BiblioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use BiblioBundle\Form\Type\EditeurFormType;
use BiblioBundle\Entity\Editeur;

/**
 * @Route("/editeur")
 */
class EditeurController extends Controller
{
    /**
     * @Route("/add", name="add")
     * @Method({"POST","GET"})
     */
    public function addAction(Request $request)
    {
        $editm = $this->get('biblio.editeurmanager');
        
        
       /* $form = $this->createFormBuilder()->add('nom', TextType::class)->
        add('adresse', TextType::class)->
        add('submit', SubmitType::class)->getForm();*/
          $f = new Editeur();
          $form = $this->createForm( EditeurFormType::class, $f);
        
        $form->handleRequest($request);
        if($form->isValid()){  
            
            
            $editm->addEditeur($f);
            
            
           /*$em = $this->getDoctrine()->getManager();
           $em -> persist($f);
           $em -> flush();*/
           Return $this->redirectToRoute('list');
        }
        //return $this->render('BiblioBundle:Default:index.html.twig');        
        return $this->render('@Biblio/Editeur/add.html.twig', [
            'formulaire'      =>  $form->createView()
        ]);
    }
    
    /**
     * @Route("/remove/{id}", name="remove", defaults = {"id" = 0})
     * @Method({"POST","GET"})
     */
    public function removeAction(Request $request)
    {
        $id = $request->get('id');
        $repository =  $this->getDoctrine()->getRepository("BiblioBundle:Editeur");
        $editeur = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($editeur);
        $em->flush();
        Return $this->redirectToRoute('list');
    }
    
    /**
     * @Route("/modify", name="modify")
     * @Method({"POST","GET"})
     */
    public function modifyAction(Request $request)
    {
        
        $form = $this->createFormBuilder()->add('nom', TextType::class)->
        add('adresse', TextType::class)->
        add('submit', SubmitType::class)->getForm();
        $form->handleRequest($request);
        //return $this->render('BiblioBundle:Default:index.html.twig');
        
        return $this->render('@Biblio/Editeur/modify.html.twig', [
            'formulaire'      =>  $form->createView()
        ]);
    }
    
    /**
     * @Route("/list", name="list")
     * @Method({"POST","GET"})
     */
    public function listeAction(Request $request)
    {
        $doctrine = $this -> getDoctrine();
        $repository = $doctrine ->getRepository("BiblioBundle:Editeur");
            $editeurs = $repository->findAll();
            return $this->render('@Biblio/Editeur/list.html.twig', [
                'editeurs' => $editeurs
            ]);   
    }
    
    /**
     * @Route("/afficherlivre/{id}", name="afficherlivres")
     * @Method({"POST","GET"})
     */
    public function afficherLivresAction(Request $request)
    {
        $id = $request->get('id');
       
        $repository =  $this->getDoctrine()->getRepository("BiblioBundle:Editeur");
        $editeur = $repository->find($id);
        $service1 = $this->get('biblio.service1');
        
   
        return $this->render('@Biblio/Editeur/afficherlivres.html.twig', [
            'editeur' => $editeur, 'service1' => $service1
        ]); 

    }
}
