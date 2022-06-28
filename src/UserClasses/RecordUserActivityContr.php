<?php 

namespace MyApp\UserClasses;

class RecordUserActivityContr extends UserManager{
	
	private $ip_address;
	private $activity;
	private $user;


	public function __construct($ip_address, $activity, $user) {
    
      $this->ip_address = $ip_address;
      $this->activity = $activity;
      $this->user  = $user;
      
	}

		public function recordActivity() {
	   
	   $this->setActivity($this->ip_address, $this->activity, $this->user);
	}



		
} 