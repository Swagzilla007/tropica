<?php
    include_once 'admin/include/class.user.php'; 
    $user=new User(); 

    // Redirect admins away from booking
    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
        header("Location: admin.php");
        exit();
    }

    if(isset($_REQUEST[ 'submit'])) 
    { 
        extract($_REQUEST); 
        $result=$user->check_available($checkin, $checkout);
        if(!($result))
        {
            echo $result;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shared-styles.css" rel="stylesheet">
    
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat : 'yy-mm-dd',
        minDate: new Date(), // Prevent selecting past dates
        defaultDate: new Date(), // Set today as default
        changeMonth: true,
        changeYear: true
    });
  } );
  </script>
    
    
    <style>
        body {
            background-image: url('images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .well {
            background: rgba(0, 0, 0, 0.9);
            border: none;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            height: auto;
        }
        
        .availability-form {
            margin-bottom: 30px;
        }
        
        .form-group label {
            color: #fff;  /* Make field labels white */
        }
        
        .datepicker {
            background: rgba(0, 0, 0, 0.7);  /* Darker background */
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 8px;
            color: #fff !important;  /* White text for input value */
            padding: 10px 15px;
            width: 100%;
            margin-bottom: 15px;
        }
        
        /* Hide datepicker button backgrounds */
        .ui-datepicker-trigger {
            background: transparent;
            border: none;
        }
        
        /* Update calendar popup styles */
        .ui-datepicker {
            background: rgba(0, 0, 0, 0.9) !important;
            color: #fff !important;
        }
        
        .ui-datepicker th {
            color: #ffbb2b !important;  /* Column headers in gold */
        }
        
        .ui-datepicker td {
            background: transparent !important;
        }
        
        .ui-datepicker td a {
            background: transparent !important;
            color: #fff !important;
        }
        
        .ui-datepicker td a:hover {
            background: rgba(255, 187, 43, 0.2) !important;
        }
        
        /* Style the datepicker placeholder text */
        .datepicker::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .btn-check {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            padding: 10px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
        }
        
        .btn-check:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: scale(1.05);
        }
        
        .btn-booking {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            padding: 10px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
            width: 100%;
        }
        
        .btn-booking:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: scale(1.05);
        }

        .available-rooms {
            margin-top: 30px;
        }
        
        .room-item {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 187, 43, 0.1);
        }
        
        h4 {
            color: #ffbb2b;
            font-size: 22px;
            margin-bottom: 15px;
        }
        
        h6 {
            color: #fff;
            font-size: 14px;
            margin: 8px 0;
        }

        .no-rooms-message {
            color: #ffbb2b;
            text-align: center;
            padding: 20px;
            font-size: 18px;
        }

        .availability-section {
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .results-section {
            margin-top: 40px;
        }
    </style>
    
    
</head>

<body>
    <div class="container">
      
      
       <img class="img-responsive" src="images/banner.webp" style="width:100%; height:auto; max-height:250px; object-fit:cover;">      
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="room.php">Room &amp; Facilities</a></li>
                    <li class="active"><a href="reservation.php">Online Reservation</a></li>

                   <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a></li>
                    <li><a href="http://www.twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a></li>                    
                </ul>
            </div>
        </nav>
        
        <div class="availability-section">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 well">
                    <h4>Check Room Availability</h4>
                    <form action="" method="post" class="availability-form">
                        <div class="form-group">
                            <label for="checkin">Check In Date:</label>
                            <input type="text" class="datepicker" name="checkin" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="checkout">Check Out Date:</label>
                            <input type="text" class="datepicker" name="checkout" required>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-check" name="submit">Check Availability</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="results-section">
            <?php   
            if(isset($_REQUEST['submit']))
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    // Add date range display
                    echo "<div class='text-center' style='color: #ffbb2b; margin-bottom: 20px;'>
                            <h4>Available Rooms for: ".htmlspecialchars($checkin)." to ".htmlspecialchars($checkout)."</h4>
                          </div>";
                    
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "
                            <div class='row'>
                            <div class='col-md-4'></div>
                            <div class='col-md-5 well'>
                                <h4>".$row['roomname']."</h4><hr>
                                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed.</h6>
                                <h6>Available Rooms: <span style='color: #ffbb2b'>".$row['available_rooms']."</span> out of ".$row['total_rooms']."</h6>
                                <h6>Facilities: ".$row['facility']."</h6>
                                <h6>Price: ".$row['price']." tk/night.</h6>
                            </div>
                            <div class='col-md-3'>
                                <a href='./booknow.php?roomname=".$row['roomname']."&checkin=".$checkin."&checkout=".$checkout."'>
                                    <button class='btn btn-booking'>Book Now</button>
                                </a>
                            </div>   
                            </div>";
                    }
                }
                else
                {
                    echo "<div class='alert alert-warning text-center'>
                            <h4>No rooms available for the selected dates.</h4>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>

</html>