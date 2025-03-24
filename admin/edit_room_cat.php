<?php
include_once 'include/class.user.php'; 
$user=new User(); 

$room_cat=$_GET['roomname'];

$sql="SELECT * FROM room_category WHERE roomname='$room_cat'";
$query=mysqli_query($user->db, $sql);
$row = mysqli_fetch_array($query);
 

if(isset($_REQUEST[ 'submit'])) 
{ 
    extract($_REQUEST); 
    $result=$user->edit_room_cat($roomname, $room_qnty, $no_bed, $bedtype,$facility,$price,$room_cat);
    if($result)
    {
        echo "<script type='text/javascript'>
              alert('".$result."');
         </script>";
    }

   
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reg.css" type="text/css">
    <style>
        body {
            background-image: url('../images/home.jpg');
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
        }

        .form-control, select, textarea {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 187, 43, 0.2);
            color: #fff;
            border-radius: 8px;
        }

        select {
            background: rgba(0, 0, 0, 0.8);
            padding: 5px 10px;
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
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="well">
            <h2>Add Room Category</h2>
            <hr>
            <form action="" method="post" name="room_category">
                <div class="form-group">
                    <label for="roomname">Room Type Name:</label>
                    <input type="text" class="form-control" name="roomname" value="<?php echo $row['roomname'] ?>" required>
                </div>
                 <div class="form-group">
                    <label for="qty">No of Rooms:</label>&nbsp;
                    <select name="room_qnty">
                    <option value="<?php echo $row['room_qnty'] ?>"><?php echo $row['room_qnty'] ?></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                       <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bed">No of Bed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="no_bed">
                     <option value="<?php echo $row['no_bed'] ?>"><?php echo $row['no_bed'] ?></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bedtype">Bed Type:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <select name="bedtype">
                     <option value="<?php echo $row['bedtype'] ?>"><?php echo $row['bedtype'] ?></option>
                      <option value="single">single</option>
                      <option value="double">double</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Facility">Facility</label>
                    <textarea class="form-control" rows="5" name="facility"><?php echo $row['facility'] ?></textarea>
                </div>
               <div class="form-group">
                    <label for="price">Price Per Night:</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" required>
                </div>
                <button type="submit" class="btn btn-lg btn-primary button" name="submit">Update</button>

               <br>
                <div id="click_here">
                    <a href="../admin.php">Back to Admin Panel</a>
                </div>


            </form>
        </div>
    </div>

</body>

</html>