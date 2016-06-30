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
	$id_ = mysqli_real_escape_string($db,$_POST['id_']);
	$coderCode = mysqli_real_escape_string($db,$_POST['coderCode']);
	$prev_user = mysqli_real_escape_string($db,$_POST['prev_user']);
	
	
    $accountId = mysqli_real_escape_string($db,$_POST['client']);
    $chartType = mysqli_real_escape_string($db,$_POST['chartType']); 
    $acnumber = mysqli_real_escape_string($db,$_POST['acnumber']);
    $insurancetype = mysqli_real_escape_string($db,$_POST['insurancetype']); 
    $specialization = mysqli_real_escape_string($db,$_POST['specialization']);
    $los = mysqli_real_escape_string($db,$_POST['los']); 
	if ($los == ''){
		$los = 0;
	}
    $admitdate = mysqli_real_escape_string($db,$_POST['admitdate']);
    $receiveddate = mysqli_real_escape_string($db,$_POST['receiveddate']); 
    $dischargedate = mysqli_real_escape_string($db,$_POST['dischargedate']);
    //$codeddate = mysqli_real_escape_string($db,$_POST['codeddate']); 
    $coderComments = mysqli_real_escape_string($db,$_POST['coderComments']);
    $status = mysqli_real_escape_string($db,$_POST['status']); 
	$additionalinfo = mysqli_real_escape_string($db,$_POST['additionalinfo']); 
	
    $drg = mysqli_real_escape_string($db,$_POST['drg']);
    $disp = mysqli_real_escape_string($db,$_POST['disp']); 
	$adx = mysqli_real_escape_string($db,$_POST['adx']); 
	//$pdx = mysqli_real_escape_string($db,$_POST['pdx']);
	//$poa = mysqli_real_escape_string($db,$_POST['poa']); 	
	//$ppx = mysqli_real_escape_string($db,$_POST['ppx']); 	
	//$dos = mysqli_real_escape_string($db,$_POST['dos']); 	
	//$physicianid = mysqli_real_escape_string($db,$_POST['physicianid']); 	
	
	$pdx_poa_pdx_curr =  mysqli_real_escape_string($db,$_POST['pdx_poa-pdx_hidden_curr']);
	$pdx_poa_poa_curr =  mysqli_real_escape_string($db,$_POST['pdx_poa-poa_hidden_curr']);
	$pdx_poa_pdx_prev =  mysqli_real_escape_string($db,$_POST['pdx_poa-pdx_hidden_prev']);
	$pdx_poa_poa_prev =  mysqli_real_escape_string($db,$_POST['pdx_poa-poa_hidden_prev']);
	
	$ppx_dos_phyid_ppx_curr = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-ppx_hidden_curr']);
	$ppx_dos_phyid_dos_curr = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-dos_hidden_curr']);
	$ppx_dos_phyid_phyid_curr = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-phyid_hidden_curr']);
	$ppx_dos_phyid_ppx_prev = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-ppx_hidden_prev']);
	$ppx_dos_phyid_dos_prev = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-dos_hidden_prev']);
	$ppx_dos_phyid_phyid_prev = mysqli_real_escape_string($db,$_POST['ppx_dos_phyid-phyid_hidden_prev']);
	
	
	$sdx_poa_sdx_curr = mysqli_real_escape_string($db,$_POST['sdx_poa-sdx_hidden_curr']);
	$sdx_poa_poa_curr = mysqli_real_escape_string($db,$_POST['sdx_poa-poa_hidden_curr']);
	$sdx_poa_sdx_prev = mysqli_real_escape_string($db,$_POST['sdx_poa-sdx_hidden_prev']);
	$sdx_poa_poa_prev = mysqli_real_escape_string($db,$_POST['sdx_poa-poa_hidden_prev']);
	$sdx_poa_count = mysqli_real_escape_string($db,$_POST['sdx_poa-count']);
	
	$spx_dos_phyid_spx_curr = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-spx_hidden_curr']);
	$spx_dos_phyid_dos_curr = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-dos_hidden_curr']);
	$spx_dos_phyid_phyid_curr = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-phyid_hidden_curr']);
	$spx_dos_phyid_spx_prev = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-spx_hidden_prev']);
	$spx_dos_phyid_dos_prev = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-dos_hidden_prev']);
	$spx_dos_phyid_phyid_prev = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-phyid_hidden_prev']);
	$spx_dos_phyid_count = mysqli_real_escape_string($db,$_POST['spx_dos_phyid-count']);
	
	$cpt_mod_rev_dos_phyid_cpt_curr = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-cpt_hidden_curr']);
	$cpt_mod_rev_dos_phyid_mod_curr = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-mod_hidden_curr']);
	$cpt_mod_rev_dos_phyid_rev_curr = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-rev_hidden_curr']);	
	$cpt_mod_rev_dos_phyid_dos_curr = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-dos_hidden_curr']);
	$cpt_mod_rev_dos_phyid_physicianid_curr = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-phyid_hidden_curr']);
	$cpt_mod_rev_dos_phyid_cpt_prev = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-cpt_hidden_prev']);
	$cpt_mod_rev_dos_phyid_mod_prev = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-mod_hidden_prev']);
	$cpt_mod_rev_dos_phyid_rev_prev = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-rev_hidden_prev']);	
	$cpt_mod_rev_dos_phyid_dos_prev = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-dos_hidden_prev']);
	$cpt_mod_rev_dos_phyid_physicianid_prev = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-phyid_hidden_prev']);
	$cpt_mod_rev_dos_phyid_count = mysqli_real_escape_string($db,$_POST['cpt_mod_rev_dos_phyid-count']);
	
	$code_values = array(
	'drg'=>$drg, 'disp' => $disp, 'adx' => $adx,
	'pdx_poa-pdx'=> array($pdx_poa_pdx_curr, $pdx_poa_pdx_prev), 'pdx_poa-poa' => array($pdx_poa_poa_curr, $pdx_poa_poa_prev ), 
	'sdx_poa-sdx'=> array($sdx_poa_sdx_curr, $sdx_poa_sdx_prev ), 'sdx_poa-poa' => array($sdx_poa_poa_curr, $sdx_poa_poa_prev),
	'ppx_dos_phyid-ppx' => array($ppx_dos_phyid_ppx_curr, $ppx_dos_phyid_ppx_prev), 'ppx_dos_phyid-dos' => array($ppx_dos_phyid_dos_curr,$ppx_dos_phyid_dos_prev), 
	'ppx_dos_phyid-phyid' => array($ppx_dos_phyid_phyid_curr, $ppx_dos_phyid_phyid_prev), 'spx_dos_phyid-spx' => array($spx_dos_phyid_spx_curr, $spx_dos_phyid_spx_prev), 
	'spx_dos_phyid-dos' => array($spx_dos_phyid_dos_curr, $spx_dos_phyid_dos_prev), 'spx_dos_phyid-phyid' => array($spx_dos_phyid_phyid_curr, $spx_dos_phyid_phyid_prev),
	'cpt_mod_rev_dos_phyid-cpt' => array($cpt_mod_rev_dos_phyid_cpt_curr, $cpt_mod_rev_dos_phyid_cpt_prev),
	'cpt_mod_rev_dos_phyid-mod' => array($cpt_mod_rev_dos_phyid_mod_curr, $cpt_mod_rev_dos_phyid_mod_prev), 
	'cpt_mod_rev_dos_phyid-rev' => array($cpt_mod_rev_dos_phyid_rev_curr, $cpt_mod_rev_dos_phyid_rev_prev),
	'cpt_mod_rev_dos_phyid-dos' => array($cpt_mod_rev_dos_phyid_dos_curr, $cpt_mod_rev_dos_phyid_dos_prev),
	'cpt_mod_rev_dos_phyid-phyid' => array($cpt_mod_rev_dos_phyid_physicianid_curr, $cpt_mod_rev_dos_phyid_physicianid_prev),
	'sdx_poa-count' => $sdx_poa_count, 
	'spx_dos_phyid-count' => $spx_dos_phyid_count,
	'cpt_mod_rev_dos_phyid-count' => $cpt_mod_rev_dos_phyid_count
	);
	
	$dateCompleted = 'NULL';
	$codeddate = 'NOW()';
	$completedBy = "NULL";
	// Set completed date if the chart is completed only
	if($status == 1) {
		$dateCompleted = 'NOW()';
		$completedBy = $userId;
	}
	
	if($drg <=0 || $drg == '') {
		$drg = "NULL";
	}

	if($disp <=0 || $disp == '') {
		$disp = "NULL";
	}
	
	$loginId = $_SESSION['LHID'];  
	
	//overright the role if coderCode and logged in user are same
	if($coderCode == $userId) {
		$roleId = 2;
	}
	
	//coderCode = $userId

	if ($roleId == 1 || $roleId == 2){
		//Coder
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), dateCoded = $codeddate, coderComments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, loginId = $loginId, additionalInfo = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}
	elseif ($roleId == 3){
		//QA1
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), auditDate = NOW(), auditorCode = $userId, auditorComments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, auditorLoginId = $loginId, auditorFeedback = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}
	elseif ($roleId == 4){
		//QA2
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), audit2Date = NOW(), auditor2Code = $userId, auditor2Comments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, auditor2LoginId = $loginId, auditor2Feedback = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}
	elseif ($roleId == 5){
		//QA3
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), audit3Date = NOW(), auditor3Code = $userId, auditor3Comments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, auditor3LoginId = $loginId, auditor3Feedback = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}
	elseif ($roleId == 8){
		//TL
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), auditTLDate = NOW(), auditTLCode = $userId, auditorTLComments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, auditorTLLoginId = $loginId, auditorTLFeedback = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}
	elseif ($roleId == 6){
		//Supervisor
		$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), auditSupervisorDate = NOW(), auditSupervisorCode = $userId, auditSupervisorComments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, auditorSuperVisorLoginId = $loginId, auditSupervisorFeedback = '$additionalinfo', completedBy = $completedBy where id_ = $id_";
	}				
	//$sqlUpdate = "update ECLAT_CHART_COUNT set chartTypeId = $chartType, statusId = '$status', insuranceType = '$insurancetype', specialization = '$specialization', admitDate = STR_TO_DATE('$admitdate', '%m/%d/%Y'), dischargeDate = STR_TO_DATE('$dischargedate', '%m/%d/%Y'), los = '$los', dateReceived = STR_TO_DATE('$receiveddate', '%m/%d/%Y'), dateCoded = STR_TO_DATE('$codeddate', '%m/%d/%Y'), coderComments = '$coderComments', dateModified = NOW(), dateCompleted = $dateCompleted, loginId = $loginId, additionalInfo = '$additionalinfo' where id_ = $id_";
	$drg_disp_adx_counts = ['drg', 'disp', 'adx', 'sdx_poa-count', 'spx_dos_phyid-count', 'cpt_mod_rev_dos_phyid-count'];
	if($id_ >= 1) {
	//record already exists update the record
		$selectrec = "select statusId from ECLAT_CHART_COUNT where id_ = $id_";
		$result = mysqli_query($db, $selectrec);
		// output data of each row
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$status_old = $row["statusId"];
		$resultUpdated = mysqli_query($db, $sqlUpdate);	
		$sqlSelect = "select * from ECLAT_CHART_CODES where chartId='$id_' and dataElement in ('drg', 'disp', 'adx')";
		$resultcode = mysqli_query($db, $sqlSelect);
		$codes = array();
		while ($coderows = mysqli_fetch_array($resultcode, MYSQL_ASSOC)) {
			$dataElement = $coderows['dataElement'];
			$codes[$dataElement]['coderValue'] = $coderows['coderValue'];
			$codes[$dataElement]['audit1Value'] = $coderows['audit1Value'];
			$codes[$dataElement]['audit2Value'] = $coderows['audit2Value'];
			$codes[$dataElement]['audit3Value'] = $coderows['audit3Value'];
			$codes[$dataElement]['auditTLValue'] = $coderows['auditTLValue'];
			$codes[$dataElement]['auditSupervisorValue'] = $coderows['auditSupervisorValue'];
		}
		if ($resultUpdated) {	
			if ($status_old != $status){
				$inserttracker = "INSERT INTO ECLAT_CHART_TRACKER VALUES (NULL, '$id_', $status, '$loginId', $roleId, NOW())";
				mysqli_query($db, $inserttracker);
			}	
			
			
			//UPDATING PREVIOUS USERS VALUES--------
			foreach($code_values as $key => $value){
				if ($prev_user == 1 || $prev_user == 2){
					if(in_array($key, $drg_disp_adx_counts)){
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET coderValue= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($prev_user == 3){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							//$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit1Value= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;						
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit1Value= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($prev_user == 4){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							//$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit2Value= '$value[1]' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;						
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit2Value= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($prev_user == 5){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							//$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit3Value= '$value[1]' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit3Value= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($prev_user == 8){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							//$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditTLValue= '$value[1]' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{					
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditTLValue= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($prev_user == 6){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							//$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditSupervisorValue= '$value[1]' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{										
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditSupervisorValue= '$value[1]' where chartId='$id_' and dataElement='$key'";
					}
				}				
				if ($sqlinsertcodes != false){
					mysqli_query($db, $sqlinsertcodes);
				}
			}
			
			//UPDATING CURRENT USER
			foreach($code_values as $key => $value){
				if ($roleId == 1 || $roleId == 2){

					$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET coderValue= '$value[0]' where chartId='$id_' and dataElement='$key'";
				}
				elseif ($roleId == 3){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit1Value= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;						
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit1Value= '$value[0]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($roleId == 4){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit2Value= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;						
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit2Value= '$value[0]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($roleId == 5){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit3Value= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET audit3Value= '$value[0]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($roleId == 8){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditTLValue= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{					
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditTLValue= '$value[0]' where chartId='$id_' and dataElement='$key'";
					}
				}
				elseif ($roleId == 6){
					if(in_array($key, $drg_disp_adx_counts)){
						//if ($codes[$key]['coderValue'] != $value){
							$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditSupervisorValue= '$value' where chartId='$id_' and dataElement='$key'";
						//}
						//else $sqlinsertcodes = false;
					}
					else{										
						$sqlinsertcodes = "UPDATE ECLAT_CHART_CODES SET auditSupervisorValue= '$value[0]' where chartId='$id_' and dataElement='$key'";
					}
				}				
				if ($sqlinsertcodes != false){
					mysqli_query($db, $sqlinsertcodes);
				}
			}
			
			$success = "Added/Updated Successfully.";
		} else {
			$error = "Error while saving the record.";
		}
	} else {


	$sql = "INSERT INTO ECLAT_CHART_COUNT VALUES (NULL, $accountId, $chartType, '$acnumber', '$insurancetype', '$specialization', $status,  STR_TO_DATE('$admitdate', '%m/%d/%Y'), STR_TO_DATE('$dischargedate', '%m/%d/%Y'), $los, STR_TO_DATE('$receiveddate', '%m/%d/%Y'), $codeddate, $dateCompleted, NULL, NULL, NULL, NULL, NULL, $userId, NULL, NULL, NULL, NULL, NULL, $completedBy, '$coderComments', '', '', '', '', '', '' ,'', '', '', '', '', NOW(), NULL, NULL, '$loginId', NULL, NULL, NULL, NULL, NULL, '$additionalinfo', NULL)";
	if (mysqli_query($db, $sql)) {
		$sqllastchart = "select id_ from ECLAT_CHART_COUNT ORDER BY id_ DESC LIMIT 1";
		$resultchart = mysqli_query($db, $sqllastchart);
		$rowCH = mysqli_fetch_array($resultchart, MYSQLI_ASSOC);
		$chart_id= $rowCH['id_'];
		//$chart_id = 0;
		$inserttracker = "INSERT INTO ECLAT_CHART_TRACKER VALUES (NULL, '$chart_id', $status, '$loginId', $roleId, NOW())";
		mysqli_query($db, $inserttracker);
		foreach($code_values as $key => $value){
			if(in_array($key, $drg_disp_adx_counts)){
				$sqlinsertcodes = "INSERT INTO ECLAT_CHART_CODES VALUES('$chart_id', '$key', '$value', NULL, NULL, NULL, NULL, NULL)";
			}
			else{
				$sqlinsertcodes = "INSERT INTO ECLAT_CHART_CODES VALUES('$chart_id', '$key', '$value[0]', NULL, NULL, NULL, NULL, NULL)";
			}
			mysqli_query($db, $sqlinsertcodes);
		}
		$success = "Added/Updated Successfully.";
	} else {
		$error = "Error while saving the record.";
	}
	
	} // else close
   
   }
   mysqli_close($db);
?>