<?php
require __DIR__ . "/../config/database.php";

$action = $_GET['action'] ?? 'index';

include "./views/header.php";

$stmt = $pdo->query("SELECT * FROM accommodation");
$accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    

    <?php foreach ($accommodations as $acc): ?>
    <div class="card">

    <img src="../images/homeimages/image2.avif" />

    <div class="card-content">
      <h3><?= htmlspecialchars($acc['accommodation_name']) ?></h3>

      <p><?= htmlspecialchars($acc['accommodation_description']) ?></p>

      <div class="card-footer">
        <span>€<?= number_format($acc['accommodation_price'], 2) ?>/month</span>

        <span class="status">
          <?= $acc['accommodation_available'] ? 'Available Now' : 'Not Available' ?>
        </span>
      </div>

      <div class="card-footer-btns">
        <a href="#">Add to Favourites</a>
        <a href="#">Book</a>
      </div>
    </div>
      </div>
          <?php endforeach; ?>
        </div>
        <h2 class="head-in-container">Are you a house owner?</h2>
      <div class="owner">
        <div class="owner-container">
            <p>Reach your prperty with us and reach thousands of international students looking for accomodation.</p>
            <a href="/views/rentupload.php?action=rentupload">list your property</a>
        </div>
      </div>
         <h2 class="head-in-container">Faqs?</h2>
      <div class="owner">
        <div class="owner-container">
            <p>Ask your question or answers.</p>
            <a href="/index.php?action=faqs">Faqs</a>
        </div>
      </div>
    </div>
</body>
</html>



<?php
include ($action == 'home' ? "./footer.php" : "./views/footer.php");
?>