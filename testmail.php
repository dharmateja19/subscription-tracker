<?php
    $to = "dharmatejapamarthi143@gmail.com";
    $sub = "test";
    $msg = "this is testing mail";
    $headers = "From: subscriptiontrackertest@gmail.com";
    if(mail($to,$sub,$msg,$headers)){
        echo "mail sent successfully";
    }
    else{
        echo "mail cant be send";
    }
?>