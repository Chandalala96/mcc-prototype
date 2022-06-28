<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

            $user_sqlInjections = "SELECT * FROM user_sqlinjections;";
            $user_failedLogin = "SELECT * FROM failed_logins;";
            
  
 $result = @mysqli_query($conn, $user_sqlInjections);
 $result1 = @mysqli_query($conn, $user_failedLogin);


    if(isset($_GET["logged"])) {
    echo '<div class="alert alert-success text-center">The incident has been logged to your investigator dashboard</div>';
  }


 ?>
          <section>
          <div class="container mt-3" style="width: 65%; height: 500px;"> 
    <h2>Add Incident</h2>
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
      <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModal'.$row['injection_id'].'">
    <b>More Details</b></button>
  <!-- The Modal -->
<div class="modal" id="myModal'.$row['injection_id'].'">
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
         <form  method="POST" action="../includes/log_call.php?id='.$row['injection_id'].'" style="margin-left: 7px;"><button name="invest_log_injection" class="btn btn-outline-dark"><b>Log a call</b></button></form>
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
      <form  method="POST" action="../includes/log_call.php?id='.$row1['id'].'" style="margin-left: 7px;"><button name="invest_log_logins" class="btn btn-outline-dark"><b>Log a call</b></button></form>
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

<?php
   include_once('investigator_footer.php');
 ?>