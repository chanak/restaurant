<?php
include('dbCon.php');

// MySQL injection protection
$username = stripslashes($_POST['uname']);
$password = stripslashes($_POST['pword']);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// Querry for selecting username and password
$sql="SELECT * FROM $tbl_users WHERE username='$username' and password='$password' and activation='complete'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$row = mysql_fetch_array($result);

// If result matched $username and $password, table row must be 1 row
if(empty($row)){
	sleep(2);
	header("location:../index.php");
}
else {
	session_start();
	if($row['admin'] == "no"){
	// Register sessions $username, $password and redirect"
		$_SESSION["user"] = $username;
		$_SESSION["password"] = $password;
		header("location:user/successUser.php");
	} else{
		$_SESSION["admin"] = $username;
		$_SESSION["password"] = $password;
		header("location:admin/successAdmin.php");
	}
}
?>