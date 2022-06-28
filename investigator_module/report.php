<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

     $id = $_GET["id"];
     $sql = "";

     if($_GET["table"] == "sql_logged_incidents") {

         $sql = "SELECT * FROM sql_logged_incidents WHERE incident_id = '$id';";

     } elseif($_GET["table"] == "failed_logged_incidents") {

         $sql = "SELECT * FROM failedlogin_logged_incidents WHERE incident_id = '$id';";

     } elseif($_GET["table"] == "admin_incidents") {

        $sql = "SELECT * FROM admin_whitelist WHERE id = '$id';";

     } elseif($_GET["table"] == "blacklist_logged_incidents") {
        $sql = "SELECT * FROM blacklist_logged_incidents WHERE id = '$id';";
     }


           
            // $policy_sql = "SELECT * FROM policy_violations WHERE violation_id = '$violation_id';";
            
            
  
 $result = @mysqli_query($conn, $sql);


  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }  


 ?>
      <h1>Incident Report</h1>
      <section> 
         <div class="container mt-3" style="width: 65%; height: 400px">
          <?php
           if($_GET["table"] == "sql_logged_incidents") {

          while($row = mysqli_fetch_assoc($result)) {
                   echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row['id'].'</p>
        <p><b>Date & Time:</b> This incident occured on '.$row['incident_date'].' at the time '.$row['incident_time'].' </p>
        <p><b>Device:</b> The device identified was '.$row['device'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row['ip_address'].'</p>
        <p><b>Description:</b> '.$row['description'].'</p>
        <p><b>Status:</b> '.$row['status'].'</p>
        <div class="d-flex justify-content-center"><a href="makePDF1.php?id='.$row['id'].'&date='.$row['incident_date'].'&time='.$row['incident_time'].'&device='.$row['device'].'&ip='.$row['ip_address'].'&desc='.$row['description'].'&status='.$row['status'].'" class="btn btn-outline-dark"><b>Generate PDF</b></a></div>
       
    </div>
  </div';
               }

     } elseif($_GET["table"] == "failed_logged_incidents") {

           while($row = mysqli_fetch_assoc($result)) {
                   echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row['id'].'</p>
        <p><b>Date & Time:</b> This incident occured on '.$row['incident_date'].' at the time '.$row['incident_time'].' </p>
        <p><b>Device:</b> The device identified was '.$row['device'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row['ip_address'].'</p>
        <p><b>Description:</b> '.$row['description'].'</p>
        <p><b>Status:</b> '.$row['status'].'</p>
      <div class="d-flex justify-content-center"><a href="makePDF2.php?id='.$row['id'].'&date='.$row['incident_date'].'&time='.$row['incident_time'].'&device='.$row['device'].'&ip='.$row['ip_address'].'&desc='.$row['description'].'&status='.$row['status'].'" class="btn btn-outline-dark"><b>Generate PDF</b></a></div>
       
    </div>
  </div';
               }

     } elseif($_GET["table"] == "admin_incidents") {

             while($row = mysqli_fetch_assoc($result)) {
              echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row['id'].'</p>
        <p><b>Device:</b> The device identified was '.$row['device'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row['ip_address'].'</p>
        <p><b>Description:</b> '.$row['reason'].'</p>
        <p><b>Status:</b> '.$row['status'].' '.$row['admin_name'].' at the time '.$row['timee'].' on the date '.$row['datee'].' </p>
    <div class="d-flex justify-content-center"><a href="makePDF3.php?id='.$row['id'].'&date='.$row['datee'].'&time='.$row['timee'].'&device='.$row['device'].'&ip='.$row['ip_address'].'&desc='.$row['reason'].'&status='.$row['status'].'&admin_name='.$row["admin_name"].'" class="btn btn-outline-dark"><b>Generate PDF</b></a></div>
        
       
    </div>
  </div';
               }

     } elseif($_GET["table"] == "blacklist_logged_incidents") {
         while($row = mysqli_fetch_assoc($result)) {
                   echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row['violation_id'].'</p>
        <p><b>Date & Time:</b> This device was black-listed on '.$row['violation_date'].' at the time '.$row['violation_time'].' </p>
        <p><b>Device:</b> The device identified was '.$row['device'].'</p>
        <p><b>Browser:</b> The browser used was '.$row['browser'].' version '.$row['browser_version'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row['ip_address'].'</p>
        <p><b>Description:</b> '.$row['violated_policy'].'</p>
        <p><b>Status:</b> '.$row['status'].' </p>
      <div class="d-flex justify-content-center"><a href="makePDF4.php?id='.$row['id'].'&date='.$row['violation_date'].'&time='.$row['violation_time'].'&device='.$row['device'].'&browser='.$row['browser'].'&browser_v='.$row['browser_version'].'&ip='.$row['ip_address'].'&desc='.$row['violated_policy'].'&status='.$row['status'].'" class="btn btn-outline-dark"><b>Generate PDF</b></a></div>
        
       
    </div>
  </div';
    
            
             }
     }
            
            
             
           ?>
 >
          </div>
      </section>


<?php
   include_once('investigator_footer.php');
 ?>