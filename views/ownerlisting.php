<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";

$accommodations = $accommodations ?? [];
$totalPages = $totalPages ?? 0;
$page = $page ?? 1;
    
$owner_info = $owner_info ?? [];
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
            <a href="/index.php?action=rentupload" class="upload-btn">Upload</a>
            <a href="/index.php?action=ownerdashboard" class="upload-btn">My Dashboard</a>
        </div>
    </nav>

    <!-- HEADER IMAGE -->
     <div class="header_owner_listing">
    <header class="header-img">
        <img class="backgound-imgs" src="../images/homeimages/image3.png" alt="header">
        <div class="profile-wrapper">
            <img class="backgound-img" src="../images/homeimages/image3.png" class="profile-avatar" alt="avatar">
            <h2><?= htmlspecialchars($owner_info['user_name']) ?></h2>
            <span class="count"><?= $owner_info['house_count'] ?> Houses</span>
        </div>
    </header>
    </div>
    <!-- LISTINGS SECTION -->
    <section class="listing-container">
<?php if (empty($accommodations)): ?>
    <p>No accommodations found.</p>
<?php else: ?>
    <div class="listing-grid">
<?php foreach ($accommodations as $acc): ?>
  <div class="listing-card"> 
    <a href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>">
    <img src="<?= htmlspecialchars((!empty($acc['photo_img'] ?? '')) ? $acc['photo_img'] : 'https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=') ?>" alt="Property Image" />
    </a>
    <a class="acc_name" href="/index.php?action=accomodation_detail&id=<?= $acc['accommodation_id'] ?>"><?= htmlspecialchars($acc['accommodation_name']) ?></a>

    <p>
      <?= htmlspecialchars($acc['city']) ?>, <?= htmlspecialchars($acc['state']) ?>, <?= htmlspecialchars($acc['country']) ?>
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

    <!-- <div class="load-more">
        <button>Load more</button>
    </div> -->

    <?php if ($totalPages > 1): ?>
  <div class="pagination">

    <?php if ($page > 1): ?>
      <a href="/index.php?action=owner&page=<?= $page-1 ?>">« Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="/index.php?action=owner&page=<?= $i ?>"
         class="<?= $i === $page ? 'active' : '' ?>">
        <?= $i ?>
      </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
      <a href="/index.php?action=owner&page=<?= $page+1 ?>">Next »</a>
    <?php endif; ?>

  </div>
<?php endif; ?>


</body>

</body>
</html>

<?php
include "./views/footer.php"
?>