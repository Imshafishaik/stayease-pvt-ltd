<?php
session_start(); // Start the session at the beginning of the file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css"/>
    <title>StayEase</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-img">
            <a href="home.php"><img src="../images/homeimages/logo.jpg" alt="StayEase Logo" height="60px"/></a>
        </div>
        <div class="nav-bar-list">
          <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="listing.php">Find Accommodation</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['user_type'] === 'owner'): ?>
                    <li><a href="ownerlisting.php">My Properties</a></li>
                    <li><a href="rentupload.php">Add Property</a></li>
                <?php else: ?>
                    <li><a href="favorites.php">My Favorites</a></li>
                <?php endif; ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
          </ul>
        </div>
    </div>
</body>
</html>