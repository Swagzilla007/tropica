<?php
session_start();
include_once 'admin/include/class.user.php'; 
$user=new User();

// Prevent admins from booking
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: admin.php");
    exit();
}

$roomname=$_GET['roomname'];

if(isset($_REQUEST['submit'])) 
{ 
    extract($_REQUEST);
    $result = $user->booknow($checkin, $checkout, $name, $phone, $roomname);
    
    // Store booking result in session
    $_SESSION['booking_result'] = $result;
    
    // Redirect to prevent form resubmission
    header("Location: booking_confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Now - Tropica Hotel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shared-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        body {
            background-image: url('images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .booking-container {
            background: rgba(0, 0, 0, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            transform: translateZ(0);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 187, 43, 0.1);
        }

        .booking-title {
            color: #ffbb2b;
            font-size: 28px;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            font-weight: 300;
            letter-spacing: 2px;
        }

        .form-group label {
            color: #ffbb2b;
            font-weight: 400;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 8px;
            color: #fff;
            height: 45px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffbb2b;
            box-shadow: 0 0 8px rgba(255, 187, 43, 0.2);
        }

        .datepicker {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 8px;
            color: #fff;
            padding: 10px 15px;
            width: 100%;
            margin-bottom: 20px;
        }

        .btn-book {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .btn-book:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 187, 43, 0.3);
        }

        .selected-room {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 187, 43, 0.1);
            border-radius: 8px;
        }

        .selected-room h4 {
            color: #ffbb2b;
            margin: 0;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img class="img-responsive" src="images/reserve.webp" style="width:100%; height:auto; max-height:250px; object-fit:cover; border-radius: 0 0 15px 15px;">
        
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="room.php">Room &amp; Facilities</a></li>
                    <li><a href="reservation.php">Online Reservation</a></li>
                    <li><a href="review.php">Review</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a></li>
                    <li><a href="http://www.twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a></li>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="booking-container">
                    <h2 class="booking-title">Complete Your Booking</h2>
                    
                    <div class="selected-room">
                        <h4>Selected Room: <?php echo $roomname; ?></h4>
                    </div>

                    <form action="" method="post" name="room_category">
                        <div class="form-group">
                            <label for="checkin">Check In Date</label>
                            <input type="text" class="datepicker" name="checkin" required>
                        </div>

                        <div class="form-group">
                            <label for="checkout">Check Out Date</label>
                            <input type="text" class="datepicker" name="checkout" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>

                        <button type="submit" class="btn btn-book" name="submit">Confirm Booking</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: new Date(),
                defaultDate: new Date(),
                changeMonth: true,
                changeYear: true,
                onSelect: function(selectedDate) {
                    // When checkin date is selected, set minimum date for checkout
                    if(this.name == "checkin") {
                        var checkoutDate = $("input[name='checkout']");
                        var minDate = new Date(selectedDate);
                        minDate.setDate(minDate.getDate() + 1);
                        checkoutDate.datepicker("option", "minDate", minDate);
                    }
                }
            });

            // Pre-fill dates if passed in URL
            var urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('checkin')) {
                $("input[name='checkin']").datepicker('setDate', urlParams.get('checkin'));
            }
            if(urlParams.has('checkout')) {
                $("input[name='checkout']").datepicker('setDate', urlParams.get('checkout'));
            }
        });
    </script>
</body>
</html>