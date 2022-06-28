<?php 
namespace MyApp\UserClasses;

class UserLoginContr extends UserManager{

	private $email;
	private $pwd;


	public function __construct($email, $pwd) {
      $this->email = $email;
      $this->pwd = $pwd;
   
	}

		public function loginUser() {
	   if($this->emptyInput() == false) {
	   	header('location: ../index.php?error=emptyInput');
	   	exit();
	   }
	    
	   $this->getUser($this->email, $this->pwd);
	   $this->isOnline();
	} 


	public function userInfo() {
		$this->userActivity();
	}

	public function logoutUser() {
		   $this->getUser($this->email, $this->pwd);
		$this->isOffline();
	}





	private function emptyInput() {
		$result;
		if(empty($this->email) || empty($this->pwd))  {
             $result = false;
		} else {
			$result = true;
		}
		return $result;
	}

		
} 