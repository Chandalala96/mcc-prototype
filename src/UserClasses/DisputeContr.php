<?php 
namespace MyApp\UserClasses;

class DisputeContr extends UserManager{
	private $fullname;
	private $dispute;



	public function __construct($fullname, $dispute) {
      $this->fullname = $fullname;
      $this->dispute = $dispute;

	}

		public function addDispute() {
       $this->setDispute($this->fullname, $this->dispute);
	}


		
} 