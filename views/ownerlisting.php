<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayEase – Sunny Villa</title>
    <link rel="stylesheet" href="../css/ownerlisting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <!-- <div class="logo">StayEase</div> -->
            <!-- <div class="search-box">
                <input type="text" placeholder="Search houses, amenities, and owners">
                <i class="fa fa-search"></i>
            </div> -->
        </div>

        <div class="nav-right">
            <a href="#" class="active">Overview</a>
            <a href="#">Rent</a>
            <a href="#">Listings</a>
            <a href="#">Activity</a>
            <button class="upload-btn">Upload</button>
            <div class="profile-pic"></div>
        </div>
    </nav>

    <!-- HEADER IMAGE -->
     <div class="header_owner_listing">
    <header class="header-img">
        <img class="backgound-imgs" src="../images/homeimages/image3.png" alt="header">
        <div class="profile-wrapper">
            <img class="backgound-img" src="../images/homeimages/image3.png" class="profile-avatar" alt="avatar">
            <h2>Sunny Villa</h2>
            <p>Barcelona, Spain</p>
            <span class="count">1200 Houses</span>
        </div>
    </header>
    </div>
    <!-- LISTINGS SECTION -->
    <section class="listing-container">

        <!-- Card 1 -->
        <div class="listing-card">
            <div class="image-wrapper">
                <img src="../images/homeimages/image2.avif" alt="">
                <button class="edit-btn">Edit</button>
            </div>
            <div class="listing-info">
                <h4>Charming Paris Room no 1</h4>
                <p>Located in the heart of Paris, this cozy apartment offers a unique blend of comfort and convenience.</p>
                <div class="details-row">
                    <span>€ 1500</span>
                    <span>Favourite: Yes</span>
                    <span>Available: Yes</span>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="listing-card">
            <div class="image-wrapper">
                <img src="../images/homeimages/image3.png" alt="">
            </div>
            <div class="listing-info">
                <h4>Cozy Cottage</h4>
                <p>Located in the heart of Paris, this cozy apartment offers a unique blend of comfort and convenience.</p>
                <div class="details-row">
                    <span>€ 950</span>
                    <span>Favourite: Yes</span>
                    <span>Available: Yes</span>
                </div>
            </div>
        </div>

    </section>

    <div class="load-more">
        <button>Load more</button>
    </div>

</body>
</html>