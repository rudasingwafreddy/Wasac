<?php

include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{
     
if(isset($_POST['submit']))
{
$category=$_POST['category'];
$customer_account=$_POST['customer_account'];
$meter_number=$_POST['meter_number'];
$meter_reading=$_POST['meter_reading'];
$new_money=$_POST['new_money'];
$divided_amount=$_POST['divided_amount'];
$payment_period=$_POST['payment_period'];
$prepaid=$_POST['prepaid'];
$m_date=$_POST['m_date'];

$sql="INSERT INTO  money(category,customer_account,meter_number,meter_reading,new_money,divided_amount,payment_period,prepaid,m_date) VALUES(:category,:customer_account,:meter_number,:meter_reading,:new_money,:divided_amount,:payment_period,:prepaid,:m_date)";
$query = $dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':customer_account',$customer_account,PDO::PARAM_STR);
$query->bindParam(':meter_number',$meter_number,PDO::PARAM_STR);
$query->bindParam(':meter_reading',$meter_reading,PDO::PARAM_STR);
$query->bindParam(':new_money',$new_money,PDO::PARAM_STR);
$query->bindParam(':divided_amount',$divided_amount,PDO::PARAM_STR);
$query->bindParam(':payment_period',$payment_period,PDO::PARAM_STR);
$query->bindParam(':prepaid',$prepaid,PDO::PARAM_STR);
$query->bindParam(':m_date',$m_date,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Customer Prepaid Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
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
        <script>
            function togglePrepaid() {
            var category = document.getElementById('category').value;
            var prepaidField = document.getElementById('payment_period');
            if (category === 'Household') {
                prepaidField.value = 'No';
                prepaidField.disabled = true;
            } else {
                prepaidField.disabled = false;
            }
        }
    function calculateAmount() {
    var meterReading = document.getElementById('meter_reading').value;
    var paymentPeriod = document.getElementById('payment_period').value;
    var newMoneyField = document.getElementById('new_money');
    var dividedAmountField = document.getElementById('divided_amount');
    var prepaidField = document.getElementById('prepaid');

    if (meterReading && !isNaN(meterReading)) {
        var amount = parseFloat(meterReading) * 10; // Example calculation
        newMoneyField.value = amount.toFixed(2);

        var dividedAmount = amount; // Default full amount

        if (paymentPeriod === 'Quarterly') {
            dividedAmount = amount / 4;
            prepaidField.value = 'Quarterly';
        } else if (paymentPeriod === 'Annual') {
            dividedAmount = amount / 12;
            prepaidField.value = 'Annual';
        } else if (paymentPeriod === 'Monthly') {
            dividedAmount = amount; // Keep full amount
            prepaidField.value = 'Monthly';
        }

        dividedAmountField.value = dividedAmount.toFixed(2);
    } else {
        dividedAmountField.value = '';
        newMoneyField.value = '';
    }
}
    </script>
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
                                    <h2 class="title">Create Prepaid</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="manage-input.php">prepaid</a></li>
            							<li class="active">Create Prepaid</li>
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
                                                    <h5>Create Prepaid</h5>
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

                                                <form method="post"><div  class="form-group has-success">
                                        <label for="success" class="control-label">Category</label>
                                        <select name="category" id="category" class="form-control" required onchange="togglePrepaid()">
                                            <option value="choose">choose</option>
                                            <option value="Household">Household</option>
                                            <option value="Agriculture">Agriculture</option>
                                            <option value="Institution">Institution</option>
                                            <option value="Industrial">Industrial</option>
                                            <option value="Utility">Utility</option>
                            
                                        </select>
                                    </div><div class="form-group has-success">
                                        <label for="success" class="control-label">Customer Account Number</label>
                                        <input type="text" name="customer_account" class="form-control" required>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="success" class="control-label">Meter Number</label>
                                        <input type="text" name="meter_number" class="form-control" required>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="success" class="control-label">Meter Reading</label>
                                        <input type="number" name="meter_reading" id="meter_reading" class="form-control" required oninput="calculateAmount()">
                                    </div>
                                                    <div class="form-group has-success">
                                        <label for="success" class="control-label">Amount</label>
                                        <input type="number" name="new_money" id="new_money" class="form-control" required readonly>
                                    </div>
                                                	<div class="form-group has-success">
                                        <label>Amount to be pay</label>
                                        <input type="number" name="divided_amount" id="divided_amount" class="form-control" required readonly>
                                    </div><div class="form-group has-success">
                                        <label for="success" class="control-label">Payment Period</label>
                                        <select name="payment_period" id="payment_period" class="form-control" required onchange="calculateAmount()">
                                            <option value="Monthly">Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Annual">Annual</option>
                                        </select>
                                    </div><div class="form-group has-success">
                                        <label for="success" class="control-label">Prepaid</label>
                                        <select name="prepaid" id="prepaid" class="form-control" required>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Annual">Annual</option>
                                        </select>
                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Date Created</label>
                                                		<div class="">
                                                        <input type="date"  name="m_date" class="form-control" id="date">   
                                                        
                                                         <span class="help-block">Eg:8-25-2021</span>
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



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php }
else{
header("Location: index.php"); 
    }
 ?>
