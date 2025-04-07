<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['username'])
    {  
    

$cid=intval($_GET['classid']);
$sql="delete from  category  where id=:cid ";
$query = $dbh->prepare($sql);

$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
header("Location: manage-category.php"); 
}
    else{ 
        header("Location: index.php"); 
    }
?>