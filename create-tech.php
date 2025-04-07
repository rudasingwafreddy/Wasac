<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{
    
if(isset($_POST['submit']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $customer_account = $_POST['customer_account'];
    $meter_number = $_POST['meter_number'];

    // Set default password "wasac"
    $default_password = "wasac";

    // Insert into database
    $sql = "INSERT INTO workers (first_name, last_name, role, gender, address, telephone, customer_account, meter_number, password) 
            VALUES (:first_name, :last_name, :role, :gender, :address, :telephone, :customer_account, :meter_number, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
    $query->bindParam(':meter_number', $meter_number, PDO::PARAM_STR);
    $query->bindParam(':password', $default_password, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg = "Customer Created successfully with default password 'wasac'";
    }
    else 
    {
        $error = "Something went wrong. Please try again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Category</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
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
                                    <h2 class="title">+ Customers</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="manage-tech.php">Customers</a></li>
            							<li class="active">+ Customers</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                              

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Add Customers</h5>
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
  
                                            <div class="panel-body">


                                            <style>
                                       /*  .control-label{
                                            font-weight:300;
                                            
                                        } */
                                        .form-group{
                                          
                                        
                                            margin:;
                                        }
                                        .form-group input,
                                        .form-group select{
                                            line-height:1rem;
                                            font-size:.89rem;
                                            padding:0 1rem;
                                        }
                                    </style>
                                                <form method="post">
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">First Name</label>
                                                		<div class="">
                                                			<input type="text" name="first_name" class="form-control" required="required" id="success">
                                                            <span class="help-block">Eg: Emile</span>
                                                		</div>
                                                	</div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Last Name</label>
                                                		<div class="">
                                                			<input type="text" name="last_name" class="form-control" required="required" id="success">
                                                            <span class="help-block">Eg: Gakwaya</span>
                                                		</div>
                                                	</div>
                                                     
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Category Name</label>
                                                        <div class=""><select name="role" class="form-control" required="required" id="success"><option>choose</option>
                                                            <option>Household</option>
                                                            <option>Commercial</option><option>Industrial</option>
                                                            <option>Agricultural</option><option>Institutional</option></select>
                                            
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
                                                			<input type="text" name="address" class="form-control" required="required" id="success">
                                                            <span class="help-block">Eg: Kimironko</span>
                                                		</div>
                                                	</div>

                                                    <div class="form-group has-success">
                                                    <label for="success" class="control-label">Phone Number</label>
                                                    <div class="">
                                                    <input type="text" name="telephone" class="form-control" id="success" maxlength="15" required="required" autocomplete="off">
                                                    </div>
                                                    </div>

 <div class="form-group">
                                                    <label style="color: #008000;">Customer Account Number</label>
                                                    <div class="input-group">
                                                        <input type="text" name="customer_account" id="customer_account" class="form-control" readonly required>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info" onclick="generateNumbers()">Generate</button>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label style="color: #008000;">Meter Number</label>
                                                    <div class="input-group">
                                                        <input type="text" name="meter_number" id="meter_number" class="form-control" readonly required>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info" onclick="generateNumbers()">Generate</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                        <div class="">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
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

<script>
        function generateNumbers() {
            let year = new Date().getFullYear();
            let randomCustomerID = Math.floor(10000 + Math.random() * 90000); // 5-digit random number
            let randomMeterID = Math.floor(100000 + Math.random() * 900000); // 6-digit random number

            document.getElementById('customer_account').value = "WB-" + year + "-" + randomCustomerID;
            document.getElementById('meter_number').value = "MTR-" + randomMeterID;
        }
    </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php }
else{
header("Location: index.php"); 
    }
 ?>
