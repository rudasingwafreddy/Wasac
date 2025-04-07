<?php


include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{
    


        if (isset($_POST['submit'])) {
            
            extract($_POST);
          /*  $sql = "INSERT INTO `expense` (`e_title`,`e_category`,`e_worker`,`e_date`) VALUES ( )";
            */
           $sql = "INSERT INTO `expense` (`e_title`, `e_category`, `e_worker`, `e_date`) VALUES ('$e_title','$e_category','$e_worker','$e_date')";
           $s=mysqli_query($conn,"select * from expense");
           while($i=mysqli_fetch_assoc($s)){
               $id=$i['e_id']+1;
           } 
           
           if ( mysqli_query($conn,$sql)) {
              
               
            $sql1="INSERT INTO `sub-details` (`id`, `e_id`, `e_detail`, `e_amount`, `e_detail2`, `e_detail3`, `e_detail4`, `e_detail5`, `e_amount2`, `e_amount3`, `e_amount4`, `e_amount5`) VALUES (NULL, (SELECT e_id from expense where e_id = '$id'), '$e_detail','$e_amount','$e_detail2','$e_detail3','$e_detail4','$e_detail5','$e_amount2','$e_amount3','$e_amount4','$e_amount5')";
           
                /* $sql1 = "INSERT INTO `sub-details` (`e_id`,`e_detail`, `e_amount`,`e_detail2`,`e_detail3`,`e_detail4`,`e_detail5`, `e_amount2`, `e_amount3`, `e_amount4`, `e_amount5`) VALUES ((SELECT e_id from expense where e_id = '$id'), '$e_detail','$e_amount','$e_detail2','$e_detail3','$e_detail4','$e_detail5','$e_amount2','$e_amount3','$e_amount4','$e_amount5')";
                   */ if(mysqli_query($conn,$sql1)){
                        
                       $msg = "Added Successful";
                    }else{
                       $error = "Failed to add Expense";
                      }
                    } 
                    else{
                        $error=  "Not added bro";
                    }
           
                }
/* if(isset($_POST['submit']))
{
$e_title=$_POST['e_title'];
$e_detail=$_POST['e_detail']; 
$e_amount=$_POST['e_amount']; 
$e_detail2=$_POST['e_detail2']; 
$e_detail3=$_POST['e_detail3']; 
$e_detail4=$_POST['e_detail4']; 
$e_detail5=$_POST['e_detail5']; 
$e_amount2=$_POST['e_amount2']; 
$e_amount3=$_POST['e_amount3']; 
$e_amount4=$_POST['e_amount4']; 
$e_amount5=$_POST['e_amount5']; 
$e_amount5=$_POST['e_amount5']; 
$e_category=$_POST['e_category']; 
$e_worker=$_POST['e_worker']; 
$e_date=$_POST['e_date']; 

$sql="INSERT INTO  expense(e_title,e_category,e_worker,e_date) VALUES(:e_title,:e_category,:e_worker,:e_date)";
$query = $dbh->prepare($sql);
$query->bindParam(':e_title',$e_title,PDO::PARAM_STR);
$query->bindParam(':e_category',$e_category,PDO::PARAM_STR);
$query->bindParam(':e_worker',$e_worker,PDO::PARAM_STR);
$query->bindParam(':e_date',$e_date,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Student info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
} */


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Postpaid</title>
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
                                    <h2 class="title">Create Postpaid</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="manage-expense.php"> prepaid</a></li>
                                        <li class="active">create prepaid</li>
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
                                                    <h5>Fill the bills info</h5>
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

<div class="form-group">
<label for="default" class="col-sm-2 control-label">bills title</label>
<div class="col-sm-10">
<input type="text" name="e_title" class="form-control" id="fullanme" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Quartly 1</label>
<div class="col-sm-4">
<input type="text" name="e_detail" class="form-control" id="rollid"   autocomplete="off">
</div>

<!-- amount  -->
<label for="default" class="col-sm-2 control-label">Amount 1</label>
<div class="col-sm-4">
<input type="text" name="e_amount" class="form-control" id="rollid"   autocomplete="off">
</div>

</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Quartly 2</label>
<div class="col-sm-4">
<input type="text" name="e_detail2" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Amount 2</label>
<div class="col-sm-4">
<input type="text" name="e_amount2" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Quartly 3</label>
<div class="col-sm-4">
<input type="text" name="e_detail3" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Amount 3</label>
<div class="col-sm-4">
<input type="text" name="e_amount3" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Quartly 4</label>
<div class="col-sm-4">
<input type="text" name="e_detail4" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Amount 4</label>
<div class="col-sm-4">
<input type="text" name="e_amount4" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Quartly 5</label>
<div class="col-sm-4">
<input type="text" name="e_detail5" class="form-control" id="rollid"   autocomplete="off">
</div>
<label for="default" class="col-sm-2 control-label">Amount 5</label>
<div class="col-sm-4">
<input type="text" name="e_amount5" class="form-control" id="rollid"   autocomplete="off">
</div>
</div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Category</label>
                                                        <div class="col-sm-10">
 <select name="e_category" class="form-control" id="default" required="required">
<option value="">Select Category</option>
<?php $sql = "SELECT * from category";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->category_name); ?>"><?php echo htmlentities($result->category_name); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Customer</label>
                                                        <div class="col-sm-10">
 <select name="e_worker" class="form-control" id="default" required="required">
<option value="">Select Customer</option>
<?php $sql = "SELECT * from workers";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option> <?php echo htmlentities($result->customer_account); ?>&nbsp;<?php echo htmlentities($result->meter_number); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
                                                        <label for="e_date" class="col-sm-2 control-label">Date Done</label>
                                                        <div class="col-sm-10">
                                                            <input type="date"  name="e_date" class="form-control" id="date">
                                                        </div>
                                                    </div>
                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Generate Invoice</button>
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
