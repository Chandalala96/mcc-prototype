<?php 

namespace MyApp\UserClasses;

class UserManager extends DbConnect{ 

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
    $decription = "Attempted SQL Injection on login form";
    $status = "Not investigated yet";

      $sql = "INSERT INTO user_sqlinjections (injection_time, injection_date, device, ip_address, description, status) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($injectionTime, $injectionDate, $device, $ip_address, $decription, $status));
          header("location: ../index.php?error1=sqlinjection");
   exit();
 }  else {
       $getPwdStmt = $this->connect()->prepare('SELECT password FROM users WHERE email = ? AND password = ?');


      if(!$getPwdStmt->execute(array($email, $pwd))) {
          $getPwdStmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      } 
    
      if($getPwdStmt->rowCount() == 0) {
          $login_counter = 0;
        $login_counter++;
         $failedLogin_Time =  date("h:i:sa");
     $failedLogin_Date =  date("d/m/Y");
    $injection_agent = $_SERVER['HTTP_USER_AGENT']; 
    $injection_agentt = explode(")", $injection_agent);
    $injection_agenttt = explode(";", $injection_agentt[0]);
    $device = $injection_agenttt[1] ." ". $injection_agenttt[2];
    $ip_address = $_SERVER['REMOTE_ADDR']; 
        $failed_login_desc = "Attempted unauthorized login";
        $failed_login_status = "Not investigated yet";
        if($login_counter > 0) {
            $sql = "INSERT INTO failed_logins (login_time, login_date, device, ip_address, description, status) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($failedLogin_Time, $failedLogin_Date, $device, $ip_address, $failed_login_desc,$failed_login_status)); 
        
        }
        $getPwdStmt = null;
         header("location: ../index.php?error=usernofound&count=$login_counter");
       
      }

      $pwdHashed = $getPwdStmt->fetchAll(\PDO::FETCH_ASSOC);
      // $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
      
       if($pwd !== $pwdHashed[0]["password"]) {
        $getUserStmt = null;
         header("location: ../index.php?error=wrongpassword");
          exit();
      }else if($pwd == $pwdHashed[0]["password"]) {
            $getUserStmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ? AND password = ?;');

              if(!$getUserStmt->execute(array($email, $pwd))) {
          $getUserStmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      }
        if($getUserStmt->rowCount() == 0) {
        $getUserStmt = null;
         header("location: ../index.php?error=usernotfound");
          exit();
      }
      $user = $getUserStmt->fetchAll(\PDO::FETCH_ASSOC);
      
       
        session_start();
      $_SESSION['id'] = $user[0]['user_id'];
      $_SESSION['name'] =  $user[0]['fullname'];
      $_SESSION['email'] = $user[0]['email'];
      $_SESSION['pwd'] =   $user[0]['password'];
 
      }
}

      
   }

   protected function isOnline() {
      $userName = $_SESSION['name'];
     $online = 1;
      $sql = "UPDATE users SET is_online = :isonline WHERE fullname = :name";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':isonline', $online);
            $stmt->bindParam(':name', $userName);
            $stmt->execute();
   }

      protected function userActivity() {
        // Get lecturer related info 
     $userName = $_SESSION['name'];
     $userLoginTime =  date("h:i:sa");
     $userLoginDate =  date("d/m/Y");
    $user_agent = $_SERVER['HTTP_USER_AGENT']; 
    $user_agentt = explode(")", $user_agent);
    $user_agenttt = explode(";", $user_agentt[0]);
    $user_device = $user_agenttt[1] ." ". $user_agenttt[2];
    $user_ip_address = $_SERVER['REMOTE_ADDR']; 
    $activity = "Logged in";

      //     $user_agent = $_SERVER['HTTP_USER_AGENT']; 
     // $user_agentt = explode(")", $user_agent);  
     $user_browser_agent = explode(" ", $user_agentt[2]);
     $browser_version = "";
     if(count($user_browser_agent ) === 3){
            $browser_version = $user_browser_agent[1];
     } else if(count($user_browser_agent) === 4) {
          $browser_version = $user_browser_agent[3];
     }

    $browser = "";
    $version = "";

    $browser_info = explode("/", $browser_version);
    $browser = $browser_info[0];
    $browser_v = explode(".", $browser_info[1]);
    $browser_v_final = $browser_v[0];
    $browser_policy = "Browser Policy violated, Using outdated browser";
    $policyName = "Browser Policy";
    $policy_status = "Activated";
     $check_policy = $this->connect()->prepare('SELECT * FROM policies WHERE name = ? AND status = ?;');

              $check_policy->execute(array($policyName, $policy_status));

            if($check_policy->rowCount() == 0) {

                $get_category = $this->connect()->prepare('SELECT * FROM users WHERE fullname = ?;');
                $get_category->execute(array($userName));
                 $result = $get_category->fetchAll();
                
                $category = $result[0]["category"];
               
            


           $sql = "INSERT INTO user_activity (user_name, login_time, login_date, device_info, category, ip_address, activity) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($userName,  $userLoginTime,   $userLoginDate, $user_device, $category, $user_ip_address, $activity));
      } else if ($browser_v_final > 92) {
     $sql = "INSERT INTO policy_violations (user_name, login_time, login_date, device_info, browser, browser_version, ip_address, violated_policy, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($userName,  $userLoginTime, $userLoginDate, $user_device, $browser, $browser_v_final, $user_ip_address, $browser_policy, "Black-listed"));
    $status = 'Black-listed';
    $sql_user = "UPDATE users SET status = :status WHERE fullname = :name";
            $stmt_user = $this->connect()->prepare($sql_user);
            $stmt_user->bindParam(':status', $status);
            $stmt_user->bindParam(':name',  $userName);
            $stmt_user->execute();
            $this->isOffline();
            header("location: ../index.php?error2=policyVio");
            exit();
   } else {
      $get_category = $this->connect()->prepare('SELECT * FROM users WHERE fullname = ?;');
                $get_category->execute(array($userName));
                 $result = $get_category->fetchAll();
                
                $category = $result[0]["category"];
               
            


           $sql = "INSERT INTO user_activity (user_name, login_time, login_date, device_info, category, ip_address, activity) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($userName,  $userLoginTime,   $userLoginDate, $user_device, $category, $user_ip_address, $activity));
   }
      


   }

   protected function isOffline() {
      $userName = $_SESSION['name'];
     $online = 0;
      $sql = "UPDATE users SET is_online = :isonline WHERE fullname = :name";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':isonline', $online);
            $stmt->bindParam(':name',  $userName);
            $stmt->execute();

   }

     protected function setDispute($fullname, $text) {
   

$pattern1 = '/(ALTER|CREATE|DELETE|DROP|EXEC(UTE){0,1}|INSERT( +INTO){0,1}|MERGE|SELECT|UPDATE|UNION( +ALL){0,1})/';
$pattern2 = '/[#$%^&*()+=\-\[\]\';,\/{}|":<>?~\\\\]/';
 
 if(preg_match($pattern1, $fullname) || preg_match($pattern2, $fullname) || preg_match($pattern1, $text) || preg_match($pattern2, $text)) {
      // Get sql injection related info 
     $injectionTime =  date("h:i:sa");
     $injectionDate =  date("d/m/Y");
    $injection_agent = $_SERVER['HTTP_USER_AGENT']; 
    $injection_agentt = explode(")", $injection_agent);
    $injection_agenttt = explode(";", $injection_agentt[0]);
    $device = $injection_agenttt[1] ." ". $injection_agenttt[2];
    $ip_address = $_SERVER['REMOTE_ADDR']; 
    $decription = "Attempted SQL Injection on log dispute form";
    $status = "Not investigated yet";

      $sql = "INSERT INTO user_sqlinjections (injection_time, injection_date, device, ip_address, description, status) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($injectionTime, $injectionDate, $device, $ip_address, $decription, $status));
          header("location: ../index.php?error1=sqlinjection");
   exit();
 }  else {
      $injectionTime =  date("h:i:sa");
     $injectionDate =  date("d/m/Y");
    $injection_agent = $_SERVER['HTTP_USER_AGENT']; 
    $injection_agentt = explode(")", $injection_agent);
    $injection_agenttt = explode(";", $injection_agentt[0]);
    $device = $injection_agenttt[1] ." ". $injection_agenttt[2];
    $ip_address = $_SERVER['REMOTE_ADDR']; 
    $decription = "Attempted SQL Injection on log dispute form";
    $status = "Not investigated yet";
      $sql = "INSERT INTO user_disputes (dispute_time, dispute_date, device, ip_address, fullname, dispute) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array($injectionTime, $injectionDate, $device, $ip_address, $fullname, $text));
          // header("location: ../index.php?dispute=sent");


      
   }


}
}