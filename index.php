<?php
   $error = "";
   $error2 = "";
  

   if(isset($_GET["error"]) && $_GET["error"] == "blocked" ) {
      $error = "You have been black-listed";
   } else if(isset($_GET["error"])) {
      $error = "Please log in with correct credentials";
   } else  

    if(isset($_GET["error1"])) {
     $error = "Attempted SQL injection has been detected";
   } else  if(isset($_GET["error2"])) {
     $error = "You have been black-listed for policy violation";
   } 

    

  
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MCC-Application Prototype</title>
    <!----Bottstrap 5-------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     
     <!----Font awesome icons---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

  <!---Custom CSS--->
    <link rel="stylesheet" href="css/style.css">

    <!-- -------------Smooth scroll------------- --->
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

     <!-- ------------ AOS Library ------------------------- -->
    <link rel="stylesheet" href="css/aos.css">
</head>
<body>

     <main> 
  <div class='container mt-5'> 
    <div class="fok">
     <h4 class="text-center" id="login-title">The MCC-Application Prototype</h4>
     <form class="login-form" method="post" action='./includes/login_includes.php'>
      <div class="mb-3 mt-3">
      <label for="u_id"><b>Username</b></label>
      <input type="text" class="form-control mx-auto" id="u_id" placeholder="Enter username" name="email" style="width: 100%;" required="">
    </div>
    <div class="mb-3">
      <label for="pass"><b>Password</b></label>
      <input type="password" class="form-control mx-auto" id="pass" placeholder="Enter password" name="pwd" style="width: 100%;" required="">
    </div>
        <div class="d-flex justify-content-between">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Log in</a>
          <ul class="dropdown-menu">
           <li><button name="user_login" class="dropdown-item">User Login</button></li>
           <li><button  name="admin_login" class="dropdown-item">Admin Login</button></li>
           <li><button name="investigator_login" class="dropdown-item">Investigator Login</button></li>
          </ul>
        <button type="submit" name="submit" class="btn btn-dark" style="margin-left: 100px;">Register</button>
      </div>
      <button type="submit" id="clear-btn"  name="submit" class="btn mt-3 mb-3">Clear</button>
     
         <?php if(isset($_GET['error']) || isset($_GET['error1'])) {
          echo '<div class="alert alert-danger text-center mb-3">'.$error.'</div>';
         } else if(isset($_GET['error2'])) {
              echo '<div class="alert alert-danger text-center mb-3">'.$error.' <br>
              <a href="logDispute.php" class="btn btn-dark mt-2">Log dispute</a></div>';
            // echo '<a href="" class="btn btn-dark">Log dispute</a>';
         } ?>
        
  </form>
    </div>   
  </div>
</main>
</body>
   <footer id="footer"> 
    <div class="container-fluid mt-3 text-center">
  <p style="color: black;">Copyright &copy The MCC-Application Prototype 2022</p>
 </div>

</footer>
<!---Bootstrap5 JS link------>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

  <!---smooth scroll ---->
    <script type="text/javascript">
    var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 2000,
    speedAsDuration: true
});
   </script>

    <!-- ------------ AOS js Library  ------------------------- -->
    <script src="js/aos.js"></script>
    
      <!--- initialize AOS ----->
    <script>
         AOS.init();
    </script>
</html>