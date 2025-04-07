<?php
include('../includes/config.php'); // Ensure this is correctly included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $category = $_POST['category']; // Get category input

    // Check if category is "Household"
    if ($category === "Household") {
        echo "<script>alert('Customer, you are not allowed for this service.'); window.history.back();</script>";
        exit(); // Stop execution
    }

    // Prepare an SQL statement to insert data safely
    $sql = "INSERT INTO prepaid (e_title, e_detail1, e_detail2, e_amount1, e_amount2, e_detail3, e_detail4, e_amount3, e_amount4, category, customer, e_date) 
            VALUES (:e_title, :e_detail1, :e_detail2, :e_amount1, :e_amount2, :e_detail3, :e_detail4, :e_amount3, :e_amount4, :category, :customer, :e_date)";
    
    $stmt = $dbh->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':e_title', $_POST['e_title']);
    $stmt->bindParam(':e_detail1', $_POST['e_detail1']);
    $stmt->bindParam(':e_detail2', $_POST['e_detail2']);
    $stmt->bindParam(':e_amount1', $_POST['e_amount1']);
    $stmt->bindParam(':e_amount2', $_POST['e_amount2']);
    $stmt->bindParam(':e_detail3', $_POST['e_detail3']);
    $stmt->bindParam(':e_detail4', $_POST['e_detail4']);
    $stmt->bindParam(':e_amount3', $_POST['e_amount3']);
    $stmt->bindParam(':e_amount4', $_POST['e_amount4']);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':customer', $_POST['customer']);
    $stmt->bindParam(':e_date', $_POST['e_date']);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully.'); window.location.href='your_form_page.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to insert data.'); window.history.back();</script>";
    }
}
?>
