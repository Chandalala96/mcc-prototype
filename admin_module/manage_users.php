<?php 
  include_once('./admin_header.php'); 
?>
<main>


 
  <br>
   <a href="adminMainPage.php" class="btn mt-3 back-btn"><i class="bi bi-arrow-left-square-fill"></i></a>
  <br>
  <hr>

<section>
    <h1 class="text-center">Manage Users</h1>
    <div class="container" style="height: 400px;">
    <div class="mt-5 text-center programmes">
        <div class="card text-white select-class-card">
    <div class="card-body">
         <div class="dropdown dropdown-menu-end quick_link">
          <button class="dropdown-toggle btn" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">Manage Users</button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenuLink">
            <li class="dropdown dropend">
                <button class="dropdown-item dropdown-toggle" type="button" id="multilevelDropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Lecturers</button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="multilevelDropdownMenu1">
                    <li><a class="dropdown-item" href="select_department_add.php">Add Lecturer</a></li>
                    <li><a class="dropdown-item" href="select_department_edit.php">Edit Lecturer</a></li>
                    <li><a class="dropdown-item" href="select_department_delete.php">Delete Lecturer</a></li>
                    <li><a class="dropdown-item" href="all_lecturers.php">View Lecturers</a></li>
                </ul>
                <button class="dropdown-item dropdown-toggle" type="button" id="multilevelDropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Students</button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="multilevelDropdownMenu2">
                    <li><a class="dropdown-item" href="select_class_add.php">Add student</a></li>
                    <li><a class="dropdown-item" href="select_class_edit.php">Edit student</a></li>
                    <li><a class="dropdown-item" href="select_class_delete.php">Delete student</a></li>
                    <li><a class="dropdown-item" href="select_class_all.php">View students</a></li>
                </ul>
            </li>
        </ul>
    </div>
        <br>
         <div class="dropdown dropdown-menu-end quick_link">
         <button class="dropdown-toggle btn" type="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-expanded="false">White_Listed/Black_Listed Users</button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuLink1">
            <li><a class="dropdown-item " href="lecturers_listed.php">Lecturers</a> </li>
            <li><a class="dropdown-item " href="students_listed.php">Students</a> </li>      
        </ul>
    </div>
           <br>
           <div class="dropdown dropdown-menu-end quick_link">
       <button class="dropdown-toggle btn" type="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-expanded="false">View All Recent Users Activities</button>
        <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="dropdownMenuLink2">
            <li class="dropdown dropend">
                <button class="dropdown-item dropdown-toggle" type="button" id="multilevelDropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lecturers</button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="multilevelDropdownMenu3">
                    <li><a class="dropdown-item" href="lecturer_activity.php">Lecturers Activity</a></li>
                    <li><a class="dropdown-item" href="lecturer_violations.php">Lecturer Policy Violations</a></li>
                </ul>
                <button class="dropdown-item dropdown-toggle" type="button" id="multilevelDropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="multilevelDropdownMenu4">
                    <li><a class="dropdown-item" href="student_activity.php">Students Activity</a></li>
                    <li><a class="dropdown-item" href="student_violations.php">Student Policy Violations</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
  </div>

 
   </div>
</div>
 </section>
<br>
<br>

 </main>
 <?php 
 include_once('./admin_footer.php');

?>