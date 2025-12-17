<?php 
include 'header.php';
require_once '../config/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch student's inquiries
$sql_inq = 'SELECT i.*, a.title, o.owner_name FROM "Inquiry" i JOIN "Accommodation" a ON i.accommodation_id = a.accommodation_id JOIN "HouseOwner" o ON i.owner_id = o.owner_id WHERE i.student_id = :student_id ORDER BY i.inquiry_date DESC';
$stmt_inq = $pdo->prepare($sql_inq);
$stmt_inq->execute(['student_id' => $student_id]);
$inquiries = $stmt_inq->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <h2>Student Dashboard</h2>
    <p>Welcome to your dashboard. Here you can see your favorite properties and manage your housing search.</p>

    <h3>My Favorite Properties</h3>
    <!-- A list of the student's favorite properties will be displayed here -->

    <h3>My Inquiries</h3>
    <div class="inquiries-list">
        <?php if (count($inquiries) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Owner</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inq): ?>
                        <tr>
                            <td><a href="property_details.php?id=<?php echo $inq['accommodation_id']; ?>"><?php echo htmlspecialchars($inq['title']); ?></a></td>
                            <td><?php echo htmlspecialchars($inq['owner_name']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($inq['message'])); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($inq['inquiry_date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You haven't sent any inquiries yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>