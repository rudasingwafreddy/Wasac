<?php
include('../includes/config.php');
session_start();
$customer_account = $_SESSION['customer_account'];

// Fetch required amounts from the `money` table
$sqlMoney = "SELECT meter_number, meter_reading, new_money, divided_amount, payment_period, m_date FROM money WHERE customer_account = :customer_account";
$queryMoney = $dbh->prepare($sqlMoney);
$queryMoney->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$queryMoney->execute();
$moneyData = $queryMoney->fetch(PDO::FETCH_ASSOC);

$dividedAmount = $moneyData['divided_amount']; // Amount to be paid

// Fetch total amount paid from the `payments` table
$sqlPayments = "SELECT SUM(amount) as amount FROM payments WHERE customer_account = :customer_account";
$queryPayments = $dbh->prepare($sqlPayments);
$queryPayments->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$queryPayments->execute();
$paymentData = $queryPayments->fetch(PDO::FETCH_ASSOC);

$totalPaid = $paymentData['amount'] ?? 0; // Total paid amount
$balance = max(0, $totalPaid - $dividedAmount); // Calculate balance if overpaid

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
            color: white;
        }
        .sidebar img {
            display: block;
            margin: 20px auto;
            width: 90%;
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
            margin-left: 260px;
            padding: 20px;
        }
        .message {
            padding: 10px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        .success { background-color: #4CAF50; color: white; }
        .info { background-color: #2196F3; color: white; }
        .table-container {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .balance-box {
            padding: 15px;
            background: #ffc107;
            color: #333;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }h3{
            font-size: 17px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Company Logo">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="my_bills.php"><i class="fas fa-file-invoice-dollar"></i> My Bills</a>
        <a href="prepaid.php"><i class="fas fa-wallet"></i> Payments</a>
        <a href="penalty.php"><i class="fas fa-user"></i> Penalty</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <?php if ($totalPaid >= $dividedAmount) { ?>
            <div class="message success">You have already paid your bill!</div>
        <?php } ?>

        <?php if ($balance > 0) { ?>
            <div class="balance-box">Your current balance: <strong><?php echo number_format($balance, 2); ?> RWF</strong></div>
        <?php } ?>

        <div class="table-container">
           <center><h3>Bill Details</h3></center>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Meter Number</th>
                        <th>M³ Used</th>
                        <th>Total Amount (RWF)</th>
                        <th>Installment Amount (RWF)</th>
                        <th>Payment Period</th>
                        <th>Bill Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $moneyData['meter_number']; ?></td>
                        <td><?php echo $moneyData['meter_reading']; ?></td>
                        <td><?php echo number_format($moneyData['new_money'], 2); ?></td>
                        <td><?php echo number_format($dividedAmount, 2); ?></td>
                        <td><?php echo $moneyData['payment_period']; ?></td>
                        <td><?php echo $moneyData['m_date']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="table-container">
            <center><h3>Payment History</h3></center>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Amount Paid (RWF)</th>
                       
                        <th>Payment Date</th>
                         <th>Phone Number (+250)</th>
                    </tr>
                </thead>
                <tbody id="paymentHistory">
                    <?php
                    $sqlPaymentHistory = "SELECT amount, payment_date, phone_number FROM payments WHERE customer_account = :customer_account ORDER BY payment_date DESC";
                    $queryPaymentHistory = $dbh->prepare($sqlPaymentHistory);
                    $queryPaymentHistory->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
                    $queryPaymentHistory->execute();
                    while ($row = $queryPaymentHistory->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>" . number_format($row['amount'], 2) . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['phone_number'] . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const balanceBox = document.querySelector(".balance-box");

            function updateBalance(amountPaid) {
                let currentBalance = parseFloat(balanceBox.textContent.replace(/[^\d.-]/g, ''));
                let newBalance = currentBalance - amountPaid;
                if (newBalance < 0) {
                    newBalance = 0;
                }
                balanceBox.textContent = "Your current balance: " + newBalance.toFixed(2) + " RWF";
            }

            function refreshPaymentHistory() {
                fetch("fetch_payments.php")
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("paymentHistory").innerHTML = data;
                    });
            }

            setInterval(refreshPaymentHistory, 10000); // Refresh payment history every 10 seconds
        });
    </script>
</body>
</html>
