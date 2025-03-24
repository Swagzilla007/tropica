<?php
session_start();
$showWelcome = !isset($_SESSION['welcomed']);
if (!isset($_SESSION['welcomed'])) {
    $_SESSION['welcomed'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tropica Hotel - Luxury Beach Resort in Chilaw</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shared-styles.css" rel="stylesheet">
    <link href="css/transitions.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    
    <style>
        body {
            background-image: url('images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }
        
        .jumbotron {
            background-color: transparent;
            color: #fff;
            padding: 0;
            margin: 0 auto;
            position: relative;
            height: 400px;
            width: 80%;
            overflow: hidden;
            opacity: 1;
        }
        
        .slider-overlay {
            background: rgba(0,0,0,0.4);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .mySlides {
            height: 400px;
            width: 100%;
            object-fit: cover;
            display: none;
        }

        .mySlides:first-child {
            display: block;
        }

        .w3-content {
            position: relative;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            padding: 40px 0;
            color: #ffbb2b;
        }
        
        .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 30px;
            color: #ffbb2b;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .about-section {
            background: rgba(0,0,0,0.8);
            padding: 60px 0;
            color: #fff;
            perspective: 1000px;
        }

        .about-container {
            background: rgba(0, 0, 0, 0.9);
            border-radius: 20px;
            padding: 40px;
            transform-style: preserve-3d;
            transform: rotateX(5deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4),
                        0 0 20px rgba(255,187,43,0.1);
            border: 1px solid rgba(255,187,43,0.1);
            transition: transform 0.3s ease;
        }

        .about-container:hover {
            transform: rotateX(0deg);
        }
        
        .about-content {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
            transform: translateZ(30px);
            color: #fff;
        }
        
        .footer {
            background: rgba(0,0,0,0.9);
            padding: 40px 0;
            color: #fff;
        }
        
        .footer-title {
            color: #ffbb2b;
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        .contact-info {
            list-style: none;
            padding: 0;
        }
        
        .contact-info li {
            margin-bottom: 10px;
        }
        
        .social-icon {
            width: 24px;
            height: 24px;
            margin-top: -5px;
            transition: transform 0.3s;
        }
        
        .social-icon:hover {
            transform: scale(1.2);
        }

        .banner-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(0,0,0,0.85);
        }

        .banner-content {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 0;
        }

        .banner-logo {
            height: 150px;
            width: auto;
            object-fit: contain;
        }

        .main-content {
            margin-top: 180px;
            opacity: 1; /* Changed from 0 to show content immediately */
        }

        /* Remove these unused classes */
        .main-content.visible {
            opacity: 1;
        }

        .scroll-visible {
            opacity: 1 !important;
        }

        /* Simplify welcome overlay transition */
        .welcome-overlay {
            position: fixed;
            top: 180px; /* Position below the logo */
            left: 0;
            width: 100%;
            height: calc(100% - 180px);
            background: rgba(0,0,0,0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999; /* Below the banner */
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .welcome-message {
            text-align: center;
            color: #ffbb2b;
            transform: translateY(-90px); /* Adjust vertical position */
        }

        .welcome-message h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .welcome-message p {
            font-size: 24px;
            color: #fff;
            font-weight: 300;
        }
    </style>
</head>

<body>
    <!-- Banner Section with Logo - Always visible -->
    <div class="banner-container">
        <div class="banner-content">
            <img src="images/logo.webp" alt="Tropica Hotel" class="banner-logo">
        </div>
    </div>

    <!-- Welcome message - Only shown on first visit -->
    <?php if ($showWelcome): ?>
    <div class="welcome-overlay">
        <div class="welcome-message">
            <h1>Welcome to Tropica</h1>
            <p>Your Luxury Beach Retreat</p>
        </div>
    </div>
    <?php endif; ?>

    <div class="main-content" <?php if (!$showWelcome) echo 'style="opacity: 1;"'; ?>>
        <div class="container-fluid p-0">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="room.php">Room &amp; Facilities</a></li>
                        <li><a href="reservation.php">Online Reservation</a></li>
                        <li><a href="admin.php">Admin</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://www.facebook.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a></li>
                        <li><a href="http://www.twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a></li>                    
                    </ul>
                </div>
            </nav>

            <!-- Updated Hero Slider -->
            <div class="jumbotron">
                <div class="slider-overlay"></div>
                <div class="w3-content">
                    <img class="mySlides" src="images/home_gallary/1.jpg">
                    <img class="mySlides" src="images/home_gallary/2.jpg">
                    <img class="mySlides" src="images/home_gallary/3.jpg">
                    <img class="mySlides" src="images/home_gallary/4.jpg">
                    <img class="mySlides" src="images/home_gallary/5.jpg">
                    <img class="mySlides" src="images/home_gallary/6.jpg">
                </div>    
            </div>

            <!-- About Section -->
            <section class="about-section">
                <div class="container">
                    <div class="about-container">
                        <div class="section-title">
                            <h2>Welcome to Tropica Hotel</h2>
                        </div>
                        <div class="about-content">
                            <p>Welcome to Tropica Hotel, a luxurious beachfront retreat located in the coastal paradise of Chilaw, Sri Lanka. Our hotel offers a perfect blend of modern comfort and tropical serenity, making it an ideal destination for both leisure and business travelers.</p>
                            <p>Nestled along the pristine beaches of Chilaw, Tropica Hotel provides guests with breathtaking views of the Indian Ocean. Our location offers easy access to local attractions, including the historic Munneswaram Temple and the vibrant Chilaw fish market.</p>
                            <p>At Tropica Hotel, we pride ourselves on delivering exceptional hospitality with a touch of Sri Lankan warmth. Whether you're seeking a romantic getaway, a family vacation, or a business conference venue, our dedicated staff ensures your stay is memorable and comfortable.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="footer-title">Contact Us</h3>
                            <ul class="contact-info">
                                <li><i class="glyphicon glyphicon-map-marker"></i> Tropica Hotel, Chilaw, Sri Lanka</li>
                                <li><i class="glyphicon glyphicon-envelope"></i> info@tropicahotel.com</li>
                                <li><i class="glyphicon glyphicon-phone"></i> +94 123 456 789</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footer-title">Quick Links</h3>
                            <ul class="contact-info">
                                <li><a href="room.php">Rooms & Suites</a></li>
                                <li><a href="reservation.php">Book Now</a></li>
                                <li><a href="review.php">Guest Reviews</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footer-title">Connect With Us</h3>
                            <div class="social-links">
                                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="social-icon"></a>
                                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="social-icon"></a>
                                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" class="social-icon"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="my_js/slide.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/transitions.js"></script>
</body>
</html>