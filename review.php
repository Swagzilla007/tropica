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
    
    <style>
        .well
        {
            background: rgba(0,0,0,0.5);
            border: none;
        }
		body
		{
			background-image: url('images/home.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
		}
        .social-icon {
            width: 24px;
            height: 24px;
            margin-top: -5px;
        }
        .reviews-container {
            margin: 40px 0;
        }

        .review-card {
            background: rgba(0, 0, 0, 0.9);
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            color: #fff;
            transition: transform 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-5px);
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .reviewer-icon {
            width: 45px;
            height: 45px;
            margin-right: 15px;
            filter: invert(80%) sepia(50%) saturate(500%) hue-rotate(360deg) brightness(100%) contrast(95%);
        }

        .reviewer-name {
            color: #ffbb2b;
            font-size: 18px;
            margin: 0;
        }

        .review-date {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .review-rating {
            color: #ffbb2b;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .review-text {
            line-height: 1.6;
            color: #fff;
        }

        .section-title {
            color: #ffbb2b;
            text-align: center;
            margin: 40px 0;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 2px;
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
                    <li class="active"><a href="review.php">Review</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a></li>
                    <li><a href="http://www.twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a></li>                    
                </ul>
            </div>
        </nav>

        <h2 class="section-title">Customer Reviews</h2>

        <div class="reviews-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="User" class="reviewer-icon">
                            <div>
                                <h4 class="reviewer-name">Sarah Johnson</h4>
                                <div class="review-date">December 15, 2023</div>
                            </div>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">"Absolutely amazing stay! The online booking system was so easy to use. The luxury suite exceeded our expectations with stunning ocean views. Staff was incredibly attentive. Will definitely return!"</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="User" class="reviewer-icon">
                            <div>
                                <h4 class="reviewer-name">Michael Chen</h4>
                                <div class="review-date">December 10, 2023</div>
                            </div>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">"The deluxe room was perfect for our business trip. Great amenities, fast WiFi, and the booking process was seamless. The website made it so easy to check availability and make reservations."</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="User" class="reviewer-icon">
                            <div>
                                <h4 class="reviewer-name">Emily Rodriguez</h4>
                                <div class="review-date">December 5, 2023</div>
                            </div>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">"We loved everything about our stay! The room was immaculate, the service exceptional, and the online booking system was user-friendly. The website's photos perfectly represented the actual rooms."</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077090.png" alt="User" class="reviewer-icon">
                            <div>
                                <h4 class="reviewer-name">James Wilson</h4>
                                <div class="review-date">November 28, 2023</div>
                            </div>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">"The hotel's website made booking a breeze. Real-time availability and instant confirmation gave us peace of mind. The standard room was comfortable and well-maintained. Great value for money!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>