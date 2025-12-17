<?php
$db_host = 'your_db_host';       // e.g., 'localhost'
$db_port = '5432';               // Default PostgreSQL port
$db_name = 'your_db_name';
$db_user = 'your_db_user';
$db_pass = 'your_db_password';

try {
    // PostgreSQL connection string
    $pdo = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db_name: " . $e->getMessage());
}
