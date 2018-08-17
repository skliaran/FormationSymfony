<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Formation;


class FormationController extends Controller
{
    
    /**
     * @Route("/liste/{id}", name="liste",  defaults = {"id" = 0})
     */
    public function listeAction(Request $request)
    {
        // replace this example code with whatever you need 
        $id = $request->get('id');
        $doctrine = $this -> getDoctrine();
        $repository = $doctrine ->getRepository("AppBundle:Formation");
        if($id==0){
            $formations = $repository->findAll();
            return $this->render('formation/liste.html.twig', [
                'formations' => $formations
            ]);
        }
        else{
            $formations = $repository->find($id);
            return $this->render('formation/details.html.twig', [
                'formation' => $formations
            ]);
        }
        
        
        
        
        

    }
    
    /**
     * @Route("/ajouter", name="ajouter")
     * @Method({"POST","GET"})
     */
    public function ajouterAction(Request $request)
    {
        // replace this example code with whatever you need
        $form = $this->createFormBuilder()->add('titre', TextType::class)->
        add('duree', TextType::class)->add('contenu',TextType::class)->
        add('duree',TextType::class)->add('datedebut', TextType::class)->
        add('datefin', TextType::class)->add('prix',TextType::class)->
        add('submit', SubmitType::class)->getForm();
        
        $form->handleRequest($request);
          if($form->isValid()){
            $titre = $form['titre']->getData();
            $duree = $form['duree']->getData();
            $prix = $form['prix']->getData();
            $contenu = $form['contenu']->getData();
            $datefin = $form['datedefin']->getData();
            $datedebut = $form['datededebut']->getData();

            
            
            $f = new Formation();
            $f->setTitre($titre);
            $f->setDuree($duree);
            $f->setContenu($contenu);
            $f -> setPrix($prix);
            $f -> setDateDebut($datedebut); 
            $f -> setDateFin($datefin);
            
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($f);
            $em -> flush();
            Return $this->redirectToRoute('liste');
            
            
            
        } 
        return $this->render('formation/ajouter.html.twig', [
            'formulaire'      =>  $form->createView()
        ]);

        
    }
    
    /**
     * @Route("/modifier/{id}", name="modifier", defaults = {"id" = null} )
     * Method("POST")
     */
    public function modifierAction(Request $request)
    {
        $id = $request->get('id');
        
        $doctrine = $this -> getDoctrine();
        $repository = $doctrine ->getRepository("AppBundle:Formation");
        $formation = $repository->find($id);
        
        
        
        
        $form = $this->createFormBuilder( $formation )->add('titre', TextType::class)->
        add('duree', TextType::class)->add('contenu',TextType::class)->
        add('duree',TextType::class)->add('datedebut', TextType::class)->
        add('datefin', TextType::class)->add('prix',TextType::class)->
        add('submit', SubmitType::class)->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $titre = $form['titre']->getData();
            $duree = $form['duree']->getData();
            $prix = $form['prix']->getData();
            $contenu = $form['contenu']->getData();
            $datefin = $form['datefin']->getData();
            $datedebut = $form['datedebut']->getData();
            
            
            
       
            
            $formation->setTitre($titre);
            $formation->setDuree($duree);
            $formation->setContenu($contenu);
            $formation -> setPrix($prix);
            $formation -> setDateDebut($datedebut);
            $formation -> setDateFin($datefin);
            
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($formation);
            $em -> flush();
            return $this->redirectToRoute('liste', array('id' => 4));
        }

        
    
        
        return $this->render('formation/modifier.html.twig', [
            'formulaire'      =>  $form->createView()
        ]);
        
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", defaults = {"id" = 0})
     */
    public function supprimerAction(Request $request)
    {
        // replace this example code with whatever you need
       $id = $request->get('id');
       $repository =  $this->getDoctrine()->getRepository("AppBundle:Formation");
       $formation = $repository->find($id);
       $em = $this->getDoctrine()->getManager();
       $em->remove($formation);
       $em->flush();
       Return $this->redirectToRoute('liste');
       
    }
    
}
