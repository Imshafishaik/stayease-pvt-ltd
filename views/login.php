<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <!-- <header> -->
        <!-- <nav class="navbar">
            <a href="signup.php" class="nav-link">Register</a>
            <a href="#" class="nav-link">Listings</a>
            <a href="#" class="nav-link">Admin</a>
        </nav> -->
    <!-- </header> -->
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    <h2>Login to Your Account</h2>
                    <form action="">
                        <input type="email" placeholder="Email" required>
                        <input type="password" placeholder="Password" required>
                        <a href="#" class="forgot-password">forgot password?</a>
                        <button type="submit" class="btn btn-login">Login</button>
                    </form>
                    <p class="switch-form">Don't have an account? <a href="/signup.php?action=signup">Register</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- <footer>
        <div class="footer-content">
            <div class="contact-info">
                <h4>Contact Us</h4>
                <p>Email: support@accommodateme.com</p>
                <p>Phone: +33 1 23 45 67 89</p>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer> -->
</body>
</html>