<?php
session_start();
if (!isset($_SESSION['customer_account'])) {
    header("Location: index.php"); // Redirect to login page if session doesn't exist
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Water Bill Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #151922;
            padding-top: 1px;
            color: white;
        }
        .sidebar img {
            display: block;
            margin: 0 auto 20px;
            width: 99%;
            height: 32%;
        }
        .sidebar a {
            padding: 15px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: whitesmoke;
            color: black;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Company Logo">  <!-- Updated to display logo image -->
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="my_bills.php"><i class="fas fa-file-invoice-dollar"></i> My Bills</a>
        <a href="prepaid.php"><i class="fas fa-wallet"></i> Payments</a>
        <a href="penalty.php"><i class="fas fa-user"></i> Penalty</a>
        <a href="Profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="view_message.php"><i class="fas fa-user"></i> Message</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
        
        <div class="row">
            <div class="col-md-4">
                <div class="card"style="background: #30B7D2;border-radius: 25px;color:white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-wallet icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;Current Balance</h5>
                        <?php
                           
    include('../includes/config.php');
    
    $customer_account = $_SESSION['customer_account'];

    $sql = "SELECT new_money FROM money WHERE customer_account = :customer_account";
    $query = $dbh->prepare($sql);
    $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $balance = $result['new_money'];
    } else {
        $balance = "Not Assigned yet"; 
    }
?>
<p class="card-text">RWF: <?php echo $balance; ?></p>
                        <button class="btn btn-primary pay-now" data-toggle="modal" data-target="#payModal">Pay Now</button><span class="btn-label btn-label-right"><i class="fa fa-check"></i></span>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card"style="background: #80EF80;border-radius: 25px;color:white">
                	<div class="card-body">
                		<h5 class="card-title"><i class="fas fa-wallet icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;Current Balance</h5>
                    <?php
                
                $customer_account = $_SESSION['customer_account'];

                // Retrieve customer details
                $sql = "SELECT customer_account, meter_number FROM workers WHERE customer_account = :customer_account";
                $query = $dbh->prepare($sql);
                $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $customer_account = $result['customer_account'];
                    $meter_account = $result['meter_number'];
                } else {
                    $customer_account = "Not Available";
                    $meter_account = "Not Available";
                }
            ?>
            <p class="card-text">Account Number: <?php echo $customer_account; ?></p>
            <p class="card-text">Meter Number: <?php echo $meter_account; ?></p>
                </div>
            </div>
        </div>
            <div class="col-md-4">
                <div class="card"style="background: #30B7D2;border-radius: 25px;color:white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-file-invoice-dollar icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;Upcoming Bill</h5>
                        <?php

$sql = "SELECT m_date FROM money WHERE customer_account = :customer_account ";
$query = $dbh->prepare($sql);
$query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $generate_on = $result['m_date'];
    $due_date = date('Y-m-d', strtotime($generate_on . ' +30 days'));
} else {
    $generate_on = "Not Available";
    $due_date = "Not Available";
}
?><p class="card-text">Due:<b style="color: red;">&nbsp;&nbsp;&nbsp;<?php echo $due_date; ?></b></p>
            <p class="card-text">Generate on:&nbsp;&nbsp;<?php echo $generate_on; ?></p>

                    </div>
                </div>
            </div><div class="contact-container text-center">
    <h2>Message Us</h2>
    <form id="contactForm" action="contact.php" method="POST">
        <input type="text" name="email" class="form-control" placeholder="Email/Phone Number" required><br>
        <select class="form-control" name="address" required>
            <option value="">Select Location</option>
            <option value="Nyanza">Nyanza</option>
            <option value="Muhanga">Muhanga</option>
            <option value="Ruhango">Ruhango</option>
            <option value="Gisagara">Gisagara</option>
            <option value="Rusisi">Rusisi</option>
            <option value="Rubavu">Rubavu</option>
            <option value="Gatsibo">Gatsibo</option>
            <option value="Rurindo">Rurindo</option>
            <option value="Musanze">Musanze</option>
            <option value="Gakenke">Gakenke</option>
        </select><br> 
        <textarea name="message" class="form-control" placeholder="Message us:" required></textarea><br>
        <div class="modal-body">
                    <form action="pay_penalties.php" method="POST">
                        <input type="hidden" name="customer_account" value="<?php echo $customer_account; ?>">
        <button type="submit" name="submit"class="btn btn-success">Send</button>
    </form>
    <div id="adminReply" class="alert alert-success mt-3" style="display:none;">
        Admin has replied to your message!
    </div>
</div>
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payModalLabel">MTN MoMo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="pay.php" method="POST" id="paymentForm">
                        <div class="form-group">
                            <label>Customer Account</label>
                            <input type="text" class="form-control" name="customer_account" id="customer_account" value="<?php echo $customer_account; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" required>
                        </div>
                        <button type="submit" class="btn btn-success">Pay</button>
                    </form>
                </div>
            </div>
        </div>

<style>
    .contact-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }h2{
    	font-size: 15px;
    }
</style><script>
    $(document).ready(function () {
    $("#paymentForm").submit(function (event) {
        event.preventDefault(); // Prevent page refresh
        
        $.ajax({
            type: "POST",
            url: "pay.php", // Path to the PHP file
            data: $("#paymentForm").serialize(),
            dataType: "json",
            success: function (response) {
                alert(response.message); // Show response message
                if (response.status === "success") {
                    $("#paymentForm")[0].reset(); // Reset form after success
                }
            }
        });
    });
});
</script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        </div>
    </div>
</body>
</html>
