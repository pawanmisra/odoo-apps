<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	  
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT ac.accountName, ctype.chartType, stats.statusName, chart.* 
				FROM ECLAT_CHART_COUNT chart 
				JOIN ECLAT_ACCOUNT ac ON chart.accountId = ac.accountId
				JOIN ECLAT_CHART_TYPE ctype ON chart.chartTypeId = ctype.chartTypeId 
				JOIN ECLAT_CLIENT_STATUS stats ON chart.statusId = stats.statusId 
				WHERE chart.coderCode = '$userId'
				ORDER BY id_ DESC";
	  
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $userId = $row['userId'];
	  $employeeName = $row['employeeName'];
	  $userRole = $row['role'];
      $count = mysqli_num_rows($result);
	
      if($count == 1) {
         $_SESSION['login_user'] = $userId;
		 $_SESSION['name'] = $employeeName;
		 if($userRole == "Admin") {
			$_SESSION['isAdmin'] = "true";
		 }
         header("location: home.php");
      } else {
         $error = "Username or password is incorrect";
      }   
   } 
   mysqli_close($db);

?>