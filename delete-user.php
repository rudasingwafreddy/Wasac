<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['username'])
    {  
    

$id=intval($_GET['id']);
$sql="DELETE from  users  where id=:id ";
$query = $dbh->prepare($sql);

$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
header("Location: manage-user.php"); 
}
    else{ 
        header("Location: index.php"); 
    }
?>