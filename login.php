<?php
    // require 'database.php';
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $email = $_POST["email"];
    //     $password = $_POST["password"];

    //     $sql = "SELECT * FROM users WHERE EMAIL = '$email'";

    //     $res = mysqli_query($conn,$sql);

    //     $user = mysqli_fetch_assoc($res);

    //     if ($user && password_verify($password, $user['PASSWORD'])) {
    //         session_start();
    //         $_SESSION['user_id'] = $user['ID'];
    //         header('Location:profile.php');
    //         exit;
    //     }
    //     else{
    //         echo "Invalid credentials";
    //     }
    // }
    // require 'database.php';

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $email = $_POST["email"];
    //     $password = $_POST["password"];

    //     $sql = "SELECT * FROM users WHERE email = '$email'";
    //     $res = mysqli_query($conn, $sql);
    //     $user = mysqli_fetch_assoc($res);

    //     if ($user && password_verify($password, $user['password'])) {
    //         if ($user['verified'] == 1) {
    //             session_start();
    //             $_SESSION['user_id'] = $user['id'];
    //             header('Location: profile.php');
    //             exit;
    //         } else {
    //             echo "<script>alert('Please verify your email before logging in.'); window.location.href='login.html';</script>";
    //         }
    //     } else {
    //         echo "<script>alert('Invalid credentials'); window.location.href='login.html';</script>";
    //     }
    // }

?> 

<?php
    require 'database.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($res);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['verified'] == 1) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                header('Location: profile.php');
            }
            else {
                echo "<script>alert('Please verify your email first.'); window.location.href='verify_otp.php?email=$email';</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials'); window.location.href='login.php';</script>";
        }
    }
?>

