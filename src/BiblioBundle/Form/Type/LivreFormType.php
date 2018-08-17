<?php
namespace BiblioBundle\Form\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('titre', TextType::class)
                    ->add('annee', TextType::class)
                    ->add('auteur', TextType::class)->
                    add('description', TextType::class)->
                    add('editeur', EntityType::class, 
                        array('class' => 'BiblioBundle:Editeur','choice_label' => 'nom'))->
                    add('save', SubmitType::class);
    }   
}