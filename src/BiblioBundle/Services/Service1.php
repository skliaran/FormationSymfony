<?php

namespace BiblioBundle\Services;
class Service1{
	private $a;
	public function __construct(){
		$this -> a = "Bonjour, depuis service 1";
	}
	public function __toString(){
		return $this -> a;
	}
}
