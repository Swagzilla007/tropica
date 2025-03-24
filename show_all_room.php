<?php
include_once 'admin/include/class.user.php'; 
$user=new User();


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
    
    <style>
        body {
            background-image: url('images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }
        .well {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            height: 200px;
        }
        
        h4 {
            color: #ffbb2b;
        }
        
        h6 {
            color: navajowhite;
            font-family: monospace;
        }

        .booking-card {
            background: rgba(0, 0, 0, 0.9);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 187, 43, 0.1);
        }

        .booking-title {
            color: #ffbb2b;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .booking-details {
            color: #fff;
            margin: 8px 0;
        }

        .booking-status {
            color: #ffbb2b;
            font-weight: bold;
        }

        .btn-manage {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            padding: 8px 20px;
            margin-top: 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-manage:hover {
            background-color: #ffbb2b;
            color: #000;
        }

        .btn-logout {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: translateY(-2px);
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
                    <li><a href="reservation.php">Online Reservation</a></li>
                    <li><a href="review.php">Review</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn-logout">Logout</button>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a></li>
                    <li><a href="http://www.twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a></li>                    
                </ul>
            </div>
        </nav>
        
        
        
        <?php
        
        $sql="SELECT * FROM rooms WHERE book='true'";
        $result = mysqli_query($user->db, $sql);
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
//               ********************************************** Show Room Category***********************
                while($row = mysqli_fetch_array($result))
                {
                    
                    echo "
                            <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-6 booking-card'>
                                <h4 class='booking-title'>".$row['room_cat']."</h4><hr>
                                <h6 class='booking-details'>Checkin: ".$row['checkin']." and checkout: ".$row['checkout']."</h6>
                                <h6 class='booking-details'>Name: ".$row['name']."</h6>
                                <h6 class='booking-details'>Phone: ".$row['phone']."</h6>
                                <h6 class='booking-status'>Booking Condition: ".$row['book']."</h6>
                            </div>
                            &nbsp;&nbsp;
                            <a href='edit_all_room.php?id=".$row['room_id']."'><button class='btn btn-primary btn-manage'>Edit</button></a>
                            </div>
                            
                    
                    
                         ";
                    
                    
                }
                
                
                          
            }
            else
            {
                echo "NO Data Exist";
            }
        }
        else
        {
            echo "Cannot connect to server".$result;
        }
        
        
        
        
        
        ?>


    </div>
    
    
    
    
    





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>