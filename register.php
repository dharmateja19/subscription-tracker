<?php
    require "database.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile =$_POST["mobile_no"];
        $password = $_POST["password"];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $ext = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($conn,$ext);
        if(mysqli_num_rows($res) > 0){
            echo "<script> alert('You have already registered. Please login.'); window.location.href='login.html';</script>";
            exit;
        }
        
        $sql = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$pass_hash')";
        if(mysqli_query($conn,$sql)){
            echo "data inserted successfully";
            header('Location: login.html');
        }
        else{
            echo "<br> Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
            echo "data cannot be inserted";
        }
    }
?>