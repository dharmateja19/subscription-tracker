<?php
    require 'database.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM subscriptions WHERE user_id = '$user_id'";
        $subscriptions = mysqli_query($conn, $query);
    ?>
        <h2>Subscriptions</h2>
        <ul>
            <?php while ($subscription = mysqli_fetch_assoc($subscriptions)) { ?>
                <li><?= $subscription['subscription_name'] ?> (<?= $subscription['start_date'] ?> - <?= $subscription['end_date'] ?>)</li>
            <?php } ?>
        </ul>
        <a href="add_subscription.html"><button name="add">Add</button></a>
    <?php
    } else {
        header('Location: login.php');
        exit;
    }
?>