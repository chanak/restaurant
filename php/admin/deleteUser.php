<?php
	include_once('../dbCon.php');
	// check the data with POST
	if(isset($_POST['id'])) {
		// Get the data with POST
		$iduser = stripslashes($_POST['id']);
		$iduser = mysql_real_escape_string($iduser);
	  	$result = mysql_query("DELETE FROM $tbl_users WHERE idusers=$iduser");
	} else { 
		echo "<h5>id error<h5>";
	}
?>