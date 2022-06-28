<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

     $id = $_GET["id"];

            $sql_logged_incidents = "SELECT * FROM sql_logged_incidents WHERE id = '$id';";
            
            
  
 $result = @mysqli_query($conn, $sql_logged_incidents);

  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }  


 ?>
      <h1>Investigate Incident</h1>
      <section> 
         <div class="container mt-3" style="width: 65%; height: 400px">
          <?php
             while($row = mysqli_fetch_assoc($result)) {
              echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row['incident_id'].'</p>
        <p><b>Date:</b> This Incident occured on '.$row['incident_date'].' </p>
        <p><b>Time:</b> The time of the incident is '.$row['incident_time'].'</p>
        <p><b>Device:</b> The device responsible for this incident is '.$row['device'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row['ip_address'].'</p>
        <p><b>Description:</b> '.$row['description'].'</p>
        <p><b>Status:</b> '.$row['status'].'</p>
        <div class="d-flex justify-content-center"><form method="POST" action="../includes/acknowledge.php?id='.$row['id'].'&secondId='.$row['incident_id'].'"><button name="invest_acknowledge_injections" class="btn btn-outline-dark"><b>Acknowledge</b></button></form>  <form  method="POST" action="../includes/investigator_blacklist.php?id='.$row['id'].'&secondId='.$row['incident_id'].'&device='.$row['device'].'&ip='.$row['ip_address'].'&res='.$row['description'].'" style="margin-left: 7px;"><button name="blacklist_s" class="btn btn-dark"><b>Black-list device</b></button></form></div>
       
    </div>
  </div';
             }
           ?>
 >
          </div>
      </section>


<?php
   include_once('investigator_footer.php');
 ?>