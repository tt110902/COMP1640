<?php
$urladmin = "http://localhost/1640/qa/";
$urluser = "http://localhost/1640/";
$logout = "http://localhost/1640/login/logout.php";
$urllogin = "http://localhost/1640/login";
//Connection
$host = "localhost";
$username = "root";
$password = "";
$db = "btwev";
$conn = mysqli_connect($host, $username, $password, $db) or die("Can not connect database " . mysqli_connect_error());

include('./theme.php');