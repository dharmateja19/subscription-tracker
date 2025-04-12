<?php $email = $_GET['email']; ?>
<h2>Verify Your Email</h2>

<form action="verify_otp_process.php" method="POST">
    <input type="hidden" name="email" value="<?= $email ?>">
    <label>Enter OTP:</label>
    <input type="text" name="otp" maxlength="6" required>
    <button type="submit">Verify</button>
</form>

<form action="resend_otp.php" method="POST" style="margin-top: 10px;">
    <input type="hidden" name="email" value="<?= $email ?>">
    <button type="submit">Resend OTP</button>
</form>
