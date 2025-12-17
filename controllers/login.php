<?php
require_once '../config/db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Attempt to find user in both tables
    $sql_student = 'SELECT * FROM "Student" WHERE student_email = :email';
    $sql_owner = 'SELECT * FROM "HouseOwner" WHERE owner_email = :email';

    try {
        $stmt = $pdo->prepare($sql_student);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        $userType = 'student';

        if (!$user) {
            $stmt = $pdo->prepare($sql_owner);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            $userType = 'owner';
        }

        if ($user && password_verify($password, $user[$userType . '_password'])) {
            $_SESSION['user_id'] = $user[$userType . '_id'];
            $_SESSION['user_type'] = $userType;
            
            // Redirect based on user type
            if($userType === 'owner'){
                 header("Location: ../views/owner_dashboard.php");
            } else {
                 header("Location: ../views/student_dashboard.php");
            }
            exit();
        } else {
            header("Location: ../views/login.php?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
