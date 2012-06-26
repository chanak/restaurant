<?php
	include_once('../dbCon.php');
	// SQL query
	$query = "SELECT * FROM $tbl_food";
	// Execute the query (the recordset $records contains the result)
	$records = mysql_query($query);
	// Loop the recordset $records
	// Each row will be made into an array ($row) using mysql_fetch_array
	while($row = mysql_fetch_array($records)) {
	  // Write the value of the column FirstName (which is now in the array $row)
		echo 
			"<tr id='",$row['idfood'],"'>
			    <td><h1>",$row['name'],"</h1></td>
			    <td><h6>", $row['price'] ,"$</h6></td>
			    <td><h1>", $row['type'] ,"</h1></td>
			    <td><img src='../appStyle/img/",$row['image'],"'/></td>
			    <td> <input id='deleteFood' type='button' class='button' value='delete' /> </td>
			</tr>";

	}
?>