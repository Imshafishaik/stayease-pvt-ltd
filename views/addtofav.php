<?php
require __DIR__ . "/../config/database.php";
include "./views/header.php";
// include "./views/header.php";

$accommodations = $accommodations ?? [];
$totalPages = $totalPages ?? 0;
$page = $page ?? 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/addtofav.css"/>
    <title>Document</title>
</head>
<body>
    <div class="fav_head">
        <h2>My Favourites ❤️</h2>
    </div>
    <section class="listing-container">



<?php if (empty($accommodations)): ?>
    <p>No favourites added yet.</p>
<?php else: ?>

<div class="listing-grid">
<?php foreach ($accommodations as $acc): ?>
  <div class="listing-card">

    <a href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>">
      <img 
        src="<?= htmlspecialchars(
            $acc['photo_img'] 
            ?: 'https://via.placeholder.com/400x250?text=No+Image'
        ) ?>"
        alt="Property Image"
      >
    </a>

    <a class="acc_name"
       href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>">
       <?= htmlspecialchars($acc['accommodation_name']) ?>
    </a>

    <p>
      <?= htmlspecialchars($acc['city']) ?>,
      <?= htmlspecialchars($acc['state']) ?>,
      <?= htmlspecialchars($acc['country']) ?>
    </p>

    <p><?= htmlspecialchars($acc['accommodation_description']) ?></p>

    <div class="card-footer">
      <span>€<?= number_format($acc['accommodation_price'], 2) ?>/month</span>
      <span class="status">
        <?= $acc['accommodation_available'] ? 'Available Now' : 'Not Available' ?>
      </span>
    </div>

  </div>
<?php endforeach; ?>
</div>

<?php endif; ?>
</section>



</body>
</html>