<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../appStyle/confirmation.css" />
    </head>

<body>
<?php
    include_once('../dbCon.php');

    if(!empty($_POST['foodName']) && !empty($_POST['foodPrice']) && !empty($_POST['foodType']))
    {
    	$foodName = stripslashes($_POST['foodName']); // strip slashes
    	$foodPrice = stripslashes($_POST['foodPrice']);
        $foodType = stripslashes($_POST['foodType']);
        $foodImage = $_FILES['foodImage'];
        $imageName = stripslashes($foodImage['name']);
    	$foodName = mysql_real_escape_string($foodName);  // make it unable to execute code
    	$foodPrice = mysql_real_escape_string($foodPrice);
        $foodType = mysql_real_escape_string($foodType);
        $imageName = mysql_real_escape_string($imageName);
        // Check if product name exists
        $sql="SELECT * FROM $tbl_food WHERE name='$foodName'";
        $result=mysql_query($sql);
        // Mysql_num_row is counting table row to check for name
        $count=mysql_num_rows($result);
        // if same name doesnt exists
        if ($count==0){
            if(empty($imageName)){ 
                $foodImage = array('name'=>'noImg.png', 'type'=>'image/png'); 
                $imageName="noImg.png";
                // Only instert data because image doesnt exist
                $sql1="INSERT INTO $tbl_food( name, price, type, image)VALUES('$foodName', '$foodPrice', '$foodType', '$imageName')";
                $result1=mysql_query($sql1);
                if ($result1){ echo "<h1>The product has been successfully added</h1>";}
            } else {
                if (is_valid_type($foodImage)){
                    // Path to store the image
                    $TARGET_PATH = "../appStyle/img/".$imageName;
                    // if moving the image was successfull
                    if (move_uploaded_file($foodImage['tmp_name'], $TARGET_PATH)){
                    // INSERT DATA INTO DATABASE
                            $sql1="INSERT INTO $tbl_food( name, price, type, image)VALUES('$foodName', '$foodPrice', '$foodType', '$imageName')";
                    $result1=mysql_query($sql1);
                        // If everything is good print success
                        if($result1){ echo "<h1>The product has been successfully added</h1>";}
                        // else print fail
                        else{ echo "<h3>Adding product failed, please try again</h3>";}
                    } else { echo "<h3>Sorry, the image can not be moved</h3>";}
                    
                } else { // Wrong format
                   echo "<h3>Please upload a proper format. PNG only allowed.";
                }
            }
        } else { // food name exists
        echo "<h3>A product with the same name already exists</h3>";
        }
    }
    else { // Not all data filled
        echo "<h3>Please fill all requred fields.</h3>";
    }

    function is_valid_type($file)
    {
        // This is an array that holds all the valid image MIME types
        $valid_types = array("image/png"); /*,"image/jpg", "image/jpeg", "image/bmp", "image/gif"*/

        if (in_array($file['type'], $valid_types)){
            return 1;
        } else {
            return 0;
        }
    }
?>
</body>
</html>
