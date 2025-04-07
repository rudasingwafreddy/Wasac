<?php
session_start();
if (!isset($_SESSION['customer_account'])) {
    header("Location: index.php"); // Redirect to login page if session doesn't exist
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | Water Bill Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #151922;
            padding-top: 1px;
            color: white;
        }
        .sidebar img {
            display: block;
            margin: 0 auto 20px;
            width: 99%;
            height: 32%;
        }
        .sidebar a {
            padding: 15px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: whitesmoke;
            color: black;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .profile-info {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
        }
        .edit-btn {
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .edit-btn:hover {
            background-color: #28a745;
        }
        .password-box {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .password-box input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .save-btn {
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .save-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Company Logo">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="my_bills.php"><i class="fas fa-file-invoice-dollar"></i> My Bills</a>
        <a href="prepaid.php"><i class="fas fa-wallet"></i> Payments</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <div class="profile-container">
            <h2>Customer Profile</h2>

            <div id="profileDetails">
                <p>Loading customer details...</p>
            </div>

            <!-- Password Edit Section -->
            <button class="edit-btn" onclick="showPasswordBox()">Edit Password</button>
            <div class="password-box" id="passwordBox">
                <h4>Change Password</h4>
                <input type="password" id="newPassword" placeholder="Enter new password">
                <button class="save-btn" onclick="updatePassword()">Save</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("fetch_customer.php")
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById("profileDetails").innerHTML = `
                            <h3 class="section-title">Customer Information</h3>
                            <p class="profile-info"><strong>Full Name:</strong> ${data.first_name} ${data.last_name}</p>
                            <p class="profile-info"><strong>Role:</strong> ${data.role}</p>

                            <h3 class="section-title">Customer Address</h3>
                            <p class="profile-info"><strong>Phone Number:</strong> ${data.telephone}</p>
                            <p class="profile-info"><strong>Address:</strong> ${data.address}</p>

                            <h3 class="section-title">Account Details</h3>
                            <p class="profile-info"><strong>Meter Number:</strong> ${data.meter_number}</p>
                            <p class="profile-info"><strong>Customer Account:</strong> ${data.customer_account}</p>
                            <p class="profile-info"><strong>Password:</strong> ${data.password}</p>
                        `;
                    } else {
                        document.getElementById("profileDetails").innerHTML = `<p style="color:red;">Error: ${data.message}</p>`;
                    }
                })
                .catch(error => {
                    document.getElementById("profileDetails").innerHTML = `<p style="color:red;">Failed to load data.</p>`;
                });
        });

        function showPasswordBox() {
            document.getElementById("passwordBox").style.display = "block";
        }

        function updatePassword() {
            let newPassword = document.getElementById("newPassword").value;
            if (newPassword.trim() === "") {
                alert("Password cannot be empty!");
                return;
            }

            fetch("update_password.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ newPassword: newPassword })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    document.getElementById("passwordBox").style.display = "none";
                }
            })
            .catch(error => {
                alert("Error updating password.");
            });
        }
    </script>
</body>
</html>
