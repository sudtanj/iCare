<?php
/* Displays user information and some useful messages */
require './db.php';
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');



session_start();
require(dirname(__FILE__) . '/object/Form.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
$target_dir = 'upload/';
$target_file = $target_dir . basename($_FILES["filepath"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

move_uploaded_file($_FILES["filepath"]["tmp_name"], $target_file);

//echo $target_file;
$Reader = new SpreadsheetReader($target_file);
$Sheets = $Reader -> Sheets();

//	foreach ($Sheets as $Index => $Name)
//	{
	//	echo 'Sheet #'.$Index.': '.$Name;

	//	$Reader -> ChangeSheet($Index);
$Reader -> ChangeSheet(1);
$counter=0;
		foreach ($Reader as $Row)
		{
		    if($counter>1){
			    print_r($Row[1]);
			    echo "<br />";
			    $mysql = "INSERT INTO healthdata (emailkey,log) VALUES ('";
                $mysql .= $email;
                $mysql .= "','";
                $mysql .=$Row[1];
                $mysql .="')";
			    $mysqli->query($mysql) or die(mysql_error());
		    }
		    $counter++;
		}
//	}
echo "Imported successfully! redirecting you to profile pages";
echo '<meta http-equiv="refresh" content="5;url=../profile.php" />';
?>