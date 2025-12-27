<?php
$avgRating = $avgRating ?? "";
$accommodationId=$accommodationId ?? "";
$reviews = $reviews ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/review.css">
    <title>Document</title>
</head>
<body>
   <section class="reviews">
    <h2>Reviews</h2>

    <div class="avg-rating">
        ⭐ <?= $avgRating ?: 'No ratings yet' ?>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
    <form id="reviewForm">
        <input type="hidden" name="accommodation_id" value="<?= $accommodationId ?>">
        
        <select name="rating" required>
            <option value="">Rating</option>
            <?php for ($i=1;$i<=5;$i++): ?>
                <option value="<?= $i ?>"><?= $i ?> ⭐</option>
            <?php endfor; ?>
        </select>

        <textarea name="review" placeholder="Write your review"></textarea>
        <button type="submit">Submit Review</button>
    </form>
    <?php else: ?>
        <p>Please login to review.</p>
    <?php endif; ?>

    <div class="review-list">
        <?php foreach ($reviews as $r): ?>
            <div class="review-card">
                <strong><?= htmlspecialchars($r['user_name']) ?></strong>
                <span><?= str_repeat('⭐', $r['rating']) ?></span>
                <p><?= htmlspecialchars($r['review_text']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<script>
document.getElementById('reviewForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    fetch('/index.php?action=submitReview', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') location.reload();
        else alert(data.message);
    });
});
</script>

</body>
</html>