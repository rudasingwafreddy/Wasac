
<?php
session_start();
error_reporting(0);
include('includes/configuration.php');

$user= $_SESSION['username'];
if($user=="")
{header('location:../index.php');}
$sql=mysqli_query($conn,"SELECT * from users where username ='$user' ");
$users=mysqli_fetch_array($sql);

    
?>

<div class="left-sidebar bg-black-300 box-shadow ">
                        <div class="sidebar-content">
                            <div class="user-info closed">
                            <img src="http://placehold.it/90/c2c2c2?text=<?php  echo $users['username'] ?>" class="img-circle profile-img">
                                
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Main Category</span>
                                    </li>
                                    <li>
                                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                                     
                                    </li>

                                    <li class="nav-header">
                                        <span class="">Appearance</span>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Category</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="create-category.php"><i class="fa fa-bars"></i> <span>Create Category</span></a></li>
                                            <li><a href="manage-category.php"><i class="fa fa fa-server"></i> <span>Manage Category</span></a></li>
                                           
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Customer</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="create-tech.php"><i class="fa fa-bars"></i> <span>+ Customer</span></a></li>
                                            <li><a href="manage-tech.php"><i class="fa fa fa-server"></i> <span>Manage Customer</span></a></li>
                                           
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Prepaid Amount</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="create-input.php"><i class="fa fa-bars"></i> <span>Assign Prepaid</span></a></li>
                                            <li><a href="manage-input.php"><i class="fa fa fa-server"></i> <span>Manage Prepaid</span></a></li>
                                           
                                        </ul>
                                    </li>
  <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Bills</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="lunchexpense.php"><i class="fa fa-bars"></i> <span>Generate Bill</span></a></li>
                                            <li><a href="manage-lunch.php"><i class="fa fa-server"></i> <span>Manage Bill</span></a></li>
                                            <li><a href="create-expense.php"><i class="fa fa-bars"></i> <span>Assign Prepaid</span></a></li>
                                            <li><a href="manage-expense.php"><i class="fa fa fa-server"></i> <span>Manage Prepaid</span></a></li>
                                            <li><a href="check_penalties.php"><i class="fa fa fa-server"></i> <span>Check Penalty</span></a></li>
                                           
                                        </ul>
                                    </li>
   <li class="has-children">
                                        <a href="#"><i class="fa fa-info-circle"></i> <span>Report</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            
                                            <li><a href="reporte.php"><i class="fa fa fa-server"></i> <span>Reports of Water Bills</span></a></li>
                                           
                                        </ul>
                                    </li>
<!-- <li class="has-children">
                                        <a href="#"><i class="fa fa-comment"></i> <span>Chat</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="chat.php"><i class="fa fa-comment"></i> <span>Group Chat</span></a></li>
                                            
                                           
                                        </ul>
</li> -->

                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>