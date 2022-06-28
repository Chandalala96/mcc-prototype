<?php
 session_start();
      ob_start();
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <!---Custom CSS--->
    <link rel="stylesheet" href="../admin_module/admin_style.css">
<style>
body {
  font-family: "Lato", sans-serif;
}

h1{
  font-size: 30px;
}

h2{
  font-size: 25px;
}

.sidenav {
  width: 300px;
  height: 700px;
  position: fixed;
  z-index: 1;
  top: 0px;
  left: 10px;
  background: #eee;
  overflow-x: hidden;
  padding: 8px 0;
}



.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: black;
  display: block;
}


.sidenav a:hover {
  color: #064579;
}

i {
  font-size: 35px;
}

#setting{
  font-size:16px;
  margin-left: -6px;
}

.main {
  margin-left: 310px; 
  font-size: 15px; 
  padding: 0px 10px;
}

.btn{
  font-size: 15px;
}

#pop-btn {
  margin-left: 10px;
}

table{
  border: 5px solid black;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav text-center">
   <h2>Quick Menu</h2>
    <br>
     <a href="investigator_landingPage.php"><i class="bi bi-house-fill"></i>Home</a>
   <br>
  <a href="add_incident.php"><i class="bi bi-plus-circle"></i> Add New Incident</a>
  <br>
  <a href="generate_report.php"><i class="bi bi-file-earmark-text-fill"></i> Generate Report</a>
</div>

<div class="main text-center">
    <header> 

      <!---NAVBAR----->  
        <nav class="navbar navbar-expand-sm navbar-light" id="adminHead">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
     <!--  <ul class="navbar-nav">
         <li class="nav-item">
          <a class="nav-link" href="adminMainPage.php">Home</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#">Change Password</a>
        </li>
        
       
          
            </li>
        </ul> -->
    </li>
      </ul>
      <ul class="navbar-nav ms-auto" style="margin-right: 19px;">
       <p class="mt-3"><?= $_SESSION['name'] ?></p>
      </ul>
      <form method="POST" action="../includes/logout_includes.php">
        <input type="text" name="email1" value="<?= $_SESSION['email']; ?>" style="display: none;">
        <input type="text" name="pwd1" value="<?= $_SESSION['pwd']; ?>" style="display: none;">
      <button class="btn" type="submit" name="investigator_logout" id="button" onclick="myFunction()" style="background: black; color: white;">Log out</button>
    </form>
    </div>
  </div>
</nav>
<script>
  
 function myFunction(button) {
    var txt;
    if(confirm("Do you really want to logout?")) {
      txt = "investigator_logout";
    } else {
      txt = "investigator_cancel";
    }
     document.getElementById("button").setAttribute("name",txt);
    
  }
</script>
        <!---NAVBAR---*-->
     </header>