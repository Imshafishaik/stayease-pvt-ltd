<?php 
include "./views/header.php";

require __DIR__ . "/../config/database.php";

$accommodations = $accommodations ?? [];
$totalPages = $totalPages ?? 0;
$page = $page ?? 1;

$search = $_GET['search'] ?? '';
$city   = $_GET['city'] ?? '';
$price  = $_GET['price'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>StayEase | Easy stays for students</title>
  <link rel="stylesheet" href="../css/listing.css">
</head>
<body>
<script>


function bookNow(accommodationId) {
    console.log("......working fine",accommodationId);
    
    fetch('/index.php?action=placeOrder', {
        method: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({ accommodation_id: accommodationId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'login') {
            window.location.href = '/index.php?action=login';
        } else if (data.status === 'docs') {
            alert('Please upload required documents first.'); 
            window.location.href = '/index.php?action=profile';
        } else if (data.status === 'success') {
            alert('Booking request sent to owner.');
        } else {
            alert(data.message);
        }
    });
}
function onClearFilters(){
  window.location.href = "/index.php?action=listing";
}

</script>
<section class="filters">
  <form action="/index.php" method="get">
    <input type="hidden" name="action" value="listing" />

    <input type="text" name="search" placeholder="Search for houses..." />

    <select name="city"> 
      <option value="">Select City  </option> 
      <?php foreach ($locations as $loc): ?> 
        <option value="<?= htmlspecialchars($loc['city']) ?>"><?= htmlspecialchars($loc['city']) ?></option>
       <?php endforeach; ?> </select>

    <select name="price">
        <option value="">Max Price</option>
        <?php foreach ($prices as $price): ?> 
          <option value="<?= htmlspecialchars($price['accommodation_price']) ?>"><?= htmlspecialchars($price['accommodation_price']) ?></option> 
        <?php endforeach; ?>
    </select>

    <button type="submit">Search</button>
    <button type="button" onclick="onClearFilters()">Clear Filters</button>
</form>
 </section>

  <!-- Listings -->
   <div class="main_card">
  <main class="cards">
  <div class="cards">
<?php foreach ($accommodations as $acc): ?>
  <div  class="card">

    <img src="<?= $acc['photo_img'] ?>" alt="Property Image" />

    <div class="card-content">
      <a href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>"><?= htmlspecialchars($acc['accommodation_name']) ?></a>

      <span><?= htmlspecialchars($acc['city']) ?></span>, <span><?= htmlspecialchars($acc['state']) ?></span>,<span><?= htmlspecialchars($acc['country']) ?></span>
      <p><?= htmlspecialchars($acc['accommodation_description']) ?></p>

      <div class="card-footer">
        <span>€<?= number_format($acc['accommodation_price'], 2) ?>/month</span>

        <span class="status">
          <?= $acc['accommodation_available'] ? 'Available Now' : 'Not Available' ?>
        </span>
      </div>

      <div class="card-footer-btns">
       <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'owner'): ?>
          <button href="#">Add to Favourites</button>
        <?php endif; ?>


        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'owner'): ?>
          <button onclick="bookNow(<?= $acc['accommodation_id'] ?>)">
            Book Now
          </button>
        <?php endif; ?>
      </div>
    </div>
</div>
<?php endforeach; ?>
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

   

  
</div>
  

  

</body>
</html>

<?php
include "./views/footer.php";

?>
