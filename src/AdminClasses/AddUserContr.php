<?php 

namespace MyApp\AdminClasses;

class AddUserContr extends AdminManager{
	private $fullname;
	private $email;
	private $category;
	private $status;
	private $defaultPwd;


	public function __construct($fullname, $email, $category, $status, $defaultPwd) {
      $this->fullname = $fullname;
      $this->email = $email;
      $this->category = $category;
      $this->status = $status;
      $this->defaultPwd = $defaultPwd;
	}

		public function addUser() {
       $this->setUser($this->fullname, $this->email, $this->category, $this->status, $this->defaultPwd);
	}


		
} 