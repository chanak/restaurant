<?php
	include_once('../dbCon.php');
	// check the data with POST
	if(isset($_POST['id'])) {
		// Get the data with POST
		$idorders = stripslashes($_POST['id']);
		$idorders = mysql_real_escape_string($idorders);
	  	$result = mysql_query("DELETE FROM $tbl_orders WHERE idorders=$idorders");
	} else { 
		echo "<h5>id error<h5>";
	}
?>