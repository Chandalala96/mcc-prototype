<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

     $id = $_GET["id"];
     $violation_id = $_GET["secondId"];

            $policy_sql = "SELECT * FROM policy_violations WHERE violation_id = '$violation_id';";
            
            
  

 $result2 = @mysqli_query($conn,  $policy_sql);

  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }  


 ?>
      <h1>Investigate Incident</h1>
      <section> 
         <div class="container mt-3" style="width: 65%; height: 400px">
          <?php
               while($row2 = mysqli_fetch_assoc($result2)) {
                   echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row2['violation_id'].'</p>
        <p><b>Date & Time:</b> This device was black-listed on '.$row2['login_date'].' at the time '.$row2['login_time'].' </p>
        <p><b>Device:</b> The device identified was '.$row2['device_info'].'</p>
        <p><b>Browser:</b> The browser used was '.$row2['browser'].' version '.$row2['browser_version'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row2['ip_address'].'</p>
        <p><b>Description:</b> '.$row2['violated_policy'].'</p>
        <p><b>Status:</b> '.$row2['status'].' </p>
         <div class="d-flex justify-content-center"><form method="POST" action="../includes/acknowledge.php?id='.$row2['violation_id'].'"><button name="invest_acknowledge_blacklist" class="btn btn-outline-dark"><b>Acknowledge</b></button></form></div>
        
       
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