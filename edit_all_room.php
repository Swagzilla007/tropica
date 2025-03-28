<?php
    include_once 'admin/include/class.user.php'; 
    $user=new User(); 

    $id=$_GET['id'];
    $sql="SELECT * FROM rooms WHERE room_id='$id'";
    $query=mysqli_query($user->db, $sql);
    $row = mysqli_fetch_array($query);

    $message = '';
    
    if(isset($_REQUEST['submit'])) 
    { 
        extract($_REQUEST); 
        $result = $user->edit_all_room($checkin, $checkout, $name, $phone, $id);
        
        // Store message in variable for display
        $message = "<div class='alert " . 
                   (strpos($result, 'Successfully') !== false ? 'alert-success' : 'alert-danger') . 
                   " text-center' style='margin-top: 20px;'>" . 
                   htmlspecialchars($result) . "</div>";
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
  <link rel="stylesheet" href="admin/css/reg.css" type="text/css">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
                  dateFormat : 'yy-mm-dd'
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
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        h2 {
            color: #ffbb2b;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            color: #ffbb2b;
            font-weight: normal;
        }

        .form-control, .datepicker {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 8px;
            color: #fff;
        }

        .btn-primary {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 1px solid #ffbb2b;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #ffbb2b;
            color: #000;
        }

        #click_here a {
            color: #ffbb2b;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="well">
            <h2>Edit Booking Details</h2>
            <h2><?php echo $row['room_cat']?></h2>
            <hr>
            <?php if($message) echo $message; ?>
            <form action="" method="post" name="room_category">
               <div class="form-group">
                    <label for="checkin">Check In :</label>&nbsp;&nbsp;&nbsp;
                    <input type="text" class="datepicker" name="checkin" value="<?php echo $row['checkin']?>">

                </div>
               
               <div class="form-group">
                    <label for="checkout">Check Out:</label>&nbsp;
                    <input type="text" class="datepicker" name="checkout" value="<?php echo $row['checkout']?>">
                </div>
                <div class="form-group">
                    <label for="name">Enter Your Full Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Enter Your Phone Number:</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']?>" required>
                </div>
                 
                <button type="submit" class="btn btn-lg btn-primary button" name="submit">Update</button>

               <br>
                <div id="click_here">
                    <a href="admin.php">Back to Admin Panel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>

</html>