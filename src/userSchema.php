<?php
require __DIR__ . '/../config/database.php';

try {
// $sql = "CREATE TABLE shafi(shafiid SERIAL PRIMARY KEY, shafiname VARCHAR(100) NOT NULL, shafiemail VARCHAR(100) UNIQUE NOT NULL)";
$stmt = $pdo->prepare("INSERT INTO shafi (user_name) VALUES (:name)");

$stmt->execute([
    ':name' => "rahul",
]);

// $stmt = $pdo->query("SELECT shafiid, shafiname, shafiemail FROM shafi");
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     echo "ID: {$row['shafiid']} - Name: {$row['shafiname']} - Email: {$row['shafiemail']} <br>";
// }

$stmt = $pdo->query("SELECT * FROM users");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $pdo->query("SELECT shafiid, shafiname, shafiemail FROM shafi");
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $pdo->exec($sql);
// echo $results;
print_r($results);
echo "Table created successfully...";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}

?>