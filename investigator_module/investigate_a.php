<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

     $id = $_GET["id"];
     $violation_id = $_GET["secondId"];

            $admin_sql = "SELECT * FROM admin_whitelist WHERE id = '$id';";
            $policy_sql = "SELECT * FROM policy_violations WHERE violation_id = '$violation_id';";
            
            
  
 $result1 = @mysqli_query($conn, $admin_sql);
 $result2 = @mysqli_query($conn,  $policy_sql);

  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }  


 ?>
      <h1>Investigate Incident</h1>
      <section> 
         <div class="container mt-3" style="width: 65%; height: 400px">
          <?php
             while($row1 = mysqli_fetch_assoc($result1)) {
               while($row2 = mysqli_fetch_assoc($result2)) {
                   echo '<div class="card" >
             <div class="card-body">
        <p><b>Incident Id:</b> '.$row1['id'].'</p>
        <p><b>Date & Time:</b> This device was black-listed on '.$row2['login_date'].' at the time '.$row2['login_time'].' </p>
        <p><b>Device:</b> The device identified was '.$row2['device_info'].'</p>
        <p><b>Ip Address:</b> The Ip address recorded was '.$row2['ip_address'].'</p>
        <p><b>Description:</b> '.$row2['violated_policy'].'</p>
        <p><b>Status:</b> '.$row1['status'].' '.$row1['admin_name'].' at the time '.$row1['timee'].' on the date '.$row1['datee'].' </p>
        
       
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