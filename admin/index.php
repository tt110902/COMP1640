<?php
    //Connection
    $host = "localhost";
    $username="root";
    $password="";
    $db= "btwev";
    $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());

    $urladmin ="http://localhost/1640/admin/";
    $urluser = "http://localhost/1640/";
    $roles = "role.php";
    $acadamicYear="AcademicYear.php";
    $roleEdit = "role_edit.php";
    
    $urllogin = "http://localhost/1640/login";
    include('./theme.php');

?>
