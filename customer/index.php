<?php
session_start();
include('../includes/config.php');

$error = "";

if(isset($_POST['login'])) {
    $customer_account = trim($_POST['customer_account']);
    $password = trim($_POST['password']);

    if(empty($customer_account) || empty($password)) {
        $error = "Please enter both Customer Account Number and Password.";
    } else {
        $sql = "SELECT * FROM workers WHERE customer_account = :customer_account AND password = :password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':customer_account', $customer_account, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result) {
            $_SESSION['customer_account'] = $customer_account;
            header("Location: dashboard.php"); // Redirect to customer dashboard
            exit();
        } else {
            $error = "Invalid credentials. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login | WASAC</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px #00000033;
            border-radius: 8px;
        }
        .form-control {
            margin-bottom: 10px;
            width: 400px;
            height: 25px;
            border-radius: 6px;
        }
        .btn-custom {
            background: #28a745;
            color: white;
            width: 30%;
            height: 30px;
            border: none;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background: #218838;
        }
        .error-msg {
            color: red;
            font-size: 14px;
        }label{

        }
        
    </style>
</head>
<body>

<div class="login-container">
    <p class="text-center"><center>Customer's Login</center></p><br>
    <form method="POST">
        <label style="font-size:15px;"><strong>Customer Account</strong></label><br><br>
        <input type="text" name="customer_account" class="form-control" placeholder="Enter your account number" required><br><br>

        <label style="font-size:15px;"><strong>Password</strong></label><br><br>
        <input type="password" name="password" class="form-control" placeholder="Enter password" required><br><br>

        <?php if($error) { echo "<p class='error-msg'>$error</p>"; } ?>

       <center> <button type="submit" name="login" id="button" class="btn btn-custom">Login</button></center>
    </form>
    <p class="text-center mt-3"><a href="forgot-password.php"style="font-size:12px;">Forgot Password?</a></p>
</div>

</body>
</html>
