<!DOCTYPE html>
<html>
	<head>
		<?php
	 	session_start(); 
	 	if( !isset($_SESSION['user'])) { 
	 		header("location:../../index.php");} ?>
	 		
		<link rel="stylesheet" type="text/css" href="../appStyle/reset.css" />
		<link rel="stylesheet" type="text/css" href="../appStyle/app.css" />
		<link rel="stylesheet" type="text/css" href="../../style/jquery.fancybox.css" />
		
		<script src="../js/jquery-1.7.2.min.js"></script>
		<script src="../js/jquery-ui-1.8.20.custom.min.js"></script>

		<script src="../js/jquery.jrumble.1.3.min.js"></script>
 		<script src="../../js/jquery.fancybox.js"></script>

 		<script src="../js/successUser.js"></script>
	</head>
	<body>

		<!-- MAIN MENU -->
		<div id="topMenuContainer">
			<div id="menuContainer">
				<div class="loggedMenu">
					<ul>
						<li><h1>WELCOME <?php echo "&nbsp".($_SESSION['user']." !"); ?></h1></li>
						<li><a href="logout.php" class="button" >Logout</a></li>
					</ul>
				</div>
				<div class="orderMenu">
					<ul id="orderMenu">
						<li><h1>TOTALS: </h1></li>
						<li id="totals"><h5>0$</h5></li>
						<li><a id="fancyBtn" class="button" href=".orders" >Order</a></li>
						<li><a id="fancyBtn" class="button" href=".viewOrders" >View past orders</a></li>
					</ul>
				</div>
			</div>

		</div>

		<!-- CATEGORIES -->
		<div id="category">
			<div id="bounds">
				<label><input id="All" type="radio" name="input"><span>All</span></label>
			    <label><input id="FastFood" type="radio" name="input"><span>FastFood</span></label>
			    <label><input id="DinnerMain" type="radio" name="input"><span>Dinner main</span></label>
			    <label><input id="Desserts" type="radio" name="input"><span>Desserts</span></label>
			    <label><input id="Drinks" type="radio" name="input"><span>Drinks</span></label>
			</div>
		</div>

		<!-- MAIN BODY -->
		<div id="mainContainer">
			<!-- Orders and Products list frontend -->
			<ul id='productsList' class='containerDiv'><?php include('getFood.php'); ?></ul>
			<ul id='orderList' class='containerDiv'></ul>
			<!-- ORDER TABLE -->
			<div class="orders" style="display:none">
				<table id="ordersTable" >
					<tr>
						<th><h4>Total:</h4></th>
						<th id="total"><h4>$0</h4></th>
						<th><a class="button" id="placeOrder">Place order</a></th>
					</tr>
					<tr>
						<th><h6>Product</h6></th>
						<th><h6>Quantity</h6></th>
						<th><h6>Price</h6></th>
					</tr>
				</table>
			</div>

			<!-- VIEW PAST ORDERS -->
			<div class="viewOrders" style="display:none">
				<table>
					<tr>
						<th><h6>Product</h6></th>
						<th><h6>Quantity</h6></th>
						<th><h6>Price</h6></th>
						<th><h6>Date</h6></th>
						<th><h6>Total</h6></th>
						<th><h6>Status</h6></th>
					</tr>
					<?php include('viewPastOrders.php');?>
				</table>
			</div>

		</div>
	</body>
</html>