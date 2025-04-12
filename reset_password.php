<?php
    $email = $_GET['email'];
    $token = $_GET['token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <form method="POST" action="update_password.php" onsubmit="return validatePassword(event)">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">

        <label>New Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Update Password</button>
    </form>

    <script>
        function validatePassword(e) {
            const password = document.getElementById("password").value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/;

            if (!passwordRegex.test(password)) {
                alert("Password must be 8-12 characters and include:\n- One uppercase letter\n- One lowercase letter\n- One digit\n- One special character");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
