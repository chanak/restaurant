<?php
	include_once('../dbCon.php');
	$usrname = $_SESSION['user'];
	// SQL query
	$queryOrders = "SELECT * FROM $tbl_orders where username='$usrname'";
	// Execute the query (the recordset $records contains the result)
	$recordsOrders = mysql_query($queryOrders);
	if(mysql_num_rows($recordsOrders) > 0) {
		// Loop the recordset $records
		// Each row will be made into an array ($row) using mysql_fetch_array
		while($rowOrders = mysql_fetch_array($recordsOrders)) {
		$product = $rowOrders['product'];
			$queryFood = "SELECT * FROM $tbl_food where name='$product'";
			$recordsFood = mysql_query($queryFood);

			while($rowFood = mysql_fetch_array($recordsFood)) {
				$price = $rowFood['price'];
				$totalPrice = $price * $rowOrders['quantity'];
			}
		  	// Write the table
			echo 
				"<tr>
				    <td><h6>", $rowOrders['product'] ,"</h6></td>
				    <td><h1>", $rowOrders['quantity'] ,"</h1></td>
				    <td><h5>$", $price ,"</h5></td>
				    <td><h4>", $rowOrders['datee'] ,"</h4></td>
				    <td><h5>$", $totalPrice ,"</h5></th>",

				    ($rowOrders['status']== 'pending'?
				    	"<td><h5>pending</h5></td>" :
				    	"<td><h4>completed</h4></td>"),

				"</tr>";
		}
	}
?>