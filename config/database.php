<?php
require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}



$host = "shafi-shafimern-c5d9.h.aivencloud.com";
$port = "19448";
$dbname = "stayease-pvt-ltd";
$user = "avnadmin";
$pass = $_ENV['DB_PASS'] ?? null;

try {
    //pdo - php data object
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // echo "Connected to PostgreSQL successfully!";
} catch (PDOException $e) {
    die("PostgreSQL connection failed: " . $e->getMessage());
}
?>
