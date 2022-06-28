<?php 
 require_once realpath('../vendor/autoload.php');

if(isset($_POST['submit_dispute'])) {


	 $fullname = $_POST['fullname'];
     $dispute = $_POST['dispute'];



	$add_dispute = new \MyApp\UserClasses\DisputeContr($fullname, $dispute);
	$add_dispute->addDispute();
    
 
 header("location: ../logDispute.php?dispute=sent");
}


