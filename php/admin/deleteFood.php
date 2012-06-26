<?php
	include_once('../dbCon.php');
	// check the data with POST
	if(isset($_POST['id'])) {
		// Get the data with POST
		$idfood = stripslashes($_POST['id']);
		$idfood = mysql_real_escape_string($idfood);
	  	$result = mysql_query("DELETE FROM $tbl_food WHERE idfood=$idfood");
	} else { 
		echo "<h5>id error<h5>";
	}
?>