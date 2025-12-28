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
    

   <div class="listing-grid">
<?php foreach ($topListings as $item): ?>
    <div class="listing-card">
        <img src="<?= htmlspecialchars($item['photo_img']) ?>" alt="Property">

        <h3><?= htmlspecialchars($item['accommodation_name']) ?></h3>

        <p>€<?= htmlspecialchars($item['accommodation_price']) ?> / month</p>

        <p>
            ⭐ <?= number_format($item['avg_rating'], 1) ?>
            (<?= $item['total_reviews'] ?> reviews)
        </p>

        <a href="/index.php?action=details&id=<?= $item['accommodation_id'] ?>">
            View Details
        </a>
    </div>
<?php endforeach; ?>
</div>
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