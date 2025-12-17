<?php
$db_host = 'your_db_host'; // e.g., 'localhost'
$db_name = 'your_db_name';
$db_user = 'your_db_user';
$db_pass = 'your_db_password';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db_name :" . $e->getMessage());
}
