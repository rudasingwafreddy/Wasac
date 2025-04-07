<?php
include('../includes/config.php');
session_start();
$customer_account = $_SESSION['customer_account'];

$sqlPaymentHistory = "SELECT amount, payment_date, phone_number FROM payments WHERE customer_account = :customer_account ORDER BY payment_date DESC";
$queryPaymentHistory = $dbh->prepare($sqlPaymentHistory);
$queryPaymentHistory->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
$queryPaymentHistory->execute();
$payments = $queryPaymentHistory->fetchAll(PDO::FETCH_ASSOC);

if ($payments) {
    foreach ($payments as $row) {
        echo "<tr><td>" . number_format($row['amount'], 2) . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['phone_number'] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No Payment Records Found</td></tr>";
}
?>
