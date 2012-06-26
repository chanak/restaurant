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
	  echo "<li  class='productDiv'>"
	  ,"<img src='../appStyle/img/", $row['image'] ,"'/>"
	  ,"<div id='productContent'>"
	  ,"<h3>", $row['type'] ,"</h3>"
	  ,"<h1>", $row['name'] ,"</h1>"
	  ,"<h2> $", $row['price'] ,"</h2>"
	  ,"<input class='label' style='width: 65px;' type='numbers' value='1'>"
	  ,"<op style='display:none'>$", $row['price'] ,"</op>"
	  ,"</div>","</li>";
	}
?>