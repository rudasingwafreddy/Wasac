<?php
include('../includes/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_account = $_SESSION['customer_account'];
    $phone_number = $_POST['phone_number'];
    $amount = $_POST['amount'];
    $payment_date = date("Y-m-d H:i:s"); // Get current date and time

    try {
        $sql = "INSERT INTO payments (customer_account, phone_number, amount, payment_date) 
                VALUES (:customer_account, :phone_number, :amount, :payment_date)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $query->bindParam(':amount', $amount, PDO::PARAM_STR);
        $query->bindParam(':payment_date', $payment_date, PDO::PARAM_STR); // Bind date parameter

        if ($query->execute()) {
            echo json_encode(["status" => "success", "message" => "Payment recorded successfully on $payment_date"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to record payment."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
}
?>
