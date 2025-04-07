<?php
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerAccount = $_POST['customer_account'];
    $meterNumber = $_POST['meter_number'];
    $penaltyAmount = $_POST['penalty_amount'];
    $description = $_POST['description'];
    $penaltyDate = $_POST['penalty_date'];

    // Check if a penalty already exists for this customer in the current month
    $sqlCheck = "SELECT COUNT(*) FROM penalty 
                 WHERE customer_account = :customer_account 
                 AND MONTH(penalty_date) = MONTH(CURDATE()) 
                 AND YEAR(penalty_date) = YEAR(CURDATE())";

    $queryCheck = $dbh->prepare($sqlCheck);
    $queryCheck->execute([':customer_account' => $customerAccount]);
    $count = $queryCheck->fetchColumn();

    if ($count > 0) {
        // If a penalty exists for this month, show an alert
        echo "<script>alert('Penalty already Approved for this month!'); window.location='check_penalties.php';</script>";
    } else {
        // Insert penalty if no record exists for the current month
        $sqlInsert = "INSERT INTO penalty (customer_account, meter_number, penalty_amount, description, penalty_date) 
                      VALUES (:customer_account, :meter_number, :penalty_amount, :description, :penalty_date)";

        $queryInsert = $dbh->prepare($sqlInsert);
        $queryInsert->execute([
            ':customer_account' => $customerAccount,
            ':meter_number' => $meterNumber,
            ':penalty_amount' => $penaltyAmount,
            ':description' => $description,
            ':penalty_date' => $penaltyDate
        ]);

        echo "<script>alert('Penalty Approved!'); window.location='check_penalties.php';</script>";
    }
}
?>
