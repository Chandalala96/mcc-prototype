<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

            $sql_logged_incidents = "SELECT * FROM sql_logged_incidents;";
            $failed_logged_incidents = "SELECT * FROM failedlogin_logged_incidents;";
            $blacklist_logged_incidents = "SELECT * FROM blacklist_logged_incidents;";
            $admin_incidents = "SELECT * FROM admin_whitelist;";
            $user_disputes = "SELECT * FROM user_disputes;";
            
  
 $result = @mysqli_query($conn, $sql_logged_incidents);
 $result1 = @mysqli_query($conn, $blacklist_logged_incidents);
 $result2 = @mysqli_query($conn,  $failed_logged_incidents);
 $result3 = @mysqli_query($conn, $admin_incidents);
 $result4 = @mysqli_query($conn, $user_disputes);

  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }   

   if(isset($_GET["blacklisted"])) {
    echo '<div class="alert alert-success text-center">The Device has been black-listed</div>';
  }  


 ?>
      <h1>Investigator Dashboard</h1>
     <section>
          <div class="container text-center mt-3" style="width: 65%; height: 300px"> 
             <h2>Application Incidents</h2>
             <?php 
           if(mysqli_num_rows($result) < 1 && mysqli_num_rows($result2) < 1 ) {
            echo '<div class="alert alert-success text-center">There are no incidents yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Incident Number</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php 
        while($row = mysqli_fetch_assoc($result)) {
          echo ' <tr>
          <th scope="row">'.$row['incident_id'].'</th>
      <td>'.$row['status'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModal">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModal">
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
      <th scope="col">Device</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row['device'].'</td>
      <td>'.$row['description'].'</td>
      <td><div class="d-flex justify-content-center">
        <form method="POST" action="../includes/acknowledge.php?id='.$row['id'].'&secondId='.$row['incident_id'].'"><button name="invest_acknowledge_injections" class="btn btn-dark"><b>Acknowledge</b></button></form> <a href="investigate_s.php?id='.$row['id'].'&secondId='.$row['incident_id'].'" style="margin-left: 7px;" class="btn btn-outline-dark"><b>Investigate</b></a>
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
        while($row2 = mysqli_fetch_assoc($result2)) {
          echo ' <tr>
          <th scope="row">'.$row2['incident_id'].'</th>
      <td>'.$row2['status'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModal'.$row2['incident_id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModal'.$row2['incident_id'].'">
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
      <th scope="col">Device</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row2['device'].'</td>
      <td>'.$row2['description'].'</td>
      <td><div class="d-flex justify-content-center">
        <form method="POST" action="../includes/acknowledge.php?id='.$row2['id'].'&secondId='.$row2['incident_id'].'"><button name="invest_acknowledge_logins" class="btn btn-dark"><b>Acknowledge</b></button></form> <a href="investigate_l.php?id='.$row2['id'].'&secondId='.$row2['incident_id'].'" style="margin-left: 7px;" class="btn btn-outline-dark"><b>Investigate</b></a>
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
<!-- <div class="row g-3 align-items-center">
  <div class="col-auto">
    <input type="text" id="inputPassword6" class="form-control">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-dark">Search</button>
  </div>
</div> -->
 </div>
    </section>
     <br>
     <br>
     <section class="mt-5">
          <div class="container text-center" style="width: 65%; height: 300px"> 
             <h2>Administrative Incidents</h2>
             <?php 
           if(mysqli_num_rows($result3) < 1 ) {
            echo '<div class="alert alert-success text-center">There are no adminstrative incidents yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Incident Number</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php 
        while($row = mysqli_fetch_assoc($result3)) {
          echo ' <tr>
          <th scope="row">'.$row['id'].'</th>
      <td>'.$row['status'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModalad'.$row['id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModalad'.$row['id'].'">
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
      <th scope="col">Device</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row['device'].'</td>
      <td>'.$row['reason'].'</td>
      <td><div class="d-flex justify-content-center">
       <a href="investigate_a.php?id='.$row['id'].'&secondId='.$row['violation_id'].'" style="margin-left: 7px;" class="btn btn-outline-dark"><b>Investigate</b></a>
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
<!-- <div class="row g-3 align-items-center">
  <div class="col-auto">
    <input type="text" id="inputPassword6" class="form-control">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-dark">Search</button>
  </div>
</div> -->
 </div>
    </section> 

     <section>
          <div class="container text-center" style="width: 65%; height: 300px"> 
             <h2>Black-listing Incidents</h2>
             <?php 
           if(mysqli_num_rows($result1) < 1 ) {
            echo '<div class="alert alert-success text-center">There are no black-listing incidents yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Incident Number</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php 
        while($row = mysqli_fetch_assoc($result1)) {
          echo ' <tr>
          <th scope="row">'.$row['id'].'</th>
      <td>'.$row['status'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModalad'.$row['id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModalad'.$row['id'].'">
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
      <th scope="col">Device</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row['device'].'</td>
      <td>'.$row['violated_policy'].'</td>
      <td><div class="d-flex justify-content-center">
       <a href="investigate_b.php?id='.$row['id'].'&secondId='.$row['violation_id'].'" style="margin-left: 7px;" class="btn btn-outline-dark"><b>Investigate</b></a>
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
<!-- <div class="row g-3 align-items-center">
  <div class="col-auto">
    <input type="text" id="inputPassword6" class="form-control">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-dark">Search</button>
  </div>
</div> -->
 </div>
    </section>

     <section>
          <div class="container text-center" style="width: 65%; height: 300px"> 
             <h2>User Disputes</h2>
             <?php 
           if(mysqli_num_rows($result4) < 1 ) {
            echo '<div class="alert alert-success text-center">There are user disputes yet</div>';
           } 
          ?>
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Dispute Number</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php 
        while($row = mysqli_fetch_assoc($result4)) {
          echo ' <tr>
          <th scope="row">'.$row['dispute_id'].'</th>
      <td>'.$row['fullname'].'</td>
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModalad'.$row['dispute_id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModalad'.$row['dispute_id'].'">
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
      <th scope="col">Device</th>
      <th scope="col">Time</th>
      <th scope="col">Date</th>
      <th scope="col">IP Address</th>
      <th scope="col">Dispute</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$row['device'].'</td>
      <td>'.$row['dispute_time'].'</td>
      <td>'.$row['dispute_date'].'</td>
      <td>'.$row['ip_address'].'</td>
      <td>'.$row['dispute'].'</td>
   
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
<!-- <div class="row g-3 align-items-center">
  <div class="col-auto">
    <input type="text" id="inputPassword6" class="form-control">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-dark">Search</button>
  </div>
</div> -->
 </div>
    </section>

<?php
   include_once('investigator_footer.php');
 ?>