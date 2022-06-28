<?php 
    include_once('admin_header.php');
         include('../includes/db_includes.php');

      $query = "SELECT * FROM policy_violations WHERE status = 'Black-listed';";
       $general_devices = "SELECT * FROM user_activity;";
  
  $result = @mysqli_query($conn, $query); 
  $result3 = @mysqli_query($conn, $general_devices);
  $result4 = @mysqli_query($conn, $general_devices);
 

   if(isset($_GET["whitelisted"])) {
    echo '<div class="alert alert-success text-center">User has been white-listed</div>';
  }

?>
      <h1>Device Management</h1>
      
    <section>
          <div class="container mt-3" style="width: 65%; height: 300px;"> 
            <h2>General Devices Activities</h2>
            <?php 
             if(mysqli_num_rows($result3) < 1) {
            echo '<div class="alert alert-success text-center">No Devices Have been added yet</div>';
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
    
        <section>
          <div class="container" style="width: 65%; height: 350px;"> 
                <h2>Devices Status</h2>

          <?php 
           if(mysqli_num_rows($result) < 1) {
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
        while($row = mysqli_fetch_assoc($result)) {
          echo ' <tr>
          <th scope="row">'.$row['device_info'].'</th>
      <td>'.$row['status'].'</td>
      <td><div class="d-flex justify-content-center"><form method="POST" action="../includes/acknowledge.php?name='.$row['user_name'].'&id='.$row['violation_id'].'"><button name="acknowledge" class="btn btn-outline-dark"><b>Acknowledge</b></button></form><button style="margin-left: 10px;" type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">
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
      <th scope="col">Name</th>
      <th scope="col">Time</th>
      <th scope="col">Date</th>
      <th scope="col">Device</th>
      <th scope="col">Violated Policy</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">'.$row['user_name'].'</th>
      <td>'.$row['login_time'].'</td>
      <td>'.$row['login_date'].'</td>
      <td>'.$row['device_info'].'</td>
      <td>'.$row['violated_policy'].'</td>
      <td>'.$row['status'].'</td>
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
       while($row5 = mysqli_fetch_assoc($result4)) {
          echo ' <tr>
          <th scope="row">'.$row5['device_info'].'</th>
      <td>white-listed</td>
      <td><div class="d-flex justify-content-center"><button disabled name="" class="btn btn-outline-dark"><b>Acknowledge</b></button><button disabled style="margin-left: 10px;" type="button" class="btn btn-dark">
    <b>Black-list</b></button>

</div></td>
      </tr>';
    
      
        };
    
      
        }
      ?>
  </tbody>
</table>
 </div>
    </section>
     

<?php 
  include_once('admin_footer.php');
?>