<?php
session_start();
include_once 'admin/include/class.user.php';

// Prevent admins from seeing booking confirmations
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: admin.php");
    exit();
}

if(!isset($_SESSION['booking_result'])) {
    header("Location: reservation.php");
    exit();
}

$result = $_SESSION['booking_result'];
unset($_SESSION['booking_result']); // Clear the message after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shared-styles.css" rel="stylesheet">
    <style>
        .confirmation-container {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            color: #fff;
            text-align: center;
        }
        .success-message {
            color: #ffbb2b;
            margin-bottom: 20px;
        }
        .booking-details {
            text-align: left;
            margin: 20px auto;
            max-width: 400px;
        }
        .booking-details p {
            margin: 10px 0;
            padding: 5px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="confirmation-container">
                    <?php
                    if(strpos($result, "Booking Confirmed") !== false) {
                        echo "<h2 class='success-message'>Booking Successful!</h2>";
                        echo "<div class='booking-details'>";
                        $details = explode("\n", $result);
                        foreach($details as $detail) {
                            if(!empty($detail)) {
                                echo "<p>" . htmlspecialchars($detail) . "</p>";
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<h2 class='text-danger'>Booking Failed</h2>";
                        echo "<p>" . htmlspecialchars($result) . "</p>";
                    }
                    ?>
                    <a href="reservation.php" class="btn btn-primary">Back to Reservations</a>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>
