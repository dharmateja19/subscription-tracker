<?php
    // require "database.php";

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $name = $_POST["name"];
    //     $email = $_POST["email"];
    //     $mobile =$_POST["mobile_no"];
    //     $password = $_POST["password"];
    //     $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    //     $ext = "SELECT * FROM users WHERE email = '$email'";
    //     $res = mysqli_query($conn,$ext);
    //     if(mysqli_num_rows($res) > 0){
    //         echo "<script> alert('You have already registered. Please login.'); window.location.href='login.html';</script>";
    //         exit;
    //     }
        
    //     $sql = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$pass_hash')";
    //     if(mysqli_query($conn,$sql)){
    //         echo "data inserted successfully";
    //         header('Location: login.html');
    //     }
    //     else{
    //         echo "<br> Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
    //         echo "data cannot be inserted";
    //     }
    // }
    // require "database.php";

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $name = $_POST["name"];
    //     $email = $_POST["email"];
    //     $mobile = $_POST["mobile_no"];
    //     $password = $_POST["password"];
    //     $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    //     $token = bin2hex(random_bytes(16)); // generate verification token

    //     $ext = "SELECT * FROM users WHERE email = '$email'";
    //     $res = mysqli_query($conn, $ext);
    //     if(mysqli_num_rows($res) > 0){
    //         echo "<script>alert('You have already registered. Please login.'); window.location.href='login.html';</script>";
    //         exit;
    //     }

    //     $sql = "INSERT INTO users (name, email, mobile, password, verification_token) VALUES ('$name', '$email', '$mobile', '$pass_hash', '$token')";
    //     if(mysqli_query($conn, $sql)){
    //         $subject = "Verify your email";
    //         $message = "Click the link to verify your email: http://yourdomain.com/verify.php?token=$token";
    //         $headers = "From: no-reply@yourdomain.com";
    //         mail($email, $subject, $message, $headers);

    //         echo "<script>alert('Registration successful! Please check your email to verify your account.'); window.location.href='login.html';</script>";
    //         exit;
    //     } else {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // }
    
?>
<?php
    require "database.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile_no"];
        $password = $_POST["password"];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $check = "SELECT * FROM users WHERE email = '$email'";
        
        $res = mysqli_query($conn, $check);
        if (mysqli_num_rows($res) > 0) {
            echo "<script>alert('Email already registered. Please login.'); window.location.href='login.html';</script>";
            exit;
        }

        $sql = "INSERT INTO users (name, email, mobile, password, otp, otp_expiry, verified)
                VALUES ('$name', '$email', '$mobile', '$pass_hash', '$otp', '$otp_expiry', 0)";
        
        if (mysqli_query($conn, $sql)) {
            $subject = "Your OTP Verification Code";
            $message = "Hi $name,\n\nYour OTP code is: $otp\nIt expires in 10 minutes.";
            $headers = "From: no-reply@yourdomain.com";

            mail($email, $subject, $message, $headers);
            header("Location: verify_otp.php?email=$email");
            exit;
        } 
        else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>
