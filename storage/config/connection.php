<?php

$host = "localhost";

//db user
$user = "root";
//db user password
$password = "";

$db = "storage_dbs";

date_default_timezone_set('Asia/Karachi');

$con = new PDO("mysql:dbname=$db;port=3306;host=$host", $user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
//$_SESSION

?>