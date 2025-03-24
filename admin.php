<?php session_start();
include_once 'admin/include/class.user.php';
$user=new User();
$uid=$_SESSION[ 'uid']; 
if(!$user->get_session()) 
{ 
    header("location:admin/login.php"); 
} 
if(isset($_GET['q'])) 
{ 
    $user->user_logout();
 header("location:index.php"); 
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shared-styles.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

    <style>
        body {
            background-image: url('images/home.jpg'); /* Fixed path */
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
        }

        h4 {
            color: #ffbb2b;
            margin-bottom: 20px;
        }

        hr {
            border-color: rgba(255, 187, 43, 0.2);
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            margin: 10px 0;
        }

        ul li a {
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        ul li a:hover {
            color: #ffbb2b;
            text-decoration: none;
            padding-left: 5px;
        }

        .admin-header {
            color: #ffbb2b;
            text-align: center;
            margin: 30px 0;
            font-size: 32px;
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
                    <li class="active"><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn-logout">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Room Category</h4>
                <hr>
                <ul>
                    <li><a href="admin/addroom.php">Add Room Category</a></li>
                    <li><a href="show_room_cat.php">Show All Room Category</a></li>
                    <li><a href="show_room_cat.php">Edit Room Category</a></li>
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Bookings</h4>
                <hr>
                <ul>
                    <li><a href="room.php">Book Now</a></li>
                    <li><a href="show_all_room.php">Show All Booked Rooms</a></li>
                    <li><a href="show_all_room.php">Edit Booked Room</a></li>
                </ul>
            </div>
           <div class="col-md-3"></div>
        </div>
        
        
        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Add Manager</h4>
                <hr>
                <ul>
                    <li><a href="admin/registration.php">Add Manager</a></li>
 
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>









    </div>










    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>