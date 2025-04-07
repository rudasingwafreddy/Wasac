<?php
session_start();
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_account = $_POST['customer_account'];
    $phone_number = $_POST['phone_number'];
    $amount = floatval($_POST['amount']); // Ensure amount is a valid number

    try {
        // Fetch divided_amount from money table
        $sql = "SELECT divided_amount FROM money WHERE customer_account = :customer_account";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $divided_amount = floatval($result['divided_amount']);

            if ($amount <= 0) {
                echo "<script>
            alert('invalid payment amount.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
                exit();
            }

            if ($amount > $divided_amount) {
                echo "<script>
            alert('payment amount exceeds the required amount.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
                exit(); // 🔴 This prevents inserting when overpaid
            }

            // Calculate remaining amount to pay
            $remaining_to_pay = $divided_amount - $amount;

            // Insert into payments table
            $insert_sql = "INSERT INTO payments (customer_account, phone_number, amount, payment_date, remaining_to_pay) 
                           VALUES (:customer_account, :phone_number, :amount, NOW(), :remaining_to_pay)";
            $insert_stmt = $dbh->prepare($insert_sql);
            $insert_stmt->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
            $insert_stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $insert_stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $insert_stmt->bindParam(':remaining_to_pay', $remaining_to_pay, PDO::PARAM_STR); // Ensure binding

            if ($insert_stmt->execute()) {
                echo "<script>
            alert('Payment successful!');
            window.location.href = 'dashboard.php'; // Redirect to dashboard
          </script>";
            } else {
                echo "<script>
            alert('Failed to process payment.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
            }
        } else {
            echo "<script>
            alert('Customer account not found.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('database error.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
    }
} else {
    echo "<script>
            alert('payment error.');
            window.location.href = 'dashboard.php'; // Redirect back to dashboard
          </script>";
}
?>
