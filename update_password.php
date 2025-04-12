<?php
require 'database.php';
date_default_timezone_set('Asia/Kolkata'); // Set your timezone

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Fetch the user and check token validity
    $sql = "SELECT * FROM users WHERE email = '$email' AND reset_token = '$token'";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $current_time = date('Y-m-d H:i:s');
        $token_expiry = $user['token_expiry'];

        // Debug: Show current and expiry time
        echo "Token Expiry in DB: " . $token_expiry . "<br>";
        echo "Current Time: " . $current_time . "<br>";

        if ($token_expiry >= $current_time) {
            // Update the password and clear token
            $update = "UPDATE users 
                       SET password = '$hashed', reset_token = NULL, token_expiry = NULL 
                       WHERE email = '$email'";
            if (mysqli_query($conn, $update)) {
                echo "<script>alert('Password updated successfully. Please login.'); window.location.href='login.html';</script>";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Reset link expired. Please try again.'); window.location.href='forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid reset link.'); window.location.href='forgot_password.php';</script>";
    }
}
?>
