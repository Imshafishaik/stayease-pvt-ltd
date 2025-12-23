<?php 
include "./views/header.php";

require __DIR__ . "/../config/database.php";

$accommodations = $accommodations ?? [];
$totalPages = $totalPages ?? [];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>StayEase | Easy stays for students</title>
  <link rel="stylesheet" href="../css/listing.css">
</head>
<body>

  <section class="filters">
    <form action="/index.php" method="get">
    <input type="hidden" name="action" value="listing" />

    <input type="text" name="search" placeholder="Search for houses..." />

    <select name="city">
        <option value="">All Cities</option>
        <option value="Paris">Paris</option>
        <option value="Lyon">Lyon</option>
        <option value="Provence">Provence</option>
    </select>

    <select name="price">
        <option value="">Max Price</option>
        <option value="700">€700</option>
        <option value="900">€900</option>
        <option value="1200">€1200</option>
    </select>

    <button type="submit">Search</button>
    <button type="button" id="clearFilters">Clear Filters</button>
</form>
  </section>

  <!-- Listings -->
   <div class="main_card">
  <main class="cards">
  <div class="cards">
<?php foreach ($accommodations as $acc): ?>
  <a href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>" class="card">

    <img src="<?= $acc['photo_img'] ?>" alt="Property Image" />

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
        <?php if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'House Owner'): ?>
          <button href="#">Add to Favourites</button>
        <?php endif; ?>


        <?php if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'House Owner'): ?>
          <button href="#">Book</button>
        <?php endif; ?>
        
      </div>
    </div>
        </a>
<?php endforeach; ?>
</div>

  </main>
  <?php if ($totalPages > 0): ?>
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?action=listing&page=<?= $page-1 ?>&search=<?= urlencode($search) ?>&city=<?= urlencode($city) ?>&price=<?= urlencode($price) ?>">
            « Prev
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a 
            href="?action=listing&page=<?= $i ?>&search=<?= urlencode($search) ?>&city=<?= urlencode($city) ?>&price=<?= urlencode($price) ?>"
            class="<?= $i == $page ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?action=listing&page=<?= $page+1 ?>&search=<?= urlencode($search) ?>&city=<?= urlencode($city) ?>&price=<?= urlencode($price) ?>">
            Next »
        </a>
    <?php endif; ?>
</div>
<?php endif; ?>

</div>

<script>
document.getElementById("clearFilters").addEventListener("click", function() {
    // Redirect to the listing page without any query params
    window.location.href = "/index.php?action=listing";
});
</script>




</body>
</html>

<?php
include "./views/footer.php"
?>
