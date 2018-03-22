<?php
/* Database connection settings */
$host = 'db4free.net:3307';
$user = 'tifuphmedic2015';
$pass = 'informatics2015'; //mypass123 - admin123
$db = 'accounts'; //accounts
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
if($link == false){
    //try to reconnect
    //header('Location: ./sql/sql_import.php');
}