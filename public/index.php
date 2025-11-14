<?php
require __DIR__ . '/../src/userSchema.php';
$stmt = $pdo->query("SELECT * FROM users");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r("working $results");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
</head>
<body>
    <h1>Shafi Table Data</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        

        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_id']) ?></td>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="../src/userPostSchema.php">post question</a>
</body>
</html>

<!-- <?php include '../src/userPostSchema.php'; ?> -->