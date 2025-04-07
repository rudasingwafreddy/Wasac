<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['username'])
    {   
       

$m_id=intval($_GET['m_id']);
$sql="delete from  money  where m_id=:m_id ";
$query = $dbh->prepare($sql);

$query->bindParam(':m_id',$m_id,PDO::PARAM_STR);
$query->execute();
header("Location: manage-input.php"); 
}else{
     header("Location: index.php"); 
    }
    
?>