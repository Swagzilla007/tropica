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
            background: rgba(0, 0, 0, 0.9);
            border: none;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }

        .well:hover {
            transform: translateY(-5px);
        }
        
        h4 {
            color: #ffbb2b;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        h6 {
            color: #fff;
            font-family: 'Open Sans', sans-serif;
            font-size: 15px;
            margin: 10px 0;
            font-weight: 400;
        }

        hr {
            border-color: rgba(255,187,43,0.2);
            margin: 15px 0;
        }

        .btn-booking {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border: 1px solid #ffbb2b;
            padding: 10px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
            margin-top: 20px;
        }

        .btn-booking:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: scale(1.05);
        }

        .room-container {
            padding: 20px 0;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Room Image Modal Styles */
        .room-preview {
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .room-preview:hover {
            color: #ffbb2b;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.95);
            border: 1px solid #ffbb2b;
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 187, 43, 0.2);
        }

        .modal-header h4 {
            color: #ffbb2b;
        }

        .modal-body {
            padding: 20px;
        }

        .room-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .room-gallery img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .room-gallery img:hover {
            transform: scale(1.05);
        }

        .close {
            color: #ffbb2b;
            opacity: 1;
        }

        .close:hover {
            color: #fff;
        }

        /* Updated Modal Styles */
        .modal-content {
            background: rgba(0, 0, 0, 0.95);
            border: 1px solid #ffbb2b;
            border-radius: 15px;
        }

        .modal-backdrop {
            opacity: 0.7 !important; /* Reduce darkness of backdrop */
        }

        .room-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .room-gallery img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
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
        
        <div class="room-container">
        <?php
        
        $sql="SELECT * FROM room_category";
        $result = mysqli_query($user->db, $sql);
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
//               ********************************************** Show Room Category***********************
                while($row = mysqli_fetch_array($result)) {
                    // Define room images based on room type
                    $roomImages = [];
                    $roomname = strtolower($row['roomname']); // Convert to lowercase for comparison
                    
                    if(strpos($roomname, 'luxury') !== false) {
                        $roomImages = [
                            'images/home_gallary/1.jpg',
                            'images/home_gallary/2.jpg',
                            'images/home_gallary/3.jpg'
                        ];
                    } 
                    else if(strpos($roomname, 'deluxe') !== false) {
                        $roomImages = [
                            'images/home_gallary/4.jpg',
                            'images/home_gallary/5.jpg',
                            'images/home_gallary/6.jpg'
                        ];
                    }
                    else {
                        // Standard room or default
                        $roomImages = [
                            'images/home_gallary/1.jpg',
                            'images/home_gallary/2.jpg',
                            'images/home_gallary/3.jpg'
                        ];
                    }
                    
                    $roomImagesJson = json_encode($roomImages);
                    
                    echo "
                        <div class='row'>
                            <div class='col-md-3'></div>
                            <div class='col-md-6 well'>
                                <h4 class='room-preview' data-images='".$roomImagesJson."' onclick='showRoomImages(this)'>"
                                    .$row['roomname']." <small>(Click to view photos)</small>
                                </h4><hr>
                                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed.</h6>
                                <h6>Facilities: ".$row['facility']."</h6>
                                <h6>Price: LKR ".$row['price']."/night.</h6>
                            </div>
                            <div class='col-md-3'>
                                <a href='./booknow.php?roomname=".$row['roomname']."'><button class='btn btn-booking'>Book Now</button> </a>
                            </div>   
                        </div>
                    "; //echo end
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

        <!-- Room Images Modal -->
        <div class="modal" id="roomModal" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="room-gallery"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        function showRoomImages(element) {
            const roomName = element.textContent.replace('(Click to view photos)', '').trim();
            const images = JSON.parse(element.getAttribute('data-images'));
            
            let gallery = '';
            images.forEach(img => {
                gallery += `
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <img src="${img}" 
                             alt="${roomName}" 
                             class="img-responsive" 
                             style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                    </div>`;
            });
            
            $('#roomModal .modal-title').text(roomName + ' Photos');
            $('#roomModal .room-gallery').html(gallery);
            
            // Show modal with specific options
            $('#roomModal').modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
        }

        // Cleanup modal on close
        $('#roomModal').on('hidden.bs.modal', function () {
            $(this).find('.room-gallery').html('');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        // Attach click handler to room previews
        $('.room-preview').click(function() {
            showRoomImages(this);
        });

        // Handle back button
        $(window).on('popstate', function() {
            $('#roomModal').modal('hide');
        });
    });
    </script>
</body>
</html>