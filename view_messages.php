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
        <title>View messages</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/topbar.php');?>
            <div class="content-wrapper">
                <div class="content-container">
                    <?php 
                    if($rolecheck['user_role'] == 'Administrator') { 
                        include('includes/leftbar.php');
                    } else { include('includes/userleftbar.php'); }
                    ?>
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">View Messages</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="#">View Messages</a></li>
                                        <li class="active">View Messages</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>View Messages</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">
                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Email</th>
                                                            <th>Messages</th>
                                                            <th>Customer</th>
                                                            <th>Location</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    $sql = "SELECT * FROM message";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if($query->rowCount() > 0)
                                                    {
                                                        foreach($results as $result)
                                                        { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->email);?></td>
                                                            <td><?php echo htmlentities($result->message);?></td>
                                                            <td><?php echo htmlentities($result->customer_account);?></td>
                                                            <td><?php echo htmlentities($result->address);?></td>
                                                            <td>
    <button class="btn btn-success reply-btn" data-customer="<?php echo htmlentities($result->customer_account); ?>" data-email="<?php echo htmlentities($result->email); ?>" data-message="<?php echo htmlentities($result->message); ?>">
        Reply
    </button>
</td>
                                                        </tr>
                                                        <?php $cnt = $cnt + 1; }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

       <!-- Background Overlay -->
<div id="overlay"></div>

<!-- Reply Form -->
<div id="replyFormContainer">
    <h4>Reply to Customer</h4>
    <form action="send_reply.php" method="POST">
        <input type="hidden" id="replyCustomerAccount" name="customer_account">
        <div class="form-group">
            <label>Email:</label>
            <input type="text" id="replyEmail" name="email" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Original Message:</label>
            <textarea id="replyMessage" name="original_message" class="form-control" readonly></textarea>
        </div>
        <div class="form-group">
            <label>Your Reply:</label>
            <textarea name="reply_text" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Send Reply</button>
        <button type="button" id="cancelReply" class="btn btn-danger">Cancel</button>
    </form>
</div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <script>
    $(document).ready(function () {
        $('#example').DataTable();

        $(document).on("click", ".reply-btn", function () {
            var customerAccount = $(this).data("customer");
            var email = $(this).data("email");
            var message = $(this).data("message");

            $("#replyCustomerAccount").val(customerAccount);
            $("#replyEmail").val(email);
            $("#replyMessage").val(message);

            $("#overlay, #replyFormContainer").fadeIn(300); // Smooth open
        });

        $("#cancelReply, #overlay").click(function () {
            $("#overlay, #replyFormContainer").fadeOut(300); // Smooth close
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
<style>
    /* Reply Form Styling */
    #replyFormContainer {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    #replyFormContainer h4 {
        margin-bottom: 10px;
        font-size: 18px;
        text-align: center;
    }

    #replyFormContainer .form-group label {
        font-size: 14px;
        font-weight: 600;
    }

    #replyFormContainer textarea {
        resize: none;
        height: 60px;
        font-size: 14px;
    }

    #replyFormContainer .btn {
        width: 100%;
        margin-top: 10px;
    }

    /* Background overlay */
    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }.btn btn-success {
    background-color: #0056b3; !important;
    border-color: #0056b3; !important;
    }
    
</style>
