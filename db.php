<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = ''; //mypass123 - admin123
$db = 'accounts'; //accounts
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
