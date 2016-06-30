<?php
   include("config.php");
   session_start();
   $user_check = $_SESSION['login_user'];
   if (isset($_SESSION['roleId'])){
		$roleId = $_SESSION['roleId'];
	}
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login_user'])) {
      // username and password sent from form 
	 
	$userId = $user_check;
	$clientName = mysqli_real_escape_string($db,$_POST['clientName']);
	
	$sqlSelect = "SELECT * FROM ECLAT_ACCOUNT WHERE accountName LIKE '$clientName'";
	
	if($clientName != "") {

		//record already exists update the record
		$result = mysqli_query($db, $sqlSelect);
		$count = mysqli_num_rows($result);
		
		if($count >= 1) {
			$error = "Client already exists in the system.";
		} else {
			
			$sql = "INSERT INTO ECLAT_ACCOUNT VALUES (NULL, '$clientName', 'Y')";
			
			if (mysqli_query($db, $sql)) {
				$success = "New Client Record Added Successfully.";
			}
		}
	
	}	
   
   }
   mysqli_close($db);
?>