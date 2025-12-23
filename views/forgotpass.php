<?php 
include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- <header>
        <nav class="navbar">
            <a href="login page.html" class="nav-link">Login</a> 
            <a href="register page.html" class="nav-link">Register</a>
            <a href="#" class="nav-link">Listings</a>
            <a href="#" class="nav-link">Admin</a>
        </nav>
    </header> -->
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    <h2>Reset Your Password</h2>
                    <p class="form-description">Enter your email address and we'll send you a link to reset your password.</p>
                    <form>
                        <input type="email" placeholder="Email" required>
                        <button type="submit" class="btn btn-reset">Send Reset Link</button>
                    </form>
                    <p class="switch-form">Remember your password? <a href="/index.php?action=login">Go back to Login</a></p>
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

<?php
include "./footer.php"
?>