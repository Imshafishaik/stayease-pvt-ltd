<?php
$host = "localhost";
$port = "5432";
$dbname = "stayease";
$user = "shafi";
$pass = "shafi"; 

try {
    //pdo - php data object
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Connected to PostgreSQL successfully!";
} catch (PDOException $e) {
    die("PostgreSQL connection failed: " . $e->getMessage());
}
?>
