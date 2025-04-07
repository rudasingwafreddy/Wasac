<?php
session_start();
error_reporting(1);
include('includes/config.php');
if($_SESSION['username'])
    {   
       

$id=intval($_GET['id']);
$sql="DELETE FROM  lunch WHERE id=:id ";
$query = $dbh->prepare($sql);

$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
header("Location: manage-lunch.php"); 
}else{
     header("Location: index.php"); 
    }
    
?>