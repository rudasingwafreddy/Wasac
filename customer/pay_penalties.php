<?php
include('../includes/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_account = $_POST['customer_account'];
    $total_amount = str_replace(',', '', $_POST['total_amount']); // Remove commas
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $penalty_date = date("Y-m-d"); // Get today's date

    try {
        // Insert payment into the penalty table
        $sql = "INSERT INTO penalty (customer_account, penalty_amount, phone_number, status, penalty_date, created_at) 
                VALUES (:customer_account, :penalty_amount, :phone_number, :status, :penalty_date, NOW())";
                
        $query = $dbh->prepare($sql);
        $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        $query->bindParam(':penalty_amount', $total_amount, PDO::PARAM_STR);
        $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
         $query->bindParam(':penalty_date', $penalty_date, PDO::PARAM_STR);
         $query->bindParam(':status', $status, PDO::PARAM_STR);
        
        if ($query->execute()) {
            $_SESSION['success_msg'] = "Payment successful!";
        } else {
            $_SESSION['error_msg'] = "Failed to process payment. Please try again.";
        }

        // Redirect back to dashboard
        header("Location: penalty.php");
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error_msg'] = "Error: " . $e->getMessage();
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
