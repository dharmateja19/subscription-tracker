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
    <form action="add_subscription.php" method="post">
        <input type="text" name="subscription_name" placeholder="Subscription Name" required>
        <input type="date" name="start_date" placeholder="Start Date" required>
        <input type="date" name="end_date" placeholder="End Date" required>
        <button type="submit">Add Subscription</button>
    </form>
<?php
} else {
    header('Location: login.php');
    exit;
}
?>