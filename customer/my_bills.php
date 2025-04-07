<?php
include('../includes/config.php');
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_account'])) {
    header("Location: index.php"); // Redirect to login page if not set
    exit();
}

$customer_account = $_SESSION['customer_account'];

$sql = "SELECT category, meter_number, meter_reading, new_money, divided_amount, payment_period, prepaid, m_date FROM money WHERE customer_account = :customer_account";
$query = $dbh->prepare($sql);
$query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Water Bill Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            padding-top: 0px;
            color: white;
        }
        .sidebar img {
            display: block;
            margin: 0 auto 20px;
            width: 99%;
            height: 30%;
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
        .warning {
            padding: 10px;
            margin: 10px 0;
            font-weight: bold;
            color: white;
            text-align: center;
        }
        .reminder { background-color: #ffcc00; } /* Yellow */
        .penalty { background-color: #ff0000; } /* Red */
        .
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Company Logo">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-file-invoice-dollar"></i> My Bills</a>
        <a href="prepaid.php"><i class="fas fa-wallet"></i> Payments</a>
        <a href="penalty.php"><i class="fas fa-user"></i> Penalty</a>
        <a href="#"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    
    <div class="content">
        <div class="container">
            <h2 class="text-center">Latest Bills</h2>
            <div id="notification"></div>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Category</th>
                        <th>Meter Number</th>
                        <th>M³</th>
                        <th>Total Amount</th>
                        <th>Installment Amount</th>
                        <th>Payment Period</th>
                        
                        <th>Bill Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) { ?>
                        <tr data-date="<?php echo $row['m_date']; ?>" data-amount="<?php echo $row['divided_amount']; ?>">
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['meter_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['meter_reading']); ?></td>
                            <td><?php echo htmlspecialchars($row['new_money']); ?></td>
                            <td><?php echo htmlspecialchars($row['divided_amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['payment_period']); ?></td>
                            <td><?php echo htmlspecialchars($row['m_date']); ?></td>
                            <td><button class="btn btn-primary pay-now" data-toggle="modal" data-target="#payModal">Pay Now</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Modal -->
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
                    <form action="process_payment.php" method="POST" id="paymentForm">
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
                            <input type="text" class="form-control" name="amount" id="amount" readonly>
                        </div>
                        <button type="submit" class="btn btn-success">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Reminder & Penalty System
            $("tr[data-date]").each(function() {
                let billDate = new Date($(this).attr("data-date"));
                let today = new Date();
                let timeDiff = today - billDate;
                let daysPassed = timeDiff / (1000 * 60 * 60 * 24); // Convert to days
                
                if (daysPassed > 30) {
                    $("#notification").append('<div class="warning penalty">Your bill is overdue! A penalty of 5000 RWF applies.</div>');
                } else if (daysPassed > 20) {
                    $("#notification").append('<div class="warning reminder">Reminder: Pay your bill within ' + (30 - Math.floor(daysPassed)) + ' days to avoid penalties.</div>');
                }
            });

            // Open Payment Modal & Auto-fill Fields
            $(".pay-now").on("click", function() {
                let amount = $(this).closest("tr").attr("data-amount");
                $("#amount").val(amount);
            });
        });
        $(document).ready(function () {
    $("#paymentForm").submit(function (event) {
        event.preventDefault(); // Prevent page refresh
        
        $.ajax({
            type: "POST",
            url: "process_payment.php", // Path to the PHP file
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
