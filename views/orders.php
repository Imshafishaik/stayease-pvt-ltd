<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/orders.css">
    <title>Document</title>
</head>
<body>
    <section class="orders">
    <h2>My Orders</h2>

    <?php if (empty($orders)): ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <?php foreach ($orders as $order): ?>
        <div class="order-card">
            <h3><?= htmlspecialchars($order['accommodation_name']) ?></h3>

            <?php if (isset($order['user_name'])): ?>
                <p><strong>Customer:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
            <?php endif; ?>

            <p><strong>Price:</strong> €<?= $order['total_price'] ?></p>
            <p><strong>Status:</strong>
                <span class="status <?= $order['order_status'] ?>">
                    <?= ucfirst($order['order_status']) ?>
                </span>
            </p>
            <small><?= date('d M Y', strtotime($order['created_at'])) ?></small>

            <a href="/index.php?action=review&id=<?= htmlspecialchars($order['accommodation_id']) ?>">Write Review</a>
        </div>
    <?php endforeach; ?>
</section>

</body>
</html>

