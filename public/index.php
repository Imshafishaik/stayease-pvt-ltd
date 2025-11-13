<?php
require __DIR__ . '/../src/userSchema.php';
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
            <th>Email</th>
        </tr>
        <!-- <?php
            print_r($results);
        ?> -->

        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['shafiid']) ?></td>
                <td><?= htmlspecialchars($row['shafiname']) ?></td>
                <td><?= htmlspecialchars($row['shafiemail']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
include 'user.php';
?>
