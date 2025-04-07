<?php
include('../includes/config.php');
session_start();

$customer_account = $_SESSION['customer_account'];
$data = json_decode(file_get_contents("php://input"), true);
$newPassword = $data['newPassword']; // Store as plain text (⚠ Not secure)

try {
    $sql = "UPDATE workers SET password = :newPassword WHERE customer_account = :customer_account";
    $query = $dbh->prepare($sql);
    $query->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
    $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
    
    if ($query->execute()) {
        echo json_encode(["status" => "success", "message" => "Password updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update password."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
}
?>

