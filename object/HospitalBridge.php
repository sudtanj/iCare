<?php
require '../db.php';
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
use Arrayzy\ArrayImitator as A;

/* Displays user information and some useful messages */
session_start();

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
    echo $email;
}


$findUserId=$_POST["OpenMRSId"];

$visitlog=A::create([]);
$useridlog=A::create([]);
$auth = base64_encode("admin:Admin123");
$context = stream_context_create(['http' => ['header' => "Authorization: Basic $auth"]]);
$homepage = file_get_contents('http://demo.openmrs.org/openmrs/ws/rest/v1/visit', false, $context);
//echo $homepage;
//$json=json_decode($homepage,true);
preg_match_all('/"uri":"http?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)"/i',$homepage,$data);
//print_r($data);
foreach($data[0] as $value){
    $visit= preg_split('/"/',$value)[3];
    $visit=str_replace('http://demo.openmrs.org/openmrshttp://','http://',$visit);
    $homepage1 = file_get_contents($visit, false, $context);
    preg_match_all('/"patient":{"uuid":".+?(?=")/i',$homepage1,$data1);
    preg_match_all('/"display":".+?(?=")/i',$homepage1,$resultDisplay);
    //echo $homepage1;
    //print_r(resultDisplay);
    //echo "<br />";
    //foreach($resultDisplay[0] as $valueResult){
        $result1 = preg_split('/"/',$resultDisplay[0][0])[3];
        $visitlog->add($result1);
        //echo "==========","<br />";
//    }
   //foreach($data1[0] as $value1){
       $result = preg_split('/"/',$data1[0][0])[5];
       $useridlog->add($result);
      // if(strpos($result,"patient")==true){
            //$useridlog->add(preg_split('/"/',$value1)[3]);
            //echo preg_split('/"/',$value1)[3],"<br />";
      // }
   //}
    
}
//echo $findUserId,"<br />";
echo "List of imported log: ", "<br />";
for($i=0;$i<sizeof($useridlog);$i++){
    //echo $useridlog[$i],"<br />";
    //echo strpos($useridlog[$i],$findUserId),"<br />";
    if(strpos($useridlog[$i],$findUserId)!== false){
        echo $visitlog[$i], " <br />";
       $mysql = "INSERT INTO healthdata (emailkey,log) VALUES ('";
        $mysql .= $email;
        $mysql .= "','";
        $mysql .=$visitlog[$i];
        $mysql .="')";
        $mysqli->query($mysql) or die(mysql_error());
    }
}

echo "Imported successfully! redirecting you to profile pages";
echo '<meta http-equiv="refresh" content="5;url=../profile.php" />';
//echo $data;
//echo array_search("http://demo.openmrs.org/openmrs/ws/rest/v1/visit/",$json);
