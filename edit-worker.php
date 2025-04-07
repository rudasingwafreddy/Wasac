<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{ 
if(isset($_POST['submit']))
{
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $telephone=$_POST['telephone'];
$cid=intval($_GET['classid']);
$sql="update  workers set first_name=:first_name,last_name=:last_name,gender=:gender,address=:address,telephone=:telephone where id=:cid ";
$query = $dbh->prepare($sql);
$query->bindParam(':first_name',$first_name,PDO::PARAM_STR);
$query->bindParam(':last_name',$last_name,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':telephone',$telephone,PDO::PARAM_STR);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$msg="Data has been updated successfully";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Update Workers</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php 
                         if( $rolecheck['user_role'] == 'Administrator') { 
                             include('includes/leftbar.php');
                              } else {include('includes/userleftbar.php');}
                              ?>                  
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Update workers</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="manage-tech.php">workers</a></li>
            							<li class="active">Update workers</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                            <style>
                                 .panel{
                                     padding:1rem 3rem;
                                 }
                             </style>

                              

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Update workers info</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>

                                                <form method="post">
<?php 
$cid=intval($_GET['classid']);
$sql = "SELECT * from workers where id=:cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>

<div class="form-group has-success">
                                                        <label for="success" class="control-label">first name</label>
                                                		<div class="">
                                                			<input type="text" name="first_name" value="<?php echo htmlentities($result->first_name);?>" required="required" class="form-control" id="success">
                                                            <span class="help-block">Eg-Eloi, etc</span>
                                                		</div>
                                                	</div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">last name</label>
                                                		<div class="">
                                                			<input type="text" name="last_name" value="<?php echo htmlentities($result->last_name);?>" required="required" class="form-control" id="success">
                                                            <span class="help-block">Eg-Gakwaya, etc</span>
                                                		</div>
                                                	</div>
                                                    
                                                    <div class="form-group">
                                                    <label for="success" class="control-label">Gender</label>
                                                    <div class="">
                                                    <input type="radio" name="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Address</label>
                                                		<div class="">
                                                			<input type="text" name="address" value="<?php echo htmlentities($result->address);?>" required="required" class="form-control" id="success">
                                                            <span class="help-block">Eg-Kimironko, etc</span>
                                                		</div>
                                                	</div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Telephone</label>
                                                		<div class="">
                                                			<input type="text" name="telephone" value="<?php echo htmlentities($result->telephone);?>" required="required" class="form-control" id="success">
                                                            <span class="help-block">Eg-078......., etc</span>
                                                		</div>
                                                	</div>
                                                    <?php }} ?>
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled">Update<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    </div>


                                                    
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->

                               
                               

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

             
                    <!-- /.right-sidebar -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

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
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php }
else{
header("Location: index.php"); 
    }
 ?>
