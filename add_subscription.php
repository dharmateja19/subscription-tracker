<?php
    require 'database.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $subscription_name = $_POST['subscription_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO subscriptions (user_id,subscription_name,start_date,end_date) values ('$user_id','$subscription_name','$start_date','$end_date')";
        if(mysqli_query($conn,$sql)){
            // echo "inserted successfully";
            header("Location:profile.php");
            exit;
        }
        else{
            echo "error while inserting";
        }
    }

?>