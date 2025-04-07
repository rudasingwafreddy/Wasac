<?php
include('../includes/config.php');
session_start();

// Assuming the session holds customer account info
$customer_account = $_SESSION['customer_account'];

try {
    $sql = "SELECT first_name, last_name, role, gender, address, telephone, meter_number, customer_account,password FROM workers WHERE customer_account = :customer_account";
    $query = $dbh->prepare($sql);
    $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
    $query->execute();
    
    $customer = $query->fetch(PDO::FETCH_ASSOC);

    if ($customer) {
        echo json_encode(array_merge(["status" => "success"], $customer));
    } else {
        echo json_encode(["status" => "error", "message" => "Customer not found."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
}
?>
