<?php 
 require_once realpath('../vendor/autoload.php');
 include_once('./db_includes.php');
 

if(isset($_POST['admin_login'])) {


	$email = $_POST['email'];
	$pwd = $_POST['pwd'];


	$login = new \MyApp\AdminClasses\AdminLoginContr($email, $pwd);
	$login->loginUser();
	$login->adminInfo();
    
 
  header("location: ../admin_module/admin_landingPage.php?error=none");




}

if(isset($_POST['user_login'])) {


	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
     
     $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pwd'";
     $result = @mysqli_query($conn, $sql);

     while($row = mysqli_fetch_assoc($result)) {
     	if($row['status'] == "Blocked") {
     	 header("location: ../index.php?error=blocked");
     	 exit();	
     	} 
     }

      $login = new \MyApp\UserClasses\UserLoginContr($email, $pwd);
	$login->loginUser();
	$login->userInfo();
	
    
 
  header("location: ../user_module/user_landingPage.php?error=none");

}
 

if(isset($_POST['investigator_login'])) {


	$email = $_POST['email'];
	$pwd = $_POST['pwd'];


	$login = new \MyApp\InvestigatorClasses\InvestigatorLoginContr($email, $pwd);
	$login->loginUser();
	// $login->investigatorInfo();
    
 
  header("location: ../investigator_module/investigator_landingPage.php?error=none");




}


