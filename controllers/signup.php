<?php
require_once '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($userType)) {
        die("Please fill all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($userType === 'student') {
        $sql = "INSERT INTO Student (student_name, student_email, student_password) VALUES (:name, :email, :password)";
    } elseif ($userType === 'owner') {
        $sql = "INSERT INTO HouseOwner (owner_name, owner_email, owner_password) VALUES (:name, :email, :password)";
    } else {
        die("Invalid user type selected.");
    }

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password]);
        header("Location: ../views/login.php?signup=success");
        exit();
    } catch (PDOException $e) {
        // Check for duplicate email (PostgreSQL error code for unique violation is 23505)
        if ($e->getCode() == '23505') { 
            die("An account with this email already exists.");
        } else {
            die("Error: " . $e->getMessage());
        }
    }
}
