<?php
include('../includes/config.php');
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_account'])) {
    header("Location: index.php");
    exit();
}

$customer_account = $_SESSION['customer_account'];

$sql = "SELECT email, original_message, reply_text, reply_date 
        FROM replies 
        WHERE customer_account = :customer_account 
        ORDER BY reply_date DESC";

$query = $dbh->prepare($sql);
$query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$query->execute();
$replies = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Replies | Water Bill Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Company Logo">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="my_bills.php"><i class="fas fa-file-invoice-dollar"></i> My Bills</a>
        <a href="prepaid.php"><i class="fas fa-wallet"></i> Payments</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="replies.php"><i class="fas fa-envelope"></i> My Replies</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h2><center>My Replies</center></h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Email</th>
                        <th>Original Message</th>
                        <th>Reply</th>
                        <th>Reply Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($replies) { 
                        foreach ($replies as $reply) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reply['email']); ?></td>
                            <td><?php echo htmlspecialchars($reply['original_message']); ?></td>
                            <td><?php echo htmlspecialchars($reply['reply_text']); ?></td>
                            <td><?php echo date('d M Y, H:i', strtotime($reply['reply_date'])); ?></td>
                        </tr>
                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No replies found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
