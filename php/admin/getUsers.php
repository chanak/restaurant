<?php
	include_once('../dbCon.php');
	// SQL query
	$query = "SELECT * FROM $tbl_users";
	// Execute the query (the recordset $records contains the result)
	$records = mysql_query($query);
	// Loop the recordset $records
	// Each row will be made into an array ($row) using mysql_fetch_array
	while($row = mysql_fetch_array($records)) {
	  // Write the value of the column FirstName (which is now in the array $row)
		echo 
			"<tr id='",$row['idusers'],"'>
			    <td><h1>",$row['username'],"</h1></td>
			    <td><h6>", $row['email'] ,"</h6></td>
			    <td><h1>", $row['admin'] ,"</h1></td>
			    <td><h4>", $row['activation'] ,"</h4></td>
			    <td> <input id='deleteUser' type='button' class='button' value='delete' /> </td>
			</tr>";

	}
?>