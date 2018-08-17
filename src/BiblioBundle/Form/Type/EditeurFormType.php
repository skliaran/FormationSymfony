<?php
namespace BiblioBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditeurFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('nom', TextType::class)->
                    add('adresse', TextType::class)->
                    add('save', SubmitType::class);
    }   
}