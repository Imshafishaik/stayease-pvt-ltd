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

    <form id="reviewForm">
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

<div id="reviewResponse"></div>

    
</section>

<script>
const reviewForm = document.getElementById("reviewForm");
const responseEl = document.getElementById("reviewResponse");

reviewForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(reviewForm);

    fetch("/index.php?action=submitReview", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            responseEl.innerText = "Review submitted successfully!";
            responseEl.style.color = "green";
            window.location.href = "/index.php?action=accomodation_detail&id=<?= $id ?>";
            // reviewForm.reset();
        } else {
            responseEl.innerText = data.message;
            responseEl.style.color = "red";
        }
    })
    .catch(() => {
        responseEl.innerText = "Something went wrong";
        responseEl.style.color = "red";
    });
});
</script>


</body>
</html>

<?php
    include "./views/footer.php";
?>