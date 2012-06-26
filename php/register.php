
<?php
include_once('dbCon.php');

if(!empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['confirmPassword']) && !empty($_POST['Email']))
{
	$username = stripslashes($_POST['Username']); // strip slashes
	$password = stripslashes($_POST['Password']);
    $confirmPassword = basename(stripslashes($_POST['confirmPassword']));
    $email    = stripslashes($_POST['Email']);
	$username = mysql_real_escape_string($username);  // make it unable to execute code
	$password = mysql_real_escape_string($password);
    $confirmPassword = mysql_real_escape_string($confirmPassword);
    $email    = mysql_real_escape_string($email);

    if ($password == $confirmPassword) { // Check if passwords match
        // Querry for selecting username and password
        $sqlCP="SELECT * FROM $tbl_users WHERE username='$username' or email='$email'";
        $resultCP=mysql_query($sqlCP);

        // Mysql_num_row is counting table row
        $count=mysql_num_rows($resultCP);
        if ($count==0){

            if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)*.([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)*([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
            $email )){ // Check if the email is in valid format
                // Randomize md5 activation code
                $activation = md5(uniqid(rand()));
                // Insert data into database 
                $sql="INSERT INTO $tbl_users( username, password, email, activation)VALUES('$username', '$password', '$email', '$activation')";
                $result=mysql_query($sql);
                // If everything is good so far send the email
                if($result){
                // send e-mail to this adress
                $to=$email;
                // subject
                $subject="Online Restourant Register Confirmation";
                // From
                $header="from: Online Restourant <dont@replay>";
                // message
                $message="Your Online Restourant registration is complete \r\n";
                $message.="Click on this link to activate your account \r\n";
                $message.="http://restourant.allalla.com/php/registerConfirmation.php?activation=$activation";
                // send email
                $sentmail = mail($to,$subject,$message,$header);
                }
                else { // if not found 
                echo "<h3>Somethign went terribly wrong</h3>";
                }
                if($sentmail){ // if email succesfully sent
                echo "<h4>Your Confirmation link has been sent to your email address.</h4>";
                }
                else { // if email is not succesfully sent
                echo "<h3>Cannot send Confirmation link to your email address</h3>";
                }

            } else { // Email not valid
                echo "<h3>Please enter a valid Email adress</h3>"; 
            }

        } else { // Email or username already in use
            echo "<h3>Username or Email already in use</h3>";}

	} else { // Passwords not same
        echo "<h3>Please make sure Password and Confirm password are exact same.</h3>";
    }

}
else { // Not all data filled
    echo "<h3>Please fill all requred fields.</h3>";
}
?>
