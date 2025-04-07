<?php
include('../includes/config.php');


  // Ensure session username is set
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];
        $customer_account = $_POST['customer_account'];

        $sql = "INSERT INTO message (email, address, message, customer_account) VALUES (:email, :address, :message,:customer_account)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        if ($query->execute()) {
            echo "<script>
                    alert('Message sent successfully!');
                    window.location.href = 'dashboard.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.');window.location.href = 'dashboard.php'</script>";
        }
    }
 else {
    echo "<script>alert('Please log in to send a message.');window.location.href = 'dashboard.php'</script>";
}
?>