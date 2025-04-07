<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Prevent going back after logout
echo "<script>
    window.location.href = 'index.php'; // Redirect to login page
</script>";
exit();
?>
