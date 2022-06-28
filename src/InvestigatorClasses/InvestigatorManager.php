<?php 

namespace MyApp\InvestigatorClasses;

class InvestigatorManager extends DbConnect{

  protected function getUser($email, $pwd) {

$pattern1 = '/(ALTER|CREATE|DELETE|DROP|EXEC(UTE){0,1}|INSERT( +INTO){0,1}|MERGE|SELECT|UPDATE|UNION( +ALL){0,1})/';
$pattern2 = '/[#$%^&*()+=\-\[\]\';,\/{}|":<>?~\\\\]/';
 
 if(preg_match($pattern1, $email) || preg_match($pattern2, $email) || preg_match($pattern1, $pwd) || preg_match($pattern2, $pwd)) {
      // Get sql injection related info 
     $injectionTime =  date("h:i:sa");
     $injectionDate =  date("d/m/Y");
    $injection_agent = $_SERVER['HTTP_USER_AGENT']; 
    $injection_agentt = explode(")", $injection_agent);
    $injection_agenttt = explode(";", $injection_agentt[0]);
    $device = $injection_agenttt[1] ." ". $injection_agenttt[2];
    $ip_address = $_SERVER['REMOTE_ADDR']; 
    $decription = "Attempted SQL Injection on Investigator login form";

      $sql = "INSERT INTO investigator_sqlinjections (injection_time, injection_date, device, ip_address, description) VALUES (?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($injectionTime, $injectionDate, $device, $ip_address, $decription));
          header("location: ../index.php?error1=sqlinjection");
   exit();
 } else{
      $getPwdStmt = $this->connect()->prepare('SELECT password FROM investigators WHERE email = ? AND password = ?');


      if(!$getPwdStmt->execute(array($email, $pwd))) {
          $getPwdStmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      } 
      if($getPwdStmt->rowCount() == 0) {
        $getPwdStmt = null;
         header("location: ../index.php?error=usernotfound");
          exit();
      }

      $pwdHashed = $getPwdStmt->fetchAll(\PDO::FETCH_ASSOC);
      // $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
      
       if($pwd !== $pwdHashed[0]["password"]) {
        $getInvestigatorStmt = null;
         header("location: ../index.php?error=wrongpassword");
          exit();
      }else if($pwd == $pwdHashed[0]["password"]) {
            $getInvestigatorStmt = $this->connect()->prepare('SELECT * FROM investigators WHERE email = ? AND password = ?;');

              if(!$getInvestigatorStmt->execute(array($email, $pwd))) {
          $getInvestigatorStmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      }
        if($getInvestigatorStmt->rowCount() == 0) {
        $getInvestigatorStmt = null;
         header("location: ../index.php?error=usernotfound");
          exit();
      }
      $investigator = $getInvestigatorStmt->fetchAll(\PDO::FETCH_ASSOC);

      
       
        session_start();
      $_SESSION['name'] = $investigator[0]['fullname'];
      $_SESSION['email'] = $investigator[0]['email'];
      $_SESSION['pwd'] = $investigator[0]['password'];
         
      //  // $_SESSION['userid'] = $user[0]['users_id'];
   
      // echo $_SESSION['name'];
      }
}

      
   }

   protected function isOnline() {
     $investigatorName = $_SESSION['name'];
     $online = 1;
      $sql = "UPDATE investigators SET is_online = :isonline WHERE fullname = :name";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':isonline', $online);
            $stmt->bindParam(':name', $investigatorName);
            $stmt->execute();
   }

   //    protected function investigatorActivity() {
   //      // Get admin related info 
   //   $investigatorName = $_SESSION['name'];
   //   $investigatorLoginTime =  date("h:i:sa");
   //   $investigatorLoginDate =  date("d/m/Y");
   //  $user_agent = $_SERVER['HTTP_USER_AGENT']; 
   //  $user_agentt = explode(")", $user_agent);
   //  $user_agenttt = explode(";", $user_agentt[0]);
   //  $investigator_device = $user_agenttt[1] ." ". $user_agenttt[2];
   //  $investigator_ip_address = $_SERVER['REMOTE_ADDR']; 

   //    $sql = "INSERT INTO investigator_activity (admin_name, login_time, login_date, device_info, ip_address) VALUES (?, ?, ?, ?, ?);";
   //          $stmt = $this->connect()->prepare($sql);
   //          $stmt->execute(array($adminName, $adminLoginTime, $adminLoginDate, $admins_device, $admin_ip_address));
   // }

   protected function isOffline() {
     $investigatorName = $_SESSION['name'];
     $online = 0;
      $sql = "UPDATE investigators SET is_online = :isonline WHERE fullname = :name";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':isonline', $online);
            $stmt->bindParam(':name', $investigatorName);
            $stmt->execute();

   }

  //  protected function setStudent($fullname, $email, $dob, $address, $programme, $department, $class, $gender, $status, $defaultPwd) {
  //     $stmt = $this->connect()->prepare('INSERT INTO students (fullname, email, dob, address, programme, department, class, gender, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

  //     if(!$stmt->execute(array($fullname, $email, $dob, $address, $programme, $department,  $class, $gender, $status, $defaultPwd))) {
  //         $stmt = null;
  //         header("location: ../admin_module/add_student.php?error=stmtfailed");
  //         exit();
  //     } 
  //     $stmt = null;
  //  }
  //     protected function setLecturer($fullname, $email, $dob, $address, $department, $gender, $status, $defaultPwd, $class_one, $class_two, $class_three, $class_four) {
  //     $stmt = $this->connect()->prepare('INSERT INTO lecturers (fullname, email, dob, address, department, gender, status,password, class_one, class_two, class_three, class_four ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

  //     if(!$stmt->execute(array($fullname, $email, $dob, $address, $department, $gender, $status, $defaultPwd, $class_one, $class_two, $class_three, $class_four))) {
  //         $stmt = null;
  //         header("location: ../admin_module/add_lecturer.php?error=stmtfailed");
  //         exit();
  //     } 
  //     $stmt = null;
  //  }



  //     protected function getStudents($programme, $class) {
  //   $sql = "SELECT * FROM students WHERE programme = ? AND class = ?";
  //   $stmt1 = $this->connect()->prepare($sql);
  //   // $stmt1->bindParam(':programme', $programme);
  //   // $stmt1->bindParam(':classs', $class);
  //   $stmt1->execute(array($programme, $class));

  //   $result = $stmt1->fetchAll();
  //   return $result;
  // }

  //     protected function  getLecturers($department) {
  //   $sql = "SELECT * FROM lecturers WHERE department = ?";
  //   $stmt1 = $this->connect()->prepare($sql);
  //   // $stmt1->bindParam(':programme', $programme);
  //   // $stmt1->bindParam(':classs', $class);
  //   $stmt1->execute(array($department));

  //   $result = $stmt1->fetchAll();
  //   return $result;
  // }

  //    protected function  getAllLecturers() {
  //   $sql = "SELECT * FROM lecturers";
  //   $stmt1 = $this->connect()->prepare($sql);
  //   // $stmt1->bindParam(':programme', $programme);
  //   // $stmt1->bindParam(':classs', $class);
  //   $stmt1->execute();

  //   $result = $stmt1->fetchAll();
  //   return $result;
  // }
 
 


  //  protected function deleteStudents($extracted_ids) {
  //       foreach ($extracted_ids as $id) {
  //         $stmt = $this->connect()->prepare('DELETE FROM students WHERE student_id IN(?);');
  //          if(!$stmt->execute(array($id))) {
  //         $stmt = null;
  //         header("location: ../admin_module/delete_student.php?error=deletefailed");
  //         exit();
  //     } 
  //       }
      
  //  } 

  //   protected function  deleteLecturers($extracted_ids) {
  //       foreach ($extracted_ids as $id) {
  //         $stmt = $this->connect()->prepare('DELETE FROM lecturers WHERE lecturer_id IN(?);');
  //          if(!$stmt->execute(array($id))) {
  //         $stmt = null;
  //         header("location: ../admin_module/delete_lecturer.php?error=deletefailed");
  //         exit();
  //     } 
  //       }
      
  //  }


  //        protected function  getStudentToEdit($student_id) {
  //   $sql = "SELECT * FROM students WHERE student_id = ?";
  //   $stmt1 = $this->connect()->prepare($sql);
  //   $stmt1->execute(array($student_id));

  //   $result = $stmt1->fetchAll();
  //   return $result;
  // }  

  //          protected function getLecturerToEdit($lecturer_id) {
  //   $sql = "SELECT * FROM lecturers WHERE lecturer_id = ?";
  //   $stmt1 = $this->connect()->prepare($sql);
  //   $stmt1->execute(array($lecturer_id));

  //   $result = $stmt1->fetchAll();
  //   return $result;
  // }


  //   protected function updateStudent($fullname, $dob, $address, $programme,  $class, $gender, $status, $student_id) {
  //     $stmt = $this->connect()->prepare('UPDATE students SET fullname = ?, dob = ?, address = ?, programme = ?, class = ?, gender = ?, status = ? WHERE student_id IN(?);');

  //     if(!$stmt->execute(array($fullname, $dob, $address, $programme, $class, $gender, $status, $student_id))) {
  //         $stmt = null;
  //         header("location: ../admin_module/edit_student.php?error=stmtfailed");
  //         exit();
  //     } 
  //     $stmt = null;
  //  }
   

  //   protected function updateLecturer($fullname, $dob, $address, $department, $gender, $status, $lecturer_id) {
  //     $stmt = $this->connect()->prepare('UPDATE lecturers SET fullname = ?, dob = ?, address = ?, department = ?, gender = ?, status = ? WHERE lecturer_id IN(?);');

  //     if(!$stmt->execute(array($fullname, $dob, $address, $department, $gender, $status, $lecturer_id))) {
  //         $stmt = null;
  //         header("location: ../admin_module/edit_lecturer.php?error=stmtfailed");
  //         exit();
  //     } 
  //     $stmt = null;
  //  }


}