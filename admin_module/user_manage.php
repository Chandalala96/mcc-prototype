<?php 
    include_once('admin_header.php');
         include('../includes/db_includes.php');

      $query = "SELECT * FROM policy_violations WHERE status = 'Black-listed';";
  $result = @mysqli_query($conn, $query);  

   if(isset($_GET["added"])) {
    echo '<div class="alert alert-success text-center">User has been added</div>';
  }

?>
      <h1>Add User</h1>
      
    <section>
    <div class="container mt-5 text-center" style="height: 500px;">
  <form method="POST" action="../includes/addUser_includes.php">
    <div class="row" style="text-align: left;">
      <div class="col-sm-12" style="width: 70%; margin:auto;">
      <label for="fname">Fullname</label>
      <input class="form-control" type="text" id="fname" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" placeholder="Enter fullname" required>
      <br>
      <label for="e_mail">Email</label>
      <input class="form-control" type="email" id="e_mail" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Enter email" required>
      <br>
         <label for="e_mail">Category</label>
      <select class="form-select" name="category" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="COPE">COPE</option>
  <option value="BYOF">BYOF</option>
</select>
      <br>
    </div>
    <button type="submit" name="submit_user" class="mt-3 addStudent-btn" >Add User to database</button>
  </div>
  </form>
</div>
 </section>
     

<?php 
  include_once('admin_footer.php');
?>