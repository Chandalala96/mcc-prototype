<?php 

     include('db_includes.php');

if(isset($_POST["blacklist_s"])) {
	$device = $_GET['device'];
	$ip_address = $_GET['ip'];
	$reason = $_GET['res'];
	$status = "Black-listed";


	$query = "INSERT INTO investigator_blacklist (device, ip_address, reason, status) VALUES ('$device', '$ip_address', '$reason', '$status');";
	$run_query = @mysqli_query($conn, $query); 

	$id = $_GET['id'];
  $second_id = $_GET['secondId'];
  
      $sql = "UPDATE user_sqlinjections SET status = 'Device black-listed by Investigator' WHERE injection_id = '$second_id'";
      $run = @mysqli_query($conn, $sql);

        $sql1 = "UPDATE sql_logged_incidents SET status = 'Device black-listed by Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql1);


	 header("location: ../investigator_module/investigator_landingPage.php?blacklisted=true");


}

if(isset($_POST["blacklist_l"])) {
	$device = $_GET['device'];
	$ip_address = $_GET['ip'];
	$reason = $_GET['res'];
	$status = "Black-listed";


	$query = "INSERT INTO investigator_blacklist (device, ip_address, reason, status) VALUES ('$device', '$ip_address', '$reason', '$status');";
	$run_query = @mysqli_query($conn, $query); 

	$id = $_GET['id'];
  $second_id = $_GET['secondId'];
  
      $sql = "UPDATE failed_logins SET status = 'Device black-listed by Investigator' WHERE id = '$second_id'";
      $run = @mysqli_query($conn, $sql);

        $sql1 = "UPDATE failedlogin_logged_incidents SET status = 'Device black-listed by Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql1);


	 header("location: ../investigator_module/investigator_landingPage.php?blacklisted=true");


}