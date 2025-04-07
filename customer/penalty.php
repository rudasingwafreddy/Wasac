<?php
include('../includes/config.php');
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_account'])) {
    header("Location: index.php");
    exit();
}

$customer_account = $_SESSION['customer_account'];

$sql = "SELECT 
           pen.penalty_amount, 
           pen.description, 
           COALESCE(SUM(pay.amount), 0) AS paid_amount, 
           COALESCE(SUM(pay.remaining_to_pay), 0) AS remaining_to_pay, 
           COALESCE(m.divided_amount, 0) AS divided_amount 
        FROM penalty pen
        LEFT JOIN payments pay ON pen.customer_account = pay.customer_account 
        LEFT JOIN money m ON pen.customer_account = m.customer_account 
        WHERE pen.customer_account = :customer_account
        GROUP BY pen.penalty_amount, pen.description, m.divided_amount";

$query = $dbh->prepare($sql);
$query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$query->execute();
$penalty = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Water Bill Management</title>
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
        .pay-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 15px;
        }
        .pay-btn:hover {
            background-color: #0056b3;
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
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h2>Customer Payment Details</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Remaining to Pay (RWF)</th>
                        <th>Penalty Amount (RWF)</th>
                        <th>Installement (RWF)</th>
                        <th>Paid Amount (RWF)</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($penalty) { ?>
                        <tr>
                            <td><?php echo number_format($penalty['remaining_to_pay'], 2); ?></td>
                            <td><?php echo number_format($penalty['penalty_amount'], 2); ?></td>
                            <td><?php echo number_format($penalty['divided_amount'], 2); ?></td>
                            <td><?php echo number_format($penalty['paid_amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($penalty['description']); ?></td>
                            <td>
                                <button class="pay-btn" onclick="openPaymentModal()">
                                    Pay Now
                                </button>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">No penalty found for your account.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="pay_penalties.php" method="POST">
                        <input type="hidden" name="customer_account" value="<?php echo $customer_account; ?>">

                        <div class="form-group">
                            <label>Total Amount to Pay (RWF)</label>
                            <input type="text" class="form-control" name="total_amount" 
                                value="<?php echo number_format($penalty['remaining_to_pay'] + $penalty['penalty_amount'] , 2); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" required>
                        </div>

                        <input type="hidden" name="status" value="paid">

                        <button type="submit" class="btn btn-success btn-block">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function openPaymentModal() {
            $('#paymentModal').modal('show');
        }
    </script>
</body>
</html>
