<?php
   include("../config.php");
   session_start();
   $user_check = $_SESSION['login_user'];
   $roleId = $_SESSION['roleId'];
   header('Content-Type: application/json');
   $response = array('success' => 'false', 'message' => 'User is not logged in.', 'error' => '100');
   
function getAuditorName($auditorCode) { 
	include("../config.php"); 
	$employeeName = '';  
	$sql = "SELECT employeeName FROM ECLAT_USER WHERE userId = $auditorCode";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	if($count == 1) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$employeeName = $row['employeeName'];	
	}
	
	return $employeeName;
}   
 
function mergeCodeAuditor($coderval, $auditorval){
	$newvalue = json_decode($coderval, true);
	$audval = json_decode($auditorval, true);
	if ((gettype($newvalue) == 'array' and gettype($audval) == 'array')){
		foreach($newvalue as $key => $val){
			if (($audval[$key] != "") && ($audval[$key] != $newvalue[$key])){
				$newvalue[$key] = $audval[$key];
			}
		}
		return json_encode($newvalue);
	}else {
		return $auditorval;
	}
	
} 
 
function dateFormat($date) {
	if($date == null || $date == '0000-00-00') {
		return '';
	} else {
		return date('m/d/Y',  strtotime($date));
	}	
}
 
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login_user'])) {
   
    $accountId = $_POST['accountId'];
    $acnumber = $_POST['acnumber'];
	
   	//$sqlSelect = "select * from ECLAT_CHART_COUNT where accountId = $accountId AND accountNo = '$acnumber'";
	$sqlSelect = "SELECT * FROM ECLAT_CHART_COUNT counts LEFT OUTER JOIN ECLAT_CHART_CODES codes ON codes.chartId = counts.id_ WHERE counts.accountId = $accountId AND counts.accountNo = '$acnumber'";
	$result = mysqli_query($db, $sqlSelect);
	$response = array();
	//$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
		$id = $row['id_'];
		$response['id'] = $row['id_'];
		$response['accountId'] = $row['accountId'];
		$response['chartTypeId'] = $row['chartTypeId'];
		$response['accountNo'] = $row['accountNo'];
		$response['dateReceived'] = dateFormat($row['dateReceived']);
		$response['dateCoded'] = dateFormat($row['dateCoded']);
		$response['dateCompleted'] = dateFormat($row['dateCompleted']);
		$response['coderCode'] = $row['coderCode'];	
		$response['codedBy'] = getAuditorName($row['coderCode']);	
		
		$response['prev_user'] =0;
		
		//overright the role if coderCode and logged in user are same
		if($row['coderCode'] == $user_check) {
			$roleId = 2;
		}
			
		$response['statusId'] = $row['statusId'];
		$response['codedDRG'] = $row['codedDRG'];
		$response['codedDispo'] = $row['codedDispo'];
		$response['auditDRG'] = $row['auditDRG'];
		$response['auditDispo'] = $row['auditDispo'];
		
		$response['specialization'] = $row['specialization'];
		$response['insuranceType'] = $row['insuranceType'];
		$response['los'] = $row['los'];	


		
		//$response['additionalInfo'] = htmlspecialchars($row['additionalInfo'], ENT_QUOTES, 'UTF-8');
		//$response['auditorComments'] = htmlspecialchars($row['auditorComments'], ENT_QUOTES, 'UTF-8');
		//$response['auditorFeedback'] = htmlspecialchars($row['auditorFeedback'], ENT_QUOTES, 'UTF-8');		
		$response['others'] = htmlspecialchars($row['others'], ENT_QUOTES, 'UTF-8');	

		$response['admitDate'] = dateFormat($row['admitDate']);
		$response['dischargeDate'] = dateFormat($row['dischargeDate']);
		$response['auditDate'] = dateFormat($row['auditDate']);
		$prop = $row['dataElement'];
		
		$coderval = $row['coderValue'];
		$audit1val = $row['audit1Value'];
		$audit2val = $row['audit2Value'];
		$audit3val = $row['audit3Value'];
		$auditTLval = $row['auditTLValue'];
		$auditSupValue = $row['auditSupervisorValue'];
		if ($roleId ==1 || $roleId ==2){ // User is coder or admin
			$response[$prop]['curr'] = $coderval;
			$response[$prop]['prev'] = $coderval;
			$response['coderComments'] = htmlspecialchars($row['coderComments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['additionalInfo'], ENT_QUOTES, 'UTF-8');
		}
		elseif($roleId ==3){// User is QA1
			if ($audit1val){
				//$new_val = mergeCodeAuditor($coderval, $audit1val);
				//$response[$prop] = $new_val;
				$response[$prop]['curr'] = $audit1val;
				$response[$prop]['prev'] = $coderval;
				$response['prev_user'] = 1;
			}
			else{
				$response[$prop]['curr'] = $coderval;
				$response[$prop]['prev'] = $coderval;
				$response['prev_user'] = 1;
			}
			$response['coderComments'] = htmlspecialchars($row['auditorComments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['auditorFeedback'], ENT_QUOTES, 'UTF-8');
		}
		elseif($roleId ==4){// User is QA2
			if ( $audit2val){
				//$new_val = mergeCodeAuditor($coderval, $audit2val);
				//$response[$prop] = $new_val;
				$response[$prop]['curr'] = $audit2val;
				$response[$prop]['prev'] = $audit1val;
				$response['prev_user'] = 3;
			}
			else{
				//$response[$prop] = 	$coderval;		//$audit1val;
				$response[$prop]['curr'] = 	$audit1val;
				$response[$prop]['prev'] = 	$audit1val;
				$response['prev_user'] = 3;
			}
			$response['coderComments'] = htmlspecialchars($row['auditor2Comments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['auditor2Feedback'], ENT_QUOTES, 'UTF-8');
		}
		elseif($roleId ==5){// User is QA3
			if ( $audit3val){
				//$new_val = mergeCodeAuditor($coderval, $audit3val);
				//$response[$prop] = $new_val;
				$response[$prop]['curr'] = $audit3val;
				$response[$prop]['prev'] = $audit2val;
				$response['prev_user'] = 4;
			}
			else{
				//$response[$prop] = $coderval; 	//$audit2val;
				$response[$prop]['curr'] = $audit2val;
				$response[$prop]['prev'] = $audit2val;
				$response['prev_user'] = 4;
			}
			$response['coderComments'] = htmlspecialchars($row['auditor3Comments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['auditor3Feedback'], ENT_QUOTES, 'UTF-8');
		}
		elseif($roleId ==8){// User is TL
			if ( $auditTLval ){
				//$new_val = mergeCodeAuditor($coderval, $auditTLval);
				//$response[$prop] = $new_val;
				$response[$prop]['curr'] = $auditTLval;
				$response[$prop]['prev'] = $audit1val;
				$response['prev_user'] = 3;
			} elseif($audit1val) {
				$response[$prop]['curr'] = $audit1val;	//$audit1val; QA1 can also escalte it to TL audit
				$response[$prop]['prev'] = $audit1val;
				$response['prev_user'] = 3;
			} else{
				$response[$prop]['curr'] = $coderval;	//$audit3val;
				$response[$prop]['prev'] = $coderval;
				$response['prev_user'] = 1;
			}
			$response['coderComments'] = htmlspecialchars($row['auditorTLComments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['auditorTLFeedback'], ENT_QUOTES, 'UTF-8');
		}
		elseif($roleId ==6){// User is Supervisor
			if ( $auditSupValue){
				//$new_val = mergeCodeAuditor($coderval, $auditSupValue);
				//$response[$prop] = $new_val;
				$response[$prop]['curr'] = $auditSupValue;
				$response[$prop]['prev'] = $auditTLval;
				$response['prev_user'] = 8; 
			} elseif($auditTLval) {
				$response[$prop]['curr'] = $auditTLval;
				$response[$prop]['prev'] = $auditTLval;
				$response['prev_user'] = 8;
			} elseif($audit3val) {
				$response[$prop]['curr'] = $audit3val;				
				$response[$prop]['prev'] = $audit3val;				
				$response['prev_user'] = 5;
			} elseif($audit2val) {
				$response[$prop]['curr'] = $audit2val;
				$response[$prop]['prev'] = $audit2val;
				$response['prev_user'] = 4;
			} elseif($audit1val) {
				$response[$prop]['curr'] = $audit1val;
				$response[$prop]['prev'] = $audit1val;
				$response['prev_user'] = 3; 
			} else{
				$response[$prop]['curr'] = $coderval;		//$auditTLval;
				$response[$prop]['prev'] = $coderval;
				$response['prev_user'] = 1;
				//$response[$prop] = $auditTLval;
			}
			$response['coderComments'] = htmlspecialchars($row['auditSupervisorComments'], ENT_QUOTES, 'UTF-8');
			$response['additionalInfo'] = htmlspecialchars($row['auditSupervisorFeedback'], ENT_QUOTES, 'UTF-8');
		}		
	}
	
	$response = json_encode($response);
   }
   
   mysqli_close($db);
   print $response;
?>