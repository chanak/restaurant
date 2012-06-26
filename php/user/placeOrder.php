<?php
	include_once('../dbCon.php');
	session_start(); 
	$usrname = $_SESSION['user'];
	$json = json_decode($_POST['json'], true);
	
	// IMPORTANT IMPORTANT IMPORTANT IMPORTANT

	/*FOR PHP 5.2 AND BELOW
	$json = json_decode(str_replace('\\', '', $_POST['json']), true);*/

	if (!empty($json)){
	foreach($json as $value) 
	    {
		    $sql="INSERT INTO $tbl_orders( username, product, quantity, datee, status) VALUES ('$usrname', '$value[name]', '$value[quantity]', CURDATE(), 'pending')";
		    $result=mysql_query($sql);
	    };
		echo "<h4>Thank you for your enquiry</h4>";
	} else {
		echo "<h6>You need to select some products first</h6>";
	}
?>