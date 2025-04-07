<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{ 


        if (isset($_POST['getlunch'])) {
            
            extract($_POST);
            $check= mysqli_query($conn,"SELECT e_worker,e_date FROM lunch WHERE e_worker= '$e_worker' and e_date ='$e_date'");
            $count=mysqli_num_rows($check);

            if($count == 1){
                $error = " Already Assigned to pay the bill for the usege water !!";
            }
            else{
                $sql = "INSERT INTO `lunch` (`e_worker`,`meter_used`, `amaount`,`e_date`) VALUES ('$e_worker', '$meter_used','$amount', '$e_date')";
                   if(mysqli_query($conn,$sql)){
                       $msg= " Operation Successful Done .";
                    } 
                    else{
                        $error=  "Not added ???????";
                    }
                }
            }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Generate Bills</title>
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
                                    <h2 class="title">Generate Bill</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="manage-lunch.php"> Generate Bill</a></li>
                                
                                        <li class="active">Generate Bill</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel" >
                                            
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


.all{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    
    
}
.right{
   
    width:25rem;
    height:fit-content;
   
}
.left{
   width:35rem;
   text-align:left;
   justify-content:center;
   border-right:.1rem solid #666;
}
.left a{
    padding:1rem;
    line-height:.27rem;
    width:30rem;
   
    
}
.left a.active,
.left a:hover{
    color:white;
    border-radius:.2rem;
    background:#55acee;
}
    </style>

 <div class="all col-sm-12">
        <div class="left">

        <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h6>assign meters to the customer by Clicking on the customer name and fill the Information accordingly</h6>
                                                </div>
                                            </div>
                                            <hr>

                                            <h6 style="font-weight:bold">List of customer for wasac Group</h6>
        <?php 

$sql = "SELECT * from workers ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=0;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>


<a class="col-sm-3 control-label" id="worker" onclick="" title="Click to give a lunch" href="lunchexpense.php?getname=<?php echo htmlentities($result->id);?>"><?php echo $cnt= $cnt + 1; ?>. <?php echo htmlentities($result->first_name);?>  <?php echo htmlentities($result->last_name);?></a><br>
                 <script>
                     /* let workname = document.getElementById('worker');
                      workname.addEventListener('click', (e) =>{
                        e.preventDefault(); 
                    }); */

                    
                 </script>
                
                <?php }} ?>

        </div>
        
        <div class="right col-sm-7" id="details">
        <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the bill info</h5>
                                                </div>
                                            </div>
            <form class="form-horizontal" method="post">

                <?php
                
                    
                        $getname = $_GET['getname'];
                        $sql = mysqli_query($conn, "SELECT * FROM workers where id ='$getname' ");
                        while($row = mysqli_fetch_assoc($sql)){

                          
                        
                ?>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <label for="success" class="col-sm-3 control-label">Customer: </label><br>
                <input type="text" name="e_worker" value="<?php echo $row['first_name'];?>  <?php echo $row['last_name']; ?>" class="form-control" id="success" readonly>
  
            </div>
            </div>
            <?php } ?>
            <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <label >Meter Used:</label><br>
        <input type="number" name="meter_used" id="meter_used" class="form-control" required="required" placeholder="Enter meter used..." autocomplete="off">
    </div>  
</div>
          <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <label >Amount to be Paid (RWF):</label><br>
        <input type="text" name="amount" id="amount" class="form-control" readonly>
    </div>  
</div>
<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <label for="success" class="col-sm-3 control-label">Date:</label><br>
                <input type="date" name="e_date"  required="required" class="form-control" id="success" placeholder="Enter the amount ..."  autocomplete="off">
            </div>  
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  name="getlunch" class="btn btn-success btn-labeled">Generate<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
        
            </div>
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
              
    document.getElementById("meter_used").addEventListener("input", function() {
        let meterUsed = parseFloat(this.value);
        let ratePerUnit = 10; // Adjust the rate as needed
        let totalAmount = meterUsed * ratePerUnit;
        document.getElementById("amount").value = totalAmount + " RWF";
    });

        </script>
    </body>
</html>
<?php }
else{
header("Location: index.php"); 
    }
 ?>
