<?php 
include 'header.php';
require_once '../config/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: listing.php");
    exit();
}

$accommodation_id = $_GET['id'];

$sql = 'SELECT a.*, o.owner_name FROM "Accommodation" a JOIN "HouseOwner" o ON a.owner_id = o.owner_id WHERE a.accommodation_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $accommodation_id]);
$accommodation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$accommodation) {
    die("Accommodation not found.");
}
?>

<div class="container">
    <h2><?php echo htmlspecialchars($accommodation['title']); ?></h2>

    <div class="property-details">
        <div class="property-images">
            <?php 
                $photos = json_decode($accommodation['photos']);
                if (!empty($photos)):
                    foreach ($photos as $photo):
            ?>
                <img src="<?php echo htmlspecialchars($photo); ?>" alt="Property Image">
            <?php 
                    endforeach;
                endif;
            ?>
        </div>

        <div class="property-info">
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($accommodation['description'])); ?></p>
            <p><strong>Rent:</strong> €<?php echo htmlspecialchars($accommodation['rent_price']); ?>/month</p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($accommodation['city']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($accommodation['address']); ?></p>
            <p><strong>Amenities:</strong> <?php echo htmlspecialchars($accommodation['amenities']); ?></p>
            <p><strong>Owner:</strong> <?php echo htmlspecialchars($accommodation['owner_name']); ?></p>
        </div>
    </div>

    <div class="inquiry-form">
        <h3>Contact Owner</h3>
        <form action="../controllers/send_inquiry.php" method="post">
            <input type="hidden" name="accommodation_id" value="<?php echo $accommodation['accommodation_id']; ?>">
            <input type="hidden" name="owner_id" value="<?php echo $accommodation['owner_id']; ?>">
            <textarea name="message" placeholder="Type your message to the owner..." required></textarea>
            <button type="submit">Send Inquiry</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>