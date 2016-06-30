<?php
   include("config.php");
   session_start();
    $LHID = $_SESSION['LHID'];     
    $sql = "update ECLAT_LOGIN_HISTORY set logoutDate = NOW() where id_ = $LHID";
	mysqli_query($db, $sql);
    mysqli_close($db);

?>