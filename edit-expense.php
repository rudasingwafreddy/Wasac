<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{
if (isset($_POST['updateex'])) {
    $e_id = $_GET['e_id'];
    # code...
    extract($_POST);
    $sql=mysqli_query($conn,"UPDATE expense SET `e_title`='$e_title',`e_category`='$e_category',`e_worker`='$e_worker',`e_date`='$e_date' where `e_id`='$e_id'");
    $sql1=mysqli_query($conn,"UPDATE `sub-details` SET `e_detail`='$e_detail',`e_amount`='$e_amount',`e_detail2`='$e_detail2',`e_amount2`='$e_amount2',`e_detail3`='$e_detail3',`e_amount3`='$e_amount3',`e_detail4`='$e_detail4',`e_amount4`='$e_amount4',`e_detail5`='$e_detail5',`e_amount5`='$e_amount5'  where `e_id`='$e_id'");
    if($sql && $sql1){
                        
        $msg = "Updated successful !";
     }else{
        $error = "Failed to Update !";
       }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Update Expense</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
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
                                    <h2 class="title">Update expense</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="manage-expense.php">Expenses</a></li>
                                        <li class="active">Update expense</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel" >
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the expense info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        
                                        <?php } ?>


                                        <style>
                                        .control-label{
                                            font-weight:300;
                                            
                                        }
                                        .form-group{
                                        
                                            margin:.2rem;
                                        }
                                        .form-group input,
                                        .form-group select{
                                            line-height:1rem;
                                            font-size:.89rem;
                                            padding:0 1rem;
                                        }
                                    </style>

                                                <form class="form-horizontal" method="post">
                                           
                                                <?php

$e_id=$_GET['e_id'];
$sql = "SELECT * from `expense`,`sub-details` where `sub-details`.e_id = '$e_id'  and `expense`.e_id = '$e_id' ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    ?>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense title</label>
<div class="col-sm-10">
<input type="text"  value="<?php echo htmlentities($result->e_title);?>"   name="e_title" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense detail 1</label>
<div class="col-sm-4">
<input type="text"  value="<?php echo htmlentities($result->e_detail);?>"  name="e_detail" class="form-control" id="rollid"   autocomplete="off">
</div>

<!-- amount  -->
<label for="default" class="col-sm-2 control-label">Expense Amount 1</label>
<div class="col-sm-4">
<input type="text"  value="<?php echo htmlentities($result->e_amount);?>"  name="e_amount" class="form-control" id="rollid"   autocomplete="off">
</div>

</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense detail 2</label>
<div class="col-sm-4">
<input type="text"  value="<?php echo htmlentities($result->e_detail2);?>"  name="e_detail2" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Expense Amount 2</label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->e_amount2);?>"  name="e_amount2" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense detail 3</label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->e_detail3);?>" name="e_detail3" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Expense Amount 3</label>
<div class="col-sm-4">
<input type="text"  value="<?php echo htmlentities($result->e_amount3);?>" name="e_amount3" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense detail 4</label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->e_detail4);?>" name="e_detail4" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Expense Amount 4</label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->e_amount4);?>"  name="e_amount4" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Expense detail 5</label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->e_detail5);?>" name="e_detail5" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Expense Amount 5</label>
<div class="col-sm-4">
<input type="text " value="<?php echo htmlentities($result->e_amount5);?>" name="e_amount5" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>
        

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Category</label>
                                                        <div class="col-sm-10">
 <select name="e_category" class="form-control" id="default" required="required">
<option ><?php echo htmlentities($result->e_category); ?></option>
<?php
 $sql = "SELECT * from category ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $resultd)
{   ?>
<option><?php echo htmlentities($resultd->category_name); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>

 
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Technician</label>
                                                        <div class="col-sm-10">
 <select name="e_worker" class="form-control" id="default" required="required">
 <option ><?php echo htmlentities($result->e_worker); ?></option>
<?php $sql = "SELECT * from workers";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $resultf)
{   ?>
<option> <?php echo htmlentities($resultf->first_name); ?>&nbsp;<?php echo htmlentities($resultf->last_name); ?></option>
<?php }}?>
 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
                                                        <label for="e_date" class="col-sm-2 control-label">Date</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" value="<?php echo htmlentities($result->e_date); ?>"  name="e_date" class="form-control" id="date">
                                                        </div>
                                                    </div>
                                                    

                                                    <?php }} ?>   
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="updateex" class="btn btn-primary">Update Expense</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>

<?php }
else{
header("Location: index.php"); 
    }
 ?>

