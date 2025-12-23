<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";

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
            <a href="adminprofile.php?action=adminprofile">Listings</a>
            <a href="#">Activity</a>
            <a href="/index.php?action=rentupload" class="upload-btn">Upload</a>
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
<?php if (empty($accommodations)): ?>
    <p>No accommodations found.</p>
<?php else: ?>
    <?php foreach ($accommodations as $acc): ?>
        <div class="card">
            <img src='<?= htmlspecialchars($acc['photo_img'] ?? '../images/homeimages/images.jpeg') ?>' />
<!-- /<?= htmlspecialchars($acc['photo_img'] ?? '../images/homeimages/images.jpeg') ?> -->
            <div class="card-content">
                <h3><?= htmlspecialchars($acc['accommodation_name']) ?></h3>
                <p><?= htmlspecialchars($acc['accommodation_description']) ?></p>

                <div class="card-footer">
                    <span>€<?= number_format($acc['accommodation_price'], 2) ?>/month</span>
                    <span class="status">
                        <?= $acc['accommodation_available'] ? 'Available' : 'Unavailable' ?>
                    </span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

        
    </section>

    <div class="load-more">
        <button>Load more</button>
    </div>

</body>
</html>

<?php
include "./views/header.php";
?>