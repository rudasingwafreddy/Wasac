<?php

        $conn = mysqli_connect("localhost","root","","festimo");

        // count users
        $getusers = mysqli_query($conn,"select * from users");
        $usersnumber=mysqli_num_rows($getusers);

        // count category
        $getcategory = mysqli_query($conn,"select * from category");
        $categoryno=mysqli_num_rows($getcategory);


        
        
?>