<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="appStyle/confirmation.css" />
</head>
<body>
<div id="main">

<?
include('dbCon.php');

// Activation (the random md5) from link 
$activation=$_GET['activation'];

// Retrieve data from table where row that match this activation 
$sql1="SELECT * FROM $tbl_users WHERE activation ='$activation'";
$result=mysql_query($sql1);

// If successfully queried 
if($result){
	// Count how many row has this activation
	$count=mysql_num_rows($result);
	// if found this activation in the database, retrieve data from table
	if($count==1){
		$rows=mysql_fetch_array($result);
		// Update the activation code with Complete state
		$sql2="UPDATE $tbl_users SET activation='complete', admin='no' WHERE activation='$activation'";
		$result2=mysql_query($sql2);
		} else { // if not found activation, display message "Wrong Confirmation code" 
		echo "<h2>Wrong Confirmation code</h2>";
		}
	// Sucsess
	if($result2){
	echo "<h1>Your account has been activated</h1> <br/> <a href='http://restourant.allalla.com'><h3>www.restourant.allalla.com</h3></a>";
	}
} else {echo "<h2>error<h2>";}
?>

</div>
</body></html>