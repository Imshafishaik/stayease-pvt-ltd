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
    <div class="nav-right">
        <a href="#" class="active">Overview</a>
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

        <form method="post" action="/index.php?action=updateBooking">
            <input type="hidden" name="order_id" value="<?= $req['order_id'] ?>">

            <button type="submit" name="status" value="accepted">Accept</button>
            <button type="submit" name="status" value="rejected">Reject</button>
        </form>

    </div>
<?php endforeach; ?>

</body>
</html>

<?php include "./views/footer.php"; ?>
