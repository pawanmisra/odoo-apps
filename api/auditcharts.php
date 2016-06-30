<?php
   include("config.php");
   session_start();
   $user_check = $_SESSION['login_user'];
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login_user'])) {
      // username and password sent from form 
	 
	$userId = $user_check;
	$id_ = mysqli_real_escape_string($db,$_POST['id_']);
    $auditdrg = mysqli_real_escape_string($db,$_POST['auditdrg']);
    $auditdispo = mysqli_real_escape_string($db,$_POST['auditdispo']); 	
	$status = mysqli_real_escape_string($db,$_POST['status']); 
	$previousStatus = mysqli_real_escape_string($db,$_POST['previousStatus']); 
    $auditorComments = mysqli_real_escape_string($db,$_POST['auditorComments']);
    $auditorFeedback = mysqli_real_escape_string($db,$_POST['auditorFeedback']);
	$loginId = $_SESSION['LHID'];
	
	$dateCompleted = 'dateCompleted = NULL, ';
	// Set completed date if the chart is completed only
	if($status == 1) {
		$dateCompleted = 'dateCompleted = NOW(), ';
	}
	
	if($status == $previousStatus) {
		$dateCompleted = '';
	}
	
	$sqlUpdate = "update ECLAT_CHART_COUNT set statusId = '$status', $dateCompleted auditDRG = '$auditdrg', auditDispo = '$auditdispo', auditorComments = '$auditorComments', auditorFeedback = '$auditorFeedback', dateModified = NOW(), auditDate = NOW(), auditorLoginId = $loginId where id_ = $id_";
	
	if($id_ >= 1) {
	//record already exists update the record
	
		$resultUpdated = mysqli_query($db, $sqlUpdate);	
		if ($resultUpdated) {
			$success = "Record Updated Successfully.";
		} else {
			$error = "Error while saving the record.";
		}
	}
   }
   mysqli_close($db);
?>