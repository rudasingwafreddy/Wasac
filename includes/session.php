<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configuration.php');
$user = $_SESSION["username"];
$role = mysqli_query($conn, "SELECT * FROM users where `username` = '$user'");
$rolecheck = mysqli_fetch_assoc($role);
      

?>