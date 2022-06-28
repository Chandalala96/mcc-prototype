<?php   
session_start();
  include_once('db_includes.php');




 if(isset($_POST["activate_policy"])) {
 
  $id = $_GET['id'];
  
      $sql = "UPDATE policies SET status = 'Activated' WHERE policy_id = '$id'";
      $run = @mysqli_query($conn, $sql);


     header("location: ../admin_module/policy_manage.php?activated=true");
 }


 if(isset($_POST["deactivate_policy"])) {
 
  $id = $_GET['id'];
  
      $sql = "UPDATE policies SET status = 'Deactivated' WHERE policy_id = '$id'";
      $run = @mysqli_query($conn, $sql);


       header("location: ../admin_module/policy_manage.php?deactivated=true");
 }