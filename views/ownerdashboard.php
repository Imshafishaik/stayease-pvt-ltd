<?php 
require __DIR__ . "/../config/database.php"; 
include "./views/header.php"; 

$orders = $orders ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/ownerdashboard.css">
</head>

<body>



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

<h2>Booking Requests</h2>

<?php if (empty($orders)): ?>
    <p>No booking orders yet.</p>
<?php endif; ?>

<?php foreach ($orders as $req): ?>
    <div class="booking-card">

        <h3><?= htmlspecialchars($req['accommodation_name']) ?></h3>
        <p>Student: <?= htmlspecialchars($req['user_name']) ?></p>

        <a href="<?= htmlspecialchars($req['user_doc_one']) ?>" target="_blank">Document 1</a>
        <a href="<?= htmlspecialchars($req['user_doc_two']) ?>" target="_blank">Document 2</a>

       <div class="booking-actions">
    <button 
        class="booking-btn accept"
        onclick="updateBooking(<?= $req['order_id'] ?>, 'accepted')">
        Accept
    </button>

    <button 
        class="booking-btn reject"
        onclick="updateBooking(<?= $req['order_id'] ?>, 'rejected')">
        Reject
    </button>
</div>

    </div>
<?php endforeach; ?>

<script>
function updateBooking(orderId, status) {
    fetch('/index.php?action=updateBooking', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({
            order_id: orderId,
            status: status
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Booking updated successfully!');
            window.location.href = data.redirect;
        } else if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            alert(data.message || 'Something went wrong');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error');
    });
}

</script>


</body>
</html>

<?php include "./views/footer.php"; ?>
