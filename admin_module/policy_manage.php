<?php 
    include_once('admin_header.php');
      include('../includes/db_includes.php');


     $query = "SELECT * FROM policies;";
  $result = @mysqli_query($conn, $query);

  if(isset($_GET["activated"])) {
    echo '<div class="alert alert-success text-center"> Policy has been activated</div>';
  }


  if(isset($_GET["deactivated"])) {
    echo '<div class="alert alert-success text-center"> Policy has been deactivated</div>';
  }

?>
      <h1>Policy Management</h1>
      
    <section>
          <div class="container mt-3" style="width: 65%; height: 450px;"> 
   <table class="table table-light table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Policy</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        while($row = mysqli_fetch_assoc($result)) {
          echo ' <tr>
          <th scope="row">'.$row['name'].'</th>
      <td>'.$row['status'].'</td>';
      
      if($row["status"] == "Deactivated") {
        echo '
            <td><button style="margin-left: 10px;" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#myModalad'.$row['policy_id'].'">
    <b>Activate</b></button>
  <!-- The Modal -->
<div class="modal" id="myModalad'.$row['policy_id'].'">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <div class="alert alert-danger text-center">You are about to activate the '.$row["name"].', '.$row["description"].'</div>
          <form method="POST" action="../includes/activatePolicy.php?id='.$row['policy_id'].'"><button name="activate_policy" class="btn btn-outline-dark"><b>Continue</b></button></form>
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
      } else {
         echo ' <td><form method="POST" action="../includes/activatePolicy.php?id='.$row['policy_id'].'"><button name="deactivate_policy" class="btn btn-outline-dark"><b>Deactivate</b></button></form></td>
         </tr>';
      }

    
      
        }
      ?>
  </tbody>
</table>
 </div>
    </section> 
    <br>
     

<?php 
  include_once('admin_footer.php');
?>