<?php
require_once '../config/db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['user_id'];
    $owner_id = $_POST['owner_id'];
    $accommodation_id = $_POST['accommodation_id'];
    $message = $_POST['message'];

    $sql = 'INSERT INTO "Inquiry" (student_id, owner_id, accommodation_id, message) VALUES (:student_id, :owner_id, :accommodation_id, :message)';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'student_id' => $student_id,
            'owner_id' => $owner_id,
            'accommodation_id' => $accommodation_id,
            'message' => $message
        ]);
        header("Location: ../views/property_details.php?id=$accommodation_id&inquiry=success");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
