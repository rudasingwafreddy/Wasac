<?php

include ('includes/configuration.php');
$delete = $_GET['e_id'];

$sql ="DELETE FROM `sub-details` WHERE e_id='$delete' "; 
 if (mysqli_query($conn, $sql)){
    $sql1 = "DELETE FROM `expense`  WHERE e_id ='$delete' ";
        if (mysqli_query($conn, $sql1)) 
            header("location:manage-expense.php");
        
 }else{
     echo " Failed";
 }


?>