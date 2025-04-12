<?php
// require 'database.php';
// date_default_timezone_set('Asia/Kolkata');

// $daysBeforeList = [7, 3, 5, 1];
// $today = date('Y-m-d');

// foreach ($daysBeforeList as $daysBefore) {
//     $targetDate = date('Y-m-d', strtotime("+$daysBefore days"));

//     $query = "SELECT u.email, u.name, s.subscription_name, s.end_date
//               FROM subscriptions s
//               JOIN users u ON s.user_id = u.id
//               WHERE s.end_date = '$targetDate' AND u.verified = 1";

//     $result = mysqli_query($conn, $query);

//     while ($row = mysqli_fetch_assoc($result)) {
//         $email = $row['email'];
//         $name = $row['name'];
//         $subscription = $row['subscription_name'];
//         $end = $row['end_date'];

//         $subject = "Reminder: '$subscription' subscription expires in $daysBefore day(s)";
//         $message = "Hi $name,\n\nThis is a reminder that your subscription for '$subscription' will expire on $end.\nPlease consider renewing it soon to avoid any interruption.\n\nThanks,\nYour Subscription Tracker";

//         mail($email, $subject, $message);
//     }
// }
?>

<?php
    // require 'database.php';
    // date_default_timezone_set('Asia/Kolkata');

    // $daysBeforeList = [7, 3, 5, 1];
    // $today = date('Y-m-d');

    // foreach ($daysBeforeList as $daysBefore) {
    //     $targetDate = date('Y-m-d', strtotime("+$daysBefore days"));

    //     $query = "SELECT u.email, u.name, s.subscription_name, s.end_date
    //             FROM subscriptions s
    //             JOIN users u ON s.user_id = u.id
    //             WHERE s.end_date = '$targetDate' AND u.verified = 1";

    //     $result = mysqli_query($conn, $query);

    //     if (!$result) {
    //         die("Query failed: " . mysqli_error($conn) . "\nSQL: $query");
    //     }

    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $email = $row['email'];
    //         $name = $row['name'];
    //         $subscription = $row['subscription_name'];
    //         $end = $row['end_date'];

    //         $subject = "Reminder: '$subscription' subscription expires in $daysBefore day(s)";
    //         $message = "Hi $name,\n\nThis is a reminder that your subscription for '$subscription' will expire on $end.\nPlease consider renewing it soon to avoid any interruption.\n\nThanks,\nYour Subscription Tracker";

    //         // echo "Mail to $email\nSubject: $subject\n\n$message\n\n"; // For testing
    //         mail($email, $subject, $message); // Uncomment on live
    //     }
    // }
?>

<?php
    require 'database.php'; 

    date_default_timezone_set('Asia/Kolkata');

    error_reporting(E_ALL);
    ini_set('log_errors', 'On');
    ini_set('error_log', __DIR__ . '/reminder_errors.log');

    $logFile = __DIR__ . '/reminder_log.txt';
    file_put_contents($logFile, "[" . date("Y-m-d H:i:s") . "] Reminder script started.\n", FILE_APPEND);

    $today = date("Y-m-d");
    $reminder_dates = [
        date('Y-m-d', strtotime('+1 day', strtotime($today))),
        date('Y-m-d', strtotime('+3 days', strtotime($today))),
        date('Y-m-d', strtotime('+7 days', strtotime($today)))
    ];

    $sql = "SELECT * FROM subscriptions WHERE end_date IN ('" . implode("','", $reminder_dates) . "')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $sub_name = $row['subscription_name'];
            $end = $row['end_date'];

            $user_q = mysqli_query($conn, "SELECT email FROM users WHERE id = $user_id AND verified = 1");
            if ($user_q && mysqli_num_rows($user_q) == 1) {
                $user = mysqli_fetch_assoc($user_q);
                $email = $user['email'];

                $subject = "Upcoming Subscription end";
                $message = "Hi,\n\nYour subscription for '$sub_name' is expiring on $end.\nDon't forget to renew!\n\n- Subscription Tracker";

                if (mail($email, $subject, $message)) {
                    file_put_contents($logFile, "[" . date("Y-m-d H:i:s") . "] Reminder sent to $email for $sub_name\n", FILE_APPEND);
                } else {
                    file_put_contents($logFile, "[" . date("Y-m-d H:i:s") . "] Failed to send to $email\n", FILE_APPEND);
                }
            }
        }
    } else {
        file_put_contents($logFile, "[" . date("Y-m-d H:i:s") . "] No reminders today.\n", FILE_APPEND);
    }
?>


