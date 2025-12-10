<?php
require __DIR__ . "/../config/database.php";

include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/home.css"/>
</head>
<body>
    <div>
     <!-- <div class="Head-logo">
        <div class="empty-1"height="200px" width="350px"></div>
        <div class="empty-2"height="200px" width="350px"></div>
        <div class="Head-logo-img">
            <img src="/img/logo.jpg" height="100px" width="220px"/>
        </div>
      </div> -->
      <!-- <div class="nav-bar">
        <div class="nav-bar-img">
            <img src="../images/homeimages/logo.jpg" height="60px"/>
        </div>
        <div class="nav-bar-list">
          <ul>
            <li><a href="http://127.0.0.1:5500/hello.html">Home</a></li>
            <li><a href="Home" target="_blank">Find Accomodation</a></li>
            <li><a href="Home"target="_blank">For Owners</a></li>
            <li><a href="Home"target="_blank">Contact us</a></li>
            <li><a href="../auth/login.php"target="_blank">Login</a></li>
         </ul>
        </div>
      </div> -->
      <div class="container">
        <div class="container-interface">
          <div class="container-interface-img">
            <img src="/../images/homeimages/Eiffel-Tower-Sunset.jpg.webp" height="420px" width="95%">
          </div>
        </div>
        
        <h2 class="head-in-container">Find your perfect stay</h2>
        <div class="container-search">
          <input type="text" class="search" placeholder="Enter place...">
          <button class="container-search-button">Search</button>
        </div>
        <h2 class="head-in-container">Top listings</h2>
        <div class="card-container">
            <div class="card-container-1">
                <img src="/../images/homeimages/images.jpeg" height="170px" width="300px"/>
                <p>Charming Studio in paris<br>£900/month</p>
            </div>
            <div class="card-container-1">
                <img src="/../images/homeimages/image2.avif" height="170px" width="300px"/>
                <p>Cozy Appartment near university<br>£750/month</p>
            </div>
            <div class="card-container-1">
                <img src="/../images/homeimages/image3.png" height="170px" width="300px"/>
                <p>Spacious flat in central paris<br>£1200/month</p>
            </div>
        </div>
        <h2 class="head-in-container">Are you a house owner?</h2>
      <div class="owner">
        <div class="owner-container">
            <p>Reach your prperty with us and reach thousands of international students looking for accomodation.</p>
            <button>list your property</button>
        </div>
      </div>
      <div class="contact"></div>
         <div class="contact-info">
            <div class="contact-info-content-1">
                <h3 style="color: white;">Accomodate me</h4>
                <p style="color: white;">Connecting with their perfect home in france</p>
                <ul style="color: white;">
                    <li>Home</li>
                    <li>Find accomodation </li>
                    <li>For owners</li>
                    <li>Contact us</li>
                </ul>
            </div>
            <div class="contact-info-empty"></div>
            <div class="contact-info-empty"></div>
            <div class="contact-info-content-2">
                <ul>
                    <li><img src="/../images/homeimages/facebook-logo-free-png.webp" height="50px"/></li>
                    <li><img src="/../images/homeimages/instagram-logo-black-and-white-transparent-background-free-png.webp"height="50px"/></li>
                    <li><img src="/../images/homeimages/twitter-circle-black-logo-icon-twitter-app-transparent-background-premium-social-media-design-for-digital-download-free-png.webp"height="50px"/></li>
                </ul>
                <h3 style="color: white;">Contact us</h3>
                <p style="color: white;">Email:info@accomodate.com</p>
                <p style="color: white;">Phone: +33 123 456 789</p>
            </div>
         </div>
       </div>
    </div>
</body>
</html>


