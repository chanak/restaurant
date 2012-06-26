<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
	<link rel="stylesheet" type="text/css" href="style/reset.css" />
 	<link rel="stylesheet" type="text/css" href="style/style.css" />
 	<script src="php/js/jquery-1.7.2.min.js"></script>

 	<link rel="stylesheet" type="text/css" href="style/jquery.fancybox.css" />
 	<script src="js/jquery.fancybox.js"></script>
 	<script src="js/index.js"></script>
 	<?php
	 	session_start(); 
	 	if( isset($_SESSION['user'])) { 
	 		header("location:php/user/successUser.php"); 
	 	} elseif (isset($_SESSION['admin'])) {
	 		header("location:php/admin/successAdmin.php"); 
	 	}
 	?>
</head>

<body>
<!-- Logo and description -->
<div class="logo" ><div><h2><br/><br/>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
 sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
 Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
 ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h2></div></div>

<!-- Login form -->
<div id="loginDiv" class="basicDiv">
	<form id="login" method="post" action="php/loginCheck.php">
	    <fieldset id="inputs">
	        <input type="text" class="label" name="uname" placeholder="Username" autofocus required>
	        <input type="password" class="label" name="pword" placeholder="Password" required>
	    </fieldset>
	    <fieldset id="actions">
	    	<input id="button" type="submit" class="button" value="Log in"><h1>Or</h1>
	    	<!-- Register trigger -->
	        <a id="registerBtn" class="button" href="#registerDiv">Register</a>
	    </fieldset>
	</form>
</div>

<!-- Register form ( hidden form that loads with ajax ) -->
<div style="display:none">
<div id="registerDiv" class="basicDiv" >
	<form id="register_form" method="post" action="">
		<label for="username"><h2>Username: </h2></label>
		<input type="text" class="label" id="username" name="Username" placeholder="Username" />

		<label for="password"><h2>Password: </h2></label>
		<input type="password" class="label" id="password" name="Password" placeholder="Password" />
	
		<label for="confirmPassword"><h2>Confirm Password: </h2></label>
		<input type="password" class="label" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" />

		<label for="email"><h2>Email: </h2></label>
		<input type="text" class="label" id="email" name="Email" placeholder="Email Adress" />

		<input type="submit" class="button" value="Register" /><a  id="login_error" style=" display: none;
		background: #2D2D2D; color: #FF2A55; font-weight: bold;">All field are required</a>
	</form>
</div>
</div>

</body>
</html>