<?php 
 require_once realpath('../vendor/autoload.php');

if(isset($_POST['submit_user'])) {


	 $fullname = $_POST['fullname'];
     $email = $_POST['email'];
     $category = $_POST['category'];
      $status = 'White-listed';
      $defaultPwd = 5678;


	$add_user = new \MyApp\AdminClasses\AddUserContr($fullname, $email, $category, $status, $defaultPwd);
	$add_user->addUser();
    
 
  header("location: ../admin_module/user_manage.php?added=true");

}


