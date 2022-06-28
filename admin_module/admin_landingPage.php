<?php 
    include_once('admin_header.php');
          include('../includes/db_includes.php');

            $user_sqlInjections = "SELECT * FROM user_sqlinjections;";
            $user_failedLogin = "SELECT * FROM failed_logins;";
            $query = "SELECT * FROM policy_violations WHERE status = 'Black-listed' OR status = 'Black-listed and Logged to Investigator';";
            $general_devices = "SELECT * FROM user_activity;";
            $query2 = "SELECT * FROM investigator_blacklist WHERE status = 'Black-listed' OR status = 'Black-listed and Logged to Investigator';";
  
  
 $result = @mysqli_query($conn, $user_sqlInjections);
 $result1 = @mysqli_query($conn, $user_failedLogin);
   $result2 = @mysqli_query($conn, $query);
   $result3 = @mysqli_query($conn, $general_devices);
    $result4 = @mysqli_query($conn, $query2);


   if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }  

    if(isset($_GET["logged"])) {
    echo '<div class="alert alert-success text-center">The incident has been logged to the investigator</div>';
  }

     if(isset($_GET["whitelisted"])) {
    echo '<div class="alert alert-success text-center">The device has been white-listed</div>';
  }

?>
      <h1>Administrator Dashboard</h1>

    <section>
          <div class="container mt-3" style="width: 65%"> 
    <h2>General Device Information</h2>
        <?php 
           if(mysqli_num_rows($result3) < 1) {
            echo '<div class="alert alert-success text-center">There are no devices yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Device Name</th>
      <th scope="col">Category</th>
      <th scope="col">Date Of Login</th>
    </tr>
  </thead>
  <tbody>
       <?php 
        while($row4 = mysqli_fetch_assoc($result3)) {
          echo ' <tr>
          <th scope="row">'.$row4['device_info'].'</th>
      <td>'.$row4['category'].'</td>
      <td>'.$row4['login_date'].'</td>
      </tr>';
    
      
        }
      ?>
  </tbody>
</table>
 </div>
    </section> 
    <br>
     <section>
          <div class="container mt-3" style="width: 65%"> 
    <h2>MCC Application Monitoring</h2>
      <?php 
           if(mysqli_num_rows($result) < 1 && mysqli_num_rows($result1) < 1 ) {
            echo '<div class="alert alert-success text-center">There are no incidents yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Log ID</th>
      <th scope="col">Suspicious Activity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php 
        while($row = mysqli_fetch_assoc($result)) {
          echo ' <tr>
          <th scope="row">'.$row['injection_id'].'</th>
      <td>'.$row['description'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModal'.$row["injection_id"].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModal'.$row["injection_id"].'">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Time</th>
      <th scope="col">Date</th>
      <th scope="col">Device</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row['injection_time'].'</td>
      <td>'.$row['injection_date'].'</td>
      <td>'.$row['device'].'</td>
      <td>'.$row['status'].'</td>
      <td><div class="d-flex justify-content-center">
        <form method="POST" action="../includes/acknowledge.php?id='.$row['injection_id'].'"><button name="acknowledge_injections" class="btn btn-dark"><b>Acknowledge</b></button></form>  <form  method="POST" action="../includes/log_call.php?id='.$row['injection_id'].'" style="margin-left: 7px;"><button name="log_injection" class="btn btn-outline-dark"><b>Log a call</b></button></form>
      </div></td>
    </tr>
  </tbody>
</table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div></td>
      </tr>';
    
      
        }
      ?> 
      <?php 
        while($row1 = mysqli_fetch_assoc($result1)) {
          echo ' <tr>
          <th scope="row">'.$row1['id'].'</th>
      <td>'.$row1['description'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModal'.$row1['id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModal'.$row1['id'].'">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Time</th>
      <th scope="col">Date</th>
      <th scope="col">Device</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row1['login_time'].'</td>
      <td>'.$row1['login_date'].'</td>
      <td>'.$row1['device'].'</td>
      <td>'.$row1['status'].'</td>
      <td><div class="d-flex justify-content-center">
        <form method="POST" action="../includes/acknowledge.php?id='.$row1['id'].'"><button name="acknowledge_logins" class="btn btn-dark"><b>Acknowledge</b></button></form>  <form  method="POST" action="../includes/log_call.php?id='.$row1['id'].'" style="margin-left: 7px;"><button name="log_logins" class="btn btn-outline-dark"><b>Log a call</b></button></form>
      </div></td>
    </tr>
  </tbody>
</table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div></td>
      </tr>';
    
      
        }
      ?>
   
     
     
  </tbody>
</table>
 </div>
    </section>
       <br>


     <section>
          <div class="container mt-3" style="width: 65%"> 
    <h2>Black-listing</h2>
     <?php 
           if(mysqli_num_rows($result2) < 1 && mysqli_num_rows($result4) < 1) {
            echo '<div class="alert alert-success text-center">No Devices Have been Black-listed</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Device Name</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
     <?php 
        while($row3 = mysqli_fetch_assoc($result2)) {
          echo ' <tr>
          <th scope="row">'.$row3['device_info'].'</th>
      <td>'.$row3['status'].'</td>
      <td><div class="d-flex justify-content-center"><button style="margin-left: 10px; font-size: 14px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModalll">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModalll">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      
      <th scope="col">Violated Policy</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row3['violated_policy'].'</td>
       <td><div class="d-flex justify-content-center">
        <form method="POST" action="../includes/acknowledge.php?name='.$row3['user_name'].'&id='.$row3['violation_id'].'&admin='.$_SESSION['name'].'"><button name="acknowledge" class="btn btn-outline-dark"><b>Acknowledge</b></button></form> <form  method="POST" action="../includes/log_call.php?id='.$row3['violation_id'].'" style="margin-left: 7px;"><button name="log_blacklistings" class="btn btn-dark"><b>Log a call</b></button></form>
      </div></td>
    </tr>
  </tbody>
</table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div></td>
      </tr>';
    
      
        }
      ?>
       <?php 
        while($row4 = mysqli_fetch_assoc($result4)) {
          echo ' <tr>
          <th scope="row">'.$row4['device'].'</th>
      <td>'.$row4['status'].' by Investigator</td>
      <td><form method="POST" action=""><button disabled  class="btn btn-outline-dark"><b>Acknowledge</b></button></form> </td>
      </tr>';
    
      
        }
      ?>
    
  </tbody>
</table>
 </div>
    </section>

<?php 
  include_once('admin_footer.php');
?>