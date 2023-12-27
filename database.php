<?php

$host = "localhost";
$dbname = "signup_login_php";
$username = "root";
$password = "";

$mysqli = new mysqli($host,$username,$password,$dbname);
if($mysqli->connect_errno){
    die("connection error : ".$mysqli->connect_errno);
}
return $mysqli;
?>