<?php 
  include_once('db_includes.php');


if(isset($_POST['log_injection'])) {

	$id = $_GET['id'];
	$injection_id = "";
    $injection_time = "";
    $injection_date = "";
    $device = "";
    $ip_address = "";
    $decription = "";
    $status = "";

	$get_incident = "SELECT * FROM user_sqlinjections WHERE injection_id = '$id';";
	$run_get_incident = @mysqli_query($conn, $get_incident);

    while($row = mysqli_fetch_assoc($run_get_incident)) {

    	$injection_id = $row["injection_id"];
    	$injection_time = $row['injection_time'];
    	$injection_date = $row['injection_date'];
    	$device = $row['device'];
    	$ip_address = $row['ip_address'];
    	$decription = $row['description'];
    	$status = $row['status'];
    }


    $log_incident = "INSERT INTO `sql_logged_incidents`(`incident_id`, `incident_time`, `incident_date`, `device`, `ip_address`, `description`, `status`) VALUES ('$injection_id','$injection_time','$injection_date ','$device','	$ip_address','$decription','$status')";
    $run_log_incident = @mysqli_query($conn, $log_incident);

      $sql = "UPDATE user_sqlinjections SET status = 'Logged to Investigator' WHERE injection_id = '$id'";
      $run = @mysqli_query($conn, $sql);


        header("location: ../admin_module/admin_landingPage.php?logged=true");
} 

if(isset($_POST['invest_log_injection'])) {

    $id = $_GET['id'];
    $injection_id = "";
    $injection_time = "";
    $injection_date = "";
    $device = "";
    $ip_address = "";
    $decription = "";
    $status = "";

  $get_incident = "SELECT * FROM user_sqlinjections WHERE injection_id = '$id';";
  $run_get_incident = @mysqli_query($conn, $get_incident);

    while($row = mysqli_fetch_assoc($run_get_incident)) {

      $injection_id = $row["injection_id"];
      $injection_time = $row['injection_time'];
      $injection_date = $row['injection_date'];
      $device = $row['device'];
      $ip_address = $row['ip_address'];
      $decription = $row['description'];
      $status = $row['status'];
    }


    $log_incident = "INSERT INTO `sql_logged_incidents`(`incident_id`, `incident_time`, `incident_date`, `device`, `ip_address`, `description`, `status`) VALUES ('$injection_id','$injection_time','$injection_date ','$device','  $ip_address','$decription','$status')";
    $run_log_incident = @mysqli_query($conn, $log_incident);

      $sql = "UPDATE user_sqlinjections SET status = 'Logged to Investigator' WHERE injection_id = '$id'";
      $run = @mysqli_query($conn, $sql);


        header("location: ../investigator_module/add_incident.php?logged=true");
}




if(isset($_POST['log_logins'])) {

	$id = $_GET['id'];
	$login_id = "";
    $login_time = "";
    $login_date = "";
    $device = "";
    $ip_address = "";
    $decription = "";
    $status = "";

	$get_incident = "SELECT * FROM failed_logins WHERE id = '$id';";
	$run_get_incident = @mysqli_query($conn, $get_incident);

    while($row = mysqli_fetch_assoc($run_get_incident)) {

    	$login_id = $row["id"];
    	$login_time = $row['login_time'];
    	$login_date = $row['login_date'];
    	$device = $row['device'];
    	$ip_address = $row['ip_address'];
    	$decription = $row['description'];
    	$status = $row['status'];
    }


    $log_incident = "INSERT INTO `failedlogin_logged_incidents`(`incident_id`, `incident_time`, `incident_date`, `device`, `ip_address`, `description`, `status`) VALUES ('$login_id','$login_time','$login_date','$device','	$ip_address','$decription','$status')";
    $run_log_incident = @mysqli_query($conn, $log_incident);

     $sql = "UPDATE failed_logins SET status = 'Logged to Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql);



        header("location: ../admin_module/admin_landingPage.php?logged=true");
}

if(isset($_POST['invest_log_logins'])) {

  $id = $_GET['id'];
  $login_id = "";
    $login_time = "";
    $login_date = "";
    $device = "";
    $ip_address = "";
    $decription = "";
    $status = "";

  $get_incident = "SELECT * FROM failed_logins WHERE id = '$id';";
  $run_get_incident = @mysqli_query($conn, $get_incident);

    while($row = mysqli_fetch_assoc($run_get_incident)) {

      $login_id = $row["id"];
      $login_time = $row['login_time'];
      $login_date = $row['login_date'];
      $device = $row['device'];
      $ip_address = $row['ip_address'];
      $decription = $row['description'];
      $status = $row['status'];
    }


    $log_incident = "INSERT INTO `failedlogin_logged_incidents`(`incident_id`, `incident_time`, `incident_date`, `device`, `ip_address`, `description`, `status`) VALUES ('$login_id','$login_time','$login_date','$device',' $ip_address','$decription','$status')";
    $run_log_incident = @mysqli_query($conn, $log_incident);

     $sql = "UPDATE failed_logins SET status = 'Logged to Investigator' WHERE id = '$id'";
      $run = @mysqli_query($conn, $sql);



        header("location: ../investigator_module/add_incident.php?logged=true");
}




if(isset($_POST['log_blacklistings'])) {

    $id = $_GET['id'];
    $violation_id = "";
    $violation_time = "";
    $violation_date = "";
    $device = "";
    $browser = "";
    $browser_version = "";
    $ip_address = "";
    $violated_policy = "";
    $status = "";

  $get_incident = "SELECT * FROM policy_violations WHERE violation_id = '$id';";
  $run_get_incident = @mysqli_query($conn, $get_incident);

    while($row = mysqli_fetch_assoc($run_get_incident)) {

        $violation_id  = $row["violation_id"];
      $violation_time = $row['login_time'];
      $violation_date = $row['login_date'];
      $device = $row['device_info'];
      $browser = $row['browser'];
      $browser_version = $row['browser_version'];
      $ip_address = $row['ip_address'];
      $violated_policy = $row['violated_policy'];
      $status = $row['status'];
    }


    $log_incident = "INSERT INTO `blacklist_logged_incidents`(`violation_id`, `violation_time`, `violation_date`, `device`, `browser`, `browser_version`, `ip_address`, `violated_policy`, `status`) VALUES ('$violation_id','$violation_time','$violation_date','$device', '$browser', '$browser_version' ,'$ip_address','$violated_policy','$status')";
    $run_log_incident = @mysqli_query($conn, $log_incident);

     $sql = "UPDATE policy_violations SET status = 'Black-listed and Logged to Investigator' WHERE violation_id = '$id'";
      $run = @mysqli_query($conn, $sql);



        header("location: ../admin_module/admin_landingPage.php?logged=true");
}


log_blacklistings

?>