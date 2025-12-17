<?php 
include 'header.php'; 
require_once '../config/db_connect.php';

// Base query
$sql = 'SELECT a.*, o.owner_name FROM "Accommodation" a JOIN "HouseOwner" o ON a.owner_id = o.owner_id WHERE a.is_available = true';
$params = [];

// Search by city
if (!empty($_GET['city'])) {
    $sql .= " AND a.city LIKE :city";
    $params[':city'] = '%' . $_GET['city'] . '%';
}

// Filter by max rent
if (!empty($_GET['max_rent'])) {
    $sql .= " AND a.rent_price <= :max_rent";
    $params[':max_rent'] = $_GET['max_rent'];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <h2>Find Accommodation</h2>

    <form action="listing.php" method="get" class="search-filter-form">
        <input type="text" name="city" placeholder="Search by city..." value="<?php echo isset($_GET['city']) ? htmlspecialchars($_GET['city']) : ''; ?>">
        <input type="number" name="max_rent" placeholder="Max rent..." value="<?php echo isset($_GET['max_rent']) ? htmlspecialchars($_GET['max_rent']) : ''; ?>">
        <button type="submit">Search</button>
    </form>
    
    <div class="property-listings">
        <?php if (count($accommodations) > 0): ?>
            <?php foreach ($accommodations as $acc): ?>
                <div class="property-card">
                    <?php 
                        $photos = json_decode($acc['photos']);
                        if(!empty($photos)):
                    ?>
                        <img src="<?php echo htmlspecialchars($photos[0]); ?>" alt="Property Image">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($acc['title']); ?></h3>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($acc['city']); ?></p>
                    <p><strong>Rent:</strong> €<?php echo htmlspecialchars($acc['rent_price']); ?>/month</p>
                    <p><strong>Owner:</strong> <?php echo htmlspecialchars($acc['owner_name']); ?></p>
                    <a href="property_details.php?id=<?php echo $acc['accommodation_id']; ?>">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No accommodations found matching your criteria.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>