<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if($_SESSION["username"])
{
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Expense</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
                <?php 
                         if( $rolecheck['user_role'] == 'Administrator') { 
                             include('includes/leftbar.php');
                              } else {include('includes/userleftbar.php');}
                              ?>         

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Manage Expense</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="create-expense.php"> Add Expense </a></li>
            							<li class="active">Manage Expense</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>View Expense Info</h5>
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
                                            <div class="panel-body p-20">
                                            <form  action="" method="POST" style="margin-left:70%">
                                            <input style="padding:.2rem 1rem; line-height:1.5rem; font-size:.83rem" type="text" placeholder="Search.." name="search" required> 
                                            <button  style="position:absolute; margin-left:13rem; margin-top:-2.6rem; line-height:1.5rem; padding:.33rem 1rem; border:none;" class="btn-primary" type="submit" name="searchExpense"><i class="fa fa-search"></i></button>
                                            </form>

                                            <table id="example" class="display  table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="font-size:.82rem;">#</th>
                                                            <th style="font-size:.82rem;">Expense Title</th>
                                                            <th style="font-size:.82rem;">Expense Details</th>
                                                            <th style="font-size:.82rem;">Amount used</th>
                                                            <th style="font-size:.82rem;">Category</th>
                                                            <th style="font-size:.89rem;">Techinician</th>
                                                            <th style="font-size:.89rem;" colspan="2">Action</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                    <?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = 1;
}

$num_per_page = 10;
$start_from = ($page-1)*10;


//get list category
$records = mysqli_query($conn,"SELECT * FROM `expense` ,`sub-details` WHERE `expense`.e_id = `sub-details`.e_id ORDER BY `expense`.e_id DESC  limit $start_from,$num_per_page "); // fetch data from database
$ct  = 1;
//search list category

if (isset($_POST['searchExpense'])) {
$SearchTerm = $_POST['search'];
$records = mysqli_query($conn,"SELECT * FROM `expense` ,`sub-details` WHERE CONCAT(`e_title`,`e_category`,`e_worker`,`e_detail`,`e_amount`,`e_detail2`,`e_detail3`,`e_detail4`,`e_detail5`) LIKE '%$SearchTerm%' AND  `expense`.e_id = `sub-details`.e_id  "); // fetch data from database

}

?>

<tr style ="line-height:auto"  >

<?php while($data = mysqli_fetch_assoc($records)){ ?>
<td style="text-align:center; font-size:.82rem; justify-content:center" rowspan="5"> <?php echo $ct; ?></td>
<td style="text-align:center; font-size:.82rem;" rowspan="5"> <?php echo $data['e_title']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_detail']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_amount']; ?></td>
<td style="text-align:center; font-size:.82rem;" rowspan="5"><?php echo $data['e_category']; ?></td>
<td style="text-align:center; font-size:.82rem;" rowspan="5"><?php echo $data['e_worker']; ?></td>
<td style="text-align:center; font-size:.82rem;" rowspan="5" ><a href="edit-expense.php?e_id=<?php echo $data['e_id'];?>"  onclick="document.getElementById('update').style.display='inline-block'"><i class="fa fa-edit" aria-hidden="true"></i></a>
<a href="deleteexp.php?e_id=<?php echo $data['e_id'];?>" style="color:red; margin-left:1rem" onclick="return confirm('Are you sure You want to delete this Record ?');"><i class="fa fa-remove" aria-hidden="true"></i></a></td>

</tr>

<tr">

<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_detail2']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php if( $data['e_amount2'] > 0){ echo $data['e_amount2']; }?></td>

</tr>
<tr>

<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_detail3']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php if( $data['e_amount3'] > 0){ echo $data['e_amount3']; }?></td>

</tr>
<tr>

<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_detail4']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php if( $data['e_amount4'] > 0){ echo $data['e_amount4']; }?></td>

</tr>
<tr>

<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php echo $data['e_detail5']; ?></td>
<td style="line-height:1.5rem; padding:0 .5rem; font-size:.82rem;"><?php if( $data['e_amount5'] > 0){ echo $data['e_amount5']; }?></td>

</tr>

<?php $ct = $ct + 1; } ?>

</table>

<div class="btns">
<?php
$result = mysqli_query($conn,"SELECT count(*) FROM `expense` ,`sub-details` WHERE `expense`.e_id = `sub-details`.e_id");
$row = mysqli_fetch_array($result);

$total = $row[0];
echo "Total Entries of Expense  : ". $total;
?>

<?php


$pr_query = mysqli_query($conn, "SELECT * FROM workers");
$total_record = mysqli_num_rows($pr_query);
$total_page = ceil($total_record/$num_per_page);

if ($page>1) {
    echo "<a href='manage-expense.php?page=".($page-1)."' class='btn btn-primary'>Previous</a>";
}
for($i=1; $i<=$total_page; $i++){
    if ($i == $page) {
        echo "<a class='active btn-#55acee'>$i</a>";
       
    }else{
        echo "<a href='manage-expense.php?page=".$i."' class='btn1'>$i</a>";      
}}
if ($i>$page) {
    echo "<a href='manage-expense.php?page=".($page+1)."' class='btn btn-primary'>Next</a>";
}
?>
<style>
    .btns{
        padding:2rem;
        margin-left:10%;
    }
    a.active{
        
        background:#55acee;
        color:#fff;
        padding:.3rem 1.3rem;
        border-radius:3px;
        margin-left:.3rem;
        
    }
    .btn1{
        background-color:#e3e9ed;
        padding:.3rem 1.3rem;
        border-radius:3px;
        color:#000;
        margin-left:.3rem;
    }
    .btn{
        background-color:#e3e9ed;
        padding:.3rem 1.3rem;
        border-radius:3px;
        margin-left:.3rem;
        border:none;
        color:#000;
        outline:none;
    }
</style>
       
        
    
  </div>
                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

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
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();
                "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging": 

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php }
else{
header("Location: index.php"); 
    }
 ?>
