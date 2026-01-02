<?php
include "./views/header.php"; 

// $avgRating = $avgRating ?? "";
// $accommodationId=$accommodationId ?? "";
// $reviews = $reviews ?? [];

$id = $_GET['id'] ?? null;
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

    <!-- <div class="avg-rating">
        ⭐ <?= $avgRating ?: 'No ratings yet' ?>
    </div> -->

    <form method="post" action="/index.php?action=submitReview">

        <input type="hidden" name="accommodation_id" value="<?= $id ?>">
        
        <label>Rating</label>
        <select name="rating" required>
            <option value="">Select</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
        </select>

        <label>Comment</label>
        <textarea name="review" required placeholder="Write your review..."></textarea>

        <button type="submit">Submit Review</button>
    </form>
    
</section>


</body>
</html>

<?php
    include "./views/footer.php";
?>