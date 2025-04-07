<?php
session_start();
error_reporting(1);
include('includes/config.php');
include('includes/configuration.php');
if(isset($_POST['login']))
{

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password=md5($_POST['password']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' and password='$password'");
$result = mysqli_num_rows($sql);
if($result > 0  ){

    while ($rows = mysqli_fetch_assoc($sql)) {
        if ($rows['user_role'] == "Administrator") {
            $_SESSION['username']=$username;
             echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        }else {
            $_SESSION['username']=$username;
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        }
    }

    
}else{
    echo "<script>alert('Invalid Details');</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>wasac Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="">
        <div class="main-wrapper">
<style>
    section{
        margin-left:30%;
        width:40%;
       
    }

</style>
            
                <div class="row">

                    <div class="col-lg-12">
                        <section class="section">
                            <div class="row mt-40">
                                <div class="col-md-10 col-md-offset-1 pt-50">

                                    <div class="row mt-30 ">
                                        <div class="col-md-12">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title text-center">
                                                        <h4>WASAC's Login </h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">

                                                  
                                                    <form class="form-horizontal" method="post">
                                                    	<div class="form-group">
                                                    		<label for="inputEmail3" class="col-sm-3 control-label">Username </label>
                                                    		<div class="col-sm-12">
                                                    			<input type="text" name="username" class="form-control" id="inputEmail3" placeholder="UserName">
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group">
                                                    		<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                                    		<div class="col-sm-12">
                                                    			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                                                    		</div>
                                                    	</div>

                                                        <div class="form-group mt-20">
                                                    		<div class="col-sm-8">

                                                    			<button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    		</div>
                                                    	</div>
                                                    </form>




                                                </div>
                                            </div>
                                            <!-- /.panel -->
                                            <p class="text-muted text-center"><small>Copyright © 2025 wasac
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
