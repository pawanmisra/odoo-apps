<?php
   include("config.php");
   session_start();
   $user_check = $_SESSION['login_user'];
   if (isset($_SESSION['roleId'])){
		$roleId = $_SESSION['roleId'];
	}
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login_user'])) {
      // username and password sent from form 
	 
	$userId = mysqli_real_escape_string($db,$_POST['userId']);
	$employeeName = mysqli_real_escape_string($db,$_POST['employeeName']);
	
    $username = strtolower(mysqli_real_escape_string($db,$_POST['username']));
    $password = mysqli_real_escape_string($db,$_POST['newPassword']); 
  
    $location = mysqli_real_escape_string($db,$_POST['location']);
    $role = mysqli_real_escape_string($db,$_POST['role']);
    $reviewPercentAge = mysqli_real_escape_string($db,$_POST['reviewPercentAge']);
    
    $clientPrimary = mysqli_real_escape_string($db,$_POST['clientPrimary']);
  //  $clientSecondary = mysqli_real_escape_string($db,$_POST['clientSecondary']);
    $specialty = mysqli_real_escape_string($db,$_POST['specialty']);
  //  $specialtyExperience = mysqli_real_escape_string($db,$_POST['specialtyExperience']);
    
    $otherCodingExperience = mysqli_real_escape_string($db,$_POST['otherCodingExperience']);    
    $specialtyExperienceValues = implode(",",  $_POST['specialtyExperience']);   
    $statusId = mysqli_real_escape_string($db,$_POST['statusId']);
    
    if($userId !=0) {
    	
    	$sqlUpdate = "UPDATE ECLAT_USER SET employeeName='$employeeName', username = '$username', location ='$location', roleId = $role, active_	= '$statusId',	specialty = '$specialty', reviewPercentAge = '$reviewPercentAge', specialtyExperience = '$specialtyExperienceValues', otherCodingExperience = '$otherCodingExperience' WHERE userId = $userId";
    	mysqli_query($db, $sqlUpdate);
    	
    	if($password != "") {
    		$sqlUpdate = "UPDATE ECLAT_USER SET password_='$password' WHERE userId = $userId";
    		mysqli_query($db, $sqlUpdate);
    	}
    	
    	$success = "User Account Updated Successfully.";
    	
    } else {
    	//Add new user
    	
    	// Verify if the user exits or not
    	$sql = "SELECT userId FROM ECLAT_USER WHERE LOWER(username) = '$username'";
    	$result = mysqli_query($db, $sql);
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    	$count = mysqli_num_rows($result);    	
    	
    	if($count == 1) {
    		$error = "User account already exists. Please choose a different username.";
    	} else {
    		//Add new user
    		
    		$sqlInsert = "INSERT INTO ECLAT_USER VALUES (NULL, '$employeeName', '$username', '$password', '$location', 'M', '$statusId', '$specialty', '$role', '$reviewPercentAge', '$specialtyExperienceValues', '$otherCodingExperience' )";
    		mysqli_query($db, $sqlInsert);
    		
    		$sql = "SELECT userId FROM ECLAT_USER WHERE LOWER(username) = '$username'";
    		$result = mysqli_query($db, $sql);
    		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);   		
    		$userId = $row['userId'];
    		$success = "User Account Added Successfully.";
    	}
    	
    }
    
    //Update Client account list
	$sqlDeleteUserClients = "DELETE FROM ECLAT_USER_ACCOUNTS WHERE userId = $userId";
	mysqli_query($db, $sqlDeleteUserClients);
	
	//Insert primary client
	$sqlPrimaryClient = "INSERT INTO ECLAT_USER_ACCOUNTS VALUES ($userId, $clientPrimary, 1)";
	mysqli_query($db, $sqlPrimaryClient);
	
	//Insert secondary clients
	$clientSecondaryValues = $_POST['clientSecondary'];
	foreach ($clientSecondaryValues as $a) {
		$sqlSecondaryClient = "INSERT INTO ECLAT_USER_ACCOUNTS VALUES ($userId, $a, 0)";
		mysqli_query($db, $sqlSecondaryClient);
	}	

   }
   mysqli_close($db);
?>