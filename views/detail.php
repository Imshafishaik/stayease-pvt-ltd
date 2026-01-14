<?php 
include "./views/header.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/detail.css"/>
</head>
<body>
    <div class="detail-container">

  <!-- IMAGE CAROUSEL -->
  <div class="carousel">
    <?php foreach ($images as $index => $img): ?>
      <img src="<?= $img ?>" class="carousel-img <?= $index === 0 ? 'active' : '' ?>">
    <?php endforeach; ?>
    <button class="prev">‹</button>
    <button class="next">›</button>
  </div>

  <!-- BASIC INFO -->
  <h1><?= htmlspecialchars($accommodation['accommodation_name']) ?></h1>
  <p><?= htmlspecialchars($accommodation['accommodation_description']) ?></p>

  

  <!-- REVIEWS -->
  <section class="reviews">
    <h2>Reviews</h2>
    <?php if (empty($reviews)): ?>
      <p>No reviews yet.</p>
    <?php else: ?>
      <?php foreach ($reviews as $review): ?>
        <div class="review">
          <!-- <strong><?= htmlspecialchars($review['name']) ?></strong> -->
          <span><?= str_repeat("⭐", (int)$review['rating']) ?></span>
          <p><?= htmlspecialchars($review['review_text']) ?></p>
          <small><?= date("d M Y", strtotime($review['created_at'])) ?></small>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</div>
<script src="/js/carousel.js"></script>
</body>
</html>


<?php include "./views/footer.php"; ?>