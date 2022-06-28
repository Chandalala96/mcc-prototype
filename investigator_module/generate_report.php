<?php
   include_once('investigator_header.php');

     include('../includes/db_includes.php');

            $sql_logged_incidents = "SELECT * FROM sql_logged_incidents;";
            $failed_logged_incidents = "SELECT * FROM failedlogin_logged_incidents;";
            $blacklist_logged_incidents = "SELECT * FROM blacklist_logged_incidents;";
            $admin_incidents = "SELECT * FROM admin_whitelist;";
  
            
  
 $result = @mysqli_query($conn, $sql_logged_incidents);
 $result1 = @mysqli_query($conn, $blacklist_logged_incidents);
 $result2 = @mysqli_query($conn,  $failed_logged_incidents);
 $result3 = @mysqli_query($conn, $admin_incidents);


  if(isset($_GET["acknowledged"])) {
    echo '<div class="alert alert-success text-center">The incident has been acknowledged</div>';
  }   

   if(isset($_GET["blacklisted"])) {
    echo '<div class="alert alert-success text-center">The Device has been black-listed</div>';
  }  


 ?>
      <h1>Generate Incident Reports</h1>
     <section>
          <div class="container text-center mt-3" style="width: 65%; height: 600px"> 
           
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
      <td><a style="margin-left: 10px;" class="btn btn-outline-dark" href="report.php?table=sql_logged_incidents&id='.$row['incident_id'].'">
    <b>Generate Report</b></a>
 </td>
      </tr>';
    
      
        }
      ?> 
       <?php 
        while($row2 = mysqli_fetch_assoc($result2)) {
          echo ' <tr>
          <th scope="row">'.$row2['incident_id'].'</th>
      <td>'.$row2['status'].'</td>
      <td><a style="margin-left: 10px;"class="btn btn-outline-dark" href="report.php?table=failed_logged_incidents&id='.$row2['incident_id'].'">
    <b>Generate Report</b></a>
    </td>
      </tr>';
    
      
        }
      ?> 
       <?php 
        while($row = mysqli_fetch_assoc($result3)) {
          echo ' <tr>
          <th scope="row">'.$row['id'].'</th>
      <td>'.$row['status'].'</td>
      <td><a style="margin-left: 10px;" type="button" class="btn btn-outline-dark" href="report.php?table=admin_incidents&id='.$row['id'].'">
    <b>Generate Report</b></a>
 </td>
      </tr>';
    
      
        }
      ?> 
       <?php 
        while($row = mysqli_fetch_assoc($result1)) {
          echo ' <tr>
          <th scope="row">'.$row['id'].'</th>
      <td>'.$row['status'].'</td>
      <td><a style="margin-left: 10px;" type="button" class="btn btn-outline-dark" href="report.php?table=blacklist_logged_incidents&id='.$row['id'].'">
    <b>Generate Report</b></a>
  </td>
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