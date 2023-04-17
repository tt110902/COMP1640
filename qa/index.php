<?php
$urladmin = "http://localhost/1640/qa/";
$urluser = "http://localhost/1640/";
$urllogin = "http://localhost/1640/login";
$categories = "category.php";
$categoryEdit = "category_edit.php";
$POST = "COMMENT/?page=post.php";
$categoryAdd = "category_add.php";
$categoryDelete = "category_delete.php";
$post = "post.php";
$postAdd = "post_add.php";
$chart = "chart.php";
$postEdit = "post_edit.php";
$postDelete = "post_delete.php";
$statistic = "statistic.php";
$download = "download.php";
$logout = "http://localhost/1640/login/logout.php";


//Connection
$host = "localhost";
$host = "localhost";
$username = "root";
$password = "";
$db = "btwev";
$conn = mysqli_connect($host, $username, $password, $db) or die("Can not connect database " . mysqli_connect_error());

include('./theme.php');


?>