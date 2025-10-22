<?php
require __DIR__ . '/../config/database.php';

$sql = "CREATE TABLE shafi(shafiid SERIAL PRIMARY KEY, shafiname VARCHAR(100) NOT NULL, shafiemail VARCHAR(100) UNIQUE NOT NULL)";

$pdo->exec($sql);

echo "Table created successfully..."

?>