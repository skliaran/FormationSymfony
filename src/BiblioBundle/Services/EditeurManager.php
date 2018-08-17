<?php

namespace BiblioBundle\Services;
use Doctrine\ORM\EntityManager;
use BiblioBundle\Entity\Editeur;

class EditeurManager{
    private $_em;
    private $_repository;
    public function __construct(EntityManager $em){
        $this -> _em = $em;
        $this -> _repository = $this->_em->getRepository('BiblioBundle:Editeur');
    }
    
    public function addEditeur($Editeur){
        $this -> _em->persist($Editeur);
        $this -> _em ->flush();
    }   
}
 