<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_account = $_POST['customer_account'];
    $email = $_POST['email'];
    $original_message = $_POST['original_message'];
    $reply_text = $_POST['reply_text'];
    $reply_date = date("Y-m-d H:i:s");

    if (!empty($customer_account) && !empty($reply_text)) {
        $sql = "INSERT INTO replies (customer_account, email, original_message, reply_text, reply_date) 
                VALUES (:customer_account, :email, :original_message, :reply_text, :reply_date)";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':original_message', $original_message, PDO::PARAM_STR);
        $query->bindParam(':reply_text', $reply_text, PDO::PARAM_STR);
        $query->bindParam(':reply_date', $reply_date, PDO::PARAM_STR);

        if ($query->execute()) {
            echo "<script>alert('Reply sent successfully!'); window.location.href='view_messages.php';</script>";
        } else {
            echo "<script>alert('Failed to send reply. Please try again!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Reply cannot be empty!'); window.history.back();</script>";
    }
} else {
    header("Location: view_messages.php");
    exit();
}
?>
