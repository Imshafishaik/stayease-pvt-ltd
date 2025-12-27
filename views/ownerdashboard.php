<?php 
require __DIR__ . "/../config/database.php"; 
include "./views/header.php"; 

 $orders =  $orders ?? [];

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/ownerdashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <!--
            <div class="logo">StayEase</div>
            <div class="search-box">
                <input type="text" placeholder="Search houses, amenities, and owners">
                <i class="fa fa-search"></i>
            </div>
            -->
        </div>

        <div class="nav-right">
            <a href="#" class="active">Overview</a>
            
            <a href="/rentupload.php?action=rentupload" class="upload-btn">Upload</a>
            <a href="/index.php?action=ownerdashboard" class="upload-btn">My Dashboard</a>
        </div>
    </nav>

   
    <div>
        <h2>Booking Requests</h2>

<?php if (empty($orders)): ?>
    <p>No booking orders yet.</p>
<?php endif; ?>

<?php foreach ($orders as $req): ?>
    <div class="request-card">
        <div class="booking-card">
    <h3><?= $req['accommodation_name'] ?></h3>
    <p>Student: <?= $req['user_name'] ?></p>

    <a href="<?= $req['user_doc_one'] ?>" target="_blank">Document 1</a>
    <a href="<?= $req['user_doc_two'] ?>" target="_blank">Document 2</a>

    <form method="post" action="/index.php?action=updateBooking">
        <input type="hidden" name="order_id" value="<?= $req['order_id'] ?>">
        <button name="status" value="accepted">Accept</button>
        <button name="status" value="rejected">Reject</button>
    </form>
</div>

        <!-- <h3><?= htmlspecialchars($req['accommodation_name']) ?></h3>

        <p>
            Student: <?= htmlspecialchars($req['user_name']) ?><br>
            Email: <?= htmlspecialchars($req['user_email']) ?><br>
            Price: €<?= htmlspecialchars($req['total_price']) ?><br>
            Status: <?= htmlspecialchars($req['booking_status']) ?>
        </p>

        <div>
            <img src="<?= htmlspecialchars($req['user_doc_one']) ?>" />

            <img src="<?= htmlspecialchars($req['user_doc_two']) ?>" />
        </div>

        <?php if ($req['booking_status'] === 'requested'): ?>
    <div class="order-actions" data-order-id="<?= $req['order_id'] ?>">
        <button class="btn-action accept" data-status="accepted">Accept</button>
        <button class="btn-action reject" data-status="rejected">Reject</button>
        <span class="action-msg"></span>
    </div>
<?php endif; ?> -->

    </div>
<?php endforeach; ?>
</div>
    
<script>
document.querySelectorAll(".btn-action").forEach(btn => {
    btn.addEventListener("click", function () {

        const parent = this.closest(".order-actions");
        const orderId = parent.dataset.orderId;
        const status  = this.dataset.status;
        const msgBox  = parent.querySelector(".action-msg");

        if (!confirm(`Are you sure you want to ${status} this request?`)) return;

        fetch("/index.php?action=updateorderstatus", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `order_id=${orderId}&status=${status}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                msgBox.innerHTML = "✔ Updated";
                parent.innerHTML = `<strong>Status: ${status}</strong>`;
            } else {
                msgBox.innerHTML = "❌ Failed";
            }
        })
        .catch(() => {
            msgBox.innerHTML = "⚠ Server error";
        });
    });
});
</script>

</body>
</html>

<?php include "./views/footer.php"; ?>
