<?php   
session_start();
  include_once('db_includes.php');




 if(isset($_POST["acknowledge"])) {
 
  $id = $_GET['id'];
  $name = $_GET['name'];
  
      $sql = "UPDATE policy_violations SET status = 'White-listed by Admin' WHERE violation_id = '$id'";
      $run = @mysqli_query($conn, $sql);

      $sql2 = "UPDATE users SET status = 'White-listed' WHERE fullname = '$name'";
      $run2 = @mysqli_query($conn, $sql2);
        
        $violation_id = "";
        $device = "";
        $ip_address = "";
        $reason = "";
        $status = "White-listed by Admin";
        $time = date("h:i:sa");
        $date  =  date("d/m/Y");
        $admin_name = $_GET['admin'];

      $sql3 = "SELECT * FROM policy_violations WHERE violation_id = '$id';";
      $result = @mysqli_query($conn, $sql3);

      while($row = mysqli_fetch_assoc($result)) {
         $violation_id = $row['violation_id'];
         $device = $row['device_info'];
         $ip_address = $row['ip_address'];
         $reason = $row['violated_policy'];
      }

 
      $sql4 = "INSERT INTO admin_whitelist (violation_id, device, ip_address, reason, status, datee, timee, admin_name) VALUES ('$violation_id', '$device', '$ip_address', '$reason', '$status', '$date', '$time', '$admin_name');";
      $run4 = @mysqli_query($conn, $sql4);

     header("location: ../admin_module/admin_landingPage.php?error=none&whitelisted=true");
 }


 if(isset($_POST["acknowledge_injections"])) {
    
  $id = $_GET['id'];
  
      $sql = "UPDATE user_sqlinjections SET status = 'Acknowledged' WHERE injection_id = '$id'";
      $run = @mysqli_query($conn, $sql);



     header("location: ../admin_module/admin_landingPage.php?acknowledged=true");
 }


 if(isset($_POST["acknowledge_logins"])) {
 
  $id = $_GET['id'];
  
      $sql = "UPDATE failed_logins SET status = 'Acknowledged' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql);



     header("location: ../admin_module/admin_landingPage.php?acknowledged=true");
 }

  if(isset($_POST["invest_acknowledge_injections"])) {
 
  $id = $_GET['id'];
  $second_id = $_GET['secondId'];
  
      $sql = "UPDATE user_sqlinjections SET status = 'Acknowledged by Investigator' WHERE injection_id = '$second_id'";
      $run = @mysqli_query($conn, $sql);

        $sql = "UPDATE sql_logged_incidents SET status = 'Acknowledged by Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql);



     header("location: ../investigator_module/investigator_landingPage.php?acknowledged=true");
 }  

   if(isset($_POST["invest_acknowledge_logins"])) {
 
  $id = $_GET['id'];
  $second_id = $_GET['secondId'];
  
      $sql = "UPDATE failed_logins SET status = 'Acknowledged by Investigator' WHERE id = '$second_id'";
      $run = @mysqli_query($conn, $sql);

        $sql = "UPDATE failedlogin_logged_incidents SET status = 'Acknowledged by Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql);



     header("location: ../investigator_module/investigator_landingPage.php?acknowledged=true");
 }  

    if(isset($_POST["invest_acknowledge_blacklist"])) {
 
  $id = $_GET['id'];
  
      $sql = "UPDATE policy_violations SET status = 'Acknowledged by Investigator' WHERE violation_id = '$id'";
      $run = @mysqli_query($conn, $sql);

        $sql = "UPDATE blacklist_logged_incidents SET status = 'Acknowledged by Investigator' WHERE violation_id = '$id'";
      $run = @mysqli_query($conn, $sql);



     header("location: ../investigator_module/investigator_landingPage.php?acknowledged=true");
 }








 