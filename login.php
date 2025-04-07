<?php
    require 'database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE EMAIL = '$email'";

        $res = mysqli_query($conn,$sql);

        $user = mysqli_fetch_assoc($res);

        if ($user && password_verify($password, $user['PASSWORD'])) {
            session_start();
            $_SESSION['user_id'] = $user['ID'];
            header('Location:profile.php');
            exit;
        }
        else{
            echo "Invalid credentials";
        }
    }
?> 
