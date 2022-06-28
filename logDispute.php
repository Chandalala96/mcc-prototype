<?php
   $dispute_logged = "";
   
  

   if(isset($_GET["dispute"])) {
        $dispute_logged = "Your dispute has been logged to the investigator";
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

</head>
<body>

     <main> 
  <div class='container text-center mt-5'> 
    <div class="fok">
     <h4 class="text-center" id="login-title">The MCC-Application Prototype</h4>
     <h5 class="text-center" id="login-title">Log a dispute</h5>
     <form class="login-form" method="post" action='./includes/dispute_includes.php'>
      <div class="mb-3 mt-3">
      <label for="u_id"><b>Fullname</b></label>
      <input type="text" class="form-control mx-auto" id="u_name" placeholder="Enter fullname" name="fullname" style="width: 100%;" required="">
    </div>
    <div class="mb-3">
      <label for="pass"><b>Add text</b></label>
      <textarea class="form-control mx-auto" id="pass" name="dispute" style="width: 100%;" required=""></textarea>
    </div>
     
      <button type="submit"  name="submit_dispute" class="btn btn-dark mt-3 mb-3">Submit</button>
     
         <?php if(isset($_GET['dispute']) ) {
          echo '<div class="alert alert-success text-center mb-3">'.$dispute_logged.'</div>';
         }  ?>
        
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

</html>