<?php
require_once '../config/db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner') {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $rent = $_POST['rent'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $amenities = $_POST['amenities'];

    // Handle file uploads
    $photo_paths = [];
    if (isset($_FILES['photos'])) {
        $upload_dir = '../images/accommodations/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['photos']['name'][$key]);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                $photo_paths[] = $target_file;
            }
        }
    }

    $sql = "INSERT INTO "Accommodation" (owner_id, title, description, rent_price, city, address, amenities, photos) VALUES (:owner_id, :title, :description, :rent_price, :city, :address, :amenities, :photos)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'owner_id' => $owner_id,
            'title' => $title,
            'description' => $description,
            'rent_price' => $rent,
            'city' => $city,
            'address' => $address,
            'amenities' => $amenities,
            'photos' => json_encode($photo_paths) // Store photo paths as a JSON array
        ]);
        header("Location: ../views/owner_dashboard.php?upload=success");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
