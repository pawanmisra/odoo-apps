<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
      $myusername = strtolower(mysqli_real_escape_string($db,$_POST['username']));
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT userId, employeeName, roleId FROM ECLAT_USER WHERE active_ = 'Y' AND LOWER(username) = '$myusername' and password_ = '$mypassword'";
	  
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $userId = $row['userId'];
	  $employeeName = $row['employeeName'];
	  $userRole = $row['roleId'];
      $count = mysqli_num_rows($result);
	
      if($count == 1) {
      	
      	
      	$sqlPrimaryAccount = "SELECT accountId FROM ECLAT_USER_ACCOUNTS WHERE userId = 1 AND primary_ = 1";
      	$resultPrimaryAccount = mysqli_query($db, $sqlPrimaryAccount);
      	$rowPrimaryAccount = mysqli_fetch_array($resultPrimaryAccount, MYSQLI_ASSOC);
      	$accountId = $rowPrimaryAccount['accountId'];
      	
         $_SESSION['login_user'] = $userId;
		 $_SESSION['name'] = $employeeName;
		 $_SESSION['roleId'] = $userRole;
		 $_SESSION['paccountId'] = $accountId;
		 if($userRole == 6) {
			$_SESSION['isMGR'] = "true";
		 }
		 
		 if($userRole == 7) {
		 	$_SESSION['isAdmin'] = "true";
		 }		 
		 
		 if($userRole == 3 || $userRole == 4 || $userRole == 5 || $userRole == 8) {
			$_SESSION['isQA'] = "true";
		 }		 
		
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$sqlLoginHistoryAdd = "INSERT INTO ECLAT_LOGIN_HISTORY VALUES (NULL, $userId, NOW(), NULL, '$ip', '$userAgent')";
		if (mysqli_query($db, $sqlLoginHistoryAdd)) {
			$sqlLoginHistroyGet = "select id_ from ECLAT_LOGIN_HISTORY where userId = $userId ORDER BY id_ DESC LIMIT 1";
			$resultLH = mysqli_query($db, $sqlLoginHistroyGet);
			$rowLH = mysqli_fetch_array($resultLH, MYSQLI_ASSOC);
			$LHID = $rowLH['id_'];
			$_SESSION['LHID'] = $LHID;
		}
		
		if($_SESSION['isQA'] == true || $_SESSION['isMGR'] == "true") {
         	header("location: audit.php");
		} else if($_SESSION['isAdmin'] == true) {
         	header("location: users.php");	
		} else {
		 	header("location: notificationview.php");
		}
		 
		 
      } else {
         $error = "Username or password is incorrect";
      }   
   } 
   mysqli_close($db);

?>