<!DOCTYPE html>
<html>
	<head>
		<?php
	 	session_start(); 
	 	if( !isset($_SESSION['admin'])) { 
	 		header("location:../../index.php");} ?>
	 		
		<link rel="stylesheet" type="text/css" href="../appStyle/reset.css" />
		<link rel="stylesheet" type="text/css" href="../appStyle/app.css" />
		<link rel="stylesheet" type="text/css" href="../../style/jquery.fancybox.css" />
		
		<script src="../js/jquery-1.7.2.min.js"></script>
 		<script src="../../js/jquery.fancybox.js"></script>

 		<script src="../js/successAdmin.js"></script>
	</head>
	<body>
		<!-- MENU -->
		<div id="topMenuContainer">
			<div id="menuContainer">
				<div class="loggedMenu">
					<ul>
						<li><h1>WELCOME <?php echo "&nbsp".($_SESSION['admin']." !"); ?></h1></li>
						<li><a href="logout.php" class="button" >Logout</a></li>
					</ul>
				</div>
				<div class="orderMenu">
					<ul id="orderMenu">
						<li><a id="actionBox" class="button" data-fancybox-type="iframe" href="addFood.html" >Add food</a></li>
						<li><a id="viewBox" class="button" href=".viewUsers" >Users</a></li>
						<li><a id="viewBox" class="button" href=".viewOrders" >Orders</a></li>
					</ul>
				</div>
			</div>
		</div>

		<!-- MAIN BODY -->
		<div id="mainContainer">
			<div id="adminFoodList" >
			<table id="foodTable" style="width: 980px;">
				<tr id="category">
					<th><h6>Name</h6></th>
					<th><h6>Price</h6></th>
					<th><h6>Type</h6></th>
					<th><h6>Image</h6></th>
					<th></th>
				</tr>
				<?php include('getFood.php');?>
			</table>
			<div>
		</div>

		<!-- USERS -->
		<div class="viewUsers" style="display:none">
			<input id="searchUsers" class='label' style="width: 200px;" type='text' value='' placeholder="Search">
			<table id="usersTable" border='1'>
				<tr id="userCategories">
					<th><h6>User</h6></th>
					<th><h6>Email</h6></th>
					<th><h6>Admin</h6></th>
					<th><h6>Authentication</h6></th>
					<th></th>
				</tr>
				<?php include('getUsers.php');?>
			</table>
		</div>

		<!-- VIEW ORDERS -->
		<div class="viewOrders" style="display:none">
			<table>
				<tr>
					<th><h6>User</h6></th>
					<th><h6>Product</h6></th>
					<th><h6>Quantity</h6></th>
					<th><h6>Price</h6></th>
					<th><h6>Date</h6></th>
					<th><h6>Total</h6></th>
					<th><h6>Status</h6></th>
					<th></th>
				</tr>
				<?php include('getOrders.php');?>
			</table>
		</div>

	</body>
</html>