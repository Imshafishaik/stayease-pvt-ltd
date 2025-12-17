<?php 
include 'header.php'; 
require_once '../config/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner') {
    header("Location: login.php");
    exit();
}

$owner_id = $_SESSION['user_id'];

// Fetch owner's properties
$sql_props = 'SELECT * FROM "Accommodation" WHERE owner_id = :owner_id';
$stmt_props = $pdo->prepare($sql_props);
$stmt_props->execute(['owner_id' => $owner_id]);
$properties = $stmt_props->fetchAll(PDO::FETCH_ASSOC);

// Fetch inquiries for owner's properties
$sql_inq = 'SELECT i.*, s.student_name, a.title FROM "Inquiry" i JOIN "Student" s ON i.student_id = s.student_id JOIN "Accommodation" a ON i.accommodation_id = a.accommodation_id WHERE i.owner_id = :owner_id ORDER BY i.inquiry_date DESC';
$stmt_inq = $pdo->prepare($sql_inq);
$stmt_inq->execute(['owner_id' => $owner_id]);
$inquiries = $stmt_inq->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <h2>Owner Dashboard</h2>
    <p>Welcome to your dashboard. Here you can manage your properties and view inquiries from students.</p>

    <h3>My Properties</h3>
    <a href="add_property.php">+ Add New Property</a>
    <div class="property-listings">
        <?php if (count($properties) > 0): ?>
            <?php foreach ($properties as $prop): ?>
                <div class="property-card">
                    <h4><?php echo htmlspecialchars($prop['title']); ?></h4>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($prop['city']); ?></p>
                    <a href="property_details.php?id=<?php echo $prop['accommodation_id']; ?>">View</a>
                    <!-- Add edit/delete links here -->
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You haven't added any properties yet.</p>
        <?php endif; ?>
    </div>

    <h3>Recent Inquiries</h3>
    <div class="inquiries-list">
        <?php if (count($inquiries) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Property</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inq): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($inq['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($inq['title']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($inq['message'])); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($inq['inquiry_date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have no inquiries yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>