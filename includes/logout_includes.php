<?php 
 require_once realpath('../vendor/autoload.php');

if(isset($_POST['admin_logout'])) {

		$email = $_POST['email1'];
		$pwd = $_POST['pwd1'];
	   

	$logout = new \MyApp\AdminClasses\AdminLoginContr($email, $pwd);
	$logout->logoutUser();
    
   session_unset();
    session_destroy();
  header("location: ../index.php");


}

    if(array_key_exists("admin_cancel", $_POST)) {
    header("Location: ../admin_module/admin_landingPage.php");
   }

   if(isset($_POST['user_logout'])) {

        $email = $_POST['email1'];
        $pwd = $_POST['pwd1'];
       

    $logout = new \MyApp\UserClasses\UserLoginContr($email, $pwd);
    $logout->logoutUser();
    
   session_unset();
    session_destroy();
  header("location: ../index.php");


}

    if(array_key_exists("user_cancel", $_POST)) {
    header("Location: ../user_module/user_landingPage.php");
   }


  
  if(isset($_POST['investigator_logout'])) {

        $email = $_POST['email1'];
        $pwd = $_POST['pwd1'];
       

    $logout = new \MyApp\InvestigatorClasses\InvestigatorLoginContr($email, $pwd);
    $logout->logoutUser();
    
   session_unset();
    session_destroy();
  header("location: ../index.php");


}

    if(array_key_exists("investigator_cancel", $_POST)) {
    header("Location: ../investigator_module/investigator_landingPage.php");
   }



