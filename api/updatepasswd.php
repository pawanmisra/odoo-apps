<?php
   include("config.php");
   session_start();
   $user_check = $_SESSION['login_user'];
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login_user'])) {
      // username and password sent from form 
	 
	$userId = $user_check;
    $mypassword = mysqli_real_escape_string($db,$_POST['currentPassword']);
    $newpassword = mysqli_real_escape_string($db,$_POST['newPassword']); 	
		 
      $sql = "SELECT userId, employeeName FROM ECLAT_USER WHERE userId = '$userId' and password_ = '$mypassword'";
      $sqlUpdate = "update ECLAT_USER set password_ = '$newpassword' WHERE userId = '$userId'";	  
	  
	  $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $userId = $row['userId'];
      $count = mysqli_num_rows($result);	  
	  
	  if($count == 1) {
      $resultChangePassword = mysqli_query($db, $sqlUpdate);	
      if($resultChangePassword) {
         $_SESSION['login_user'] = $userId;
		 $success = "Password Updated Successfully.";
      } else {
         $error = "Password not updated";
      }
	  } else {
		$error = "Current Password is incorrect.";
	  }
	   
   }
   mysqli_close($db);
?>