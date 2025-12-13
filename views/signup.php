<?php
require __DIR__ . "/../config/database.php";

include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- <header>
        <nav class="navbar">
            <a href="login.php" class="nav-link">Login</a> 
            <a href="signup.php" class="nav-link">Register</a>
            <a href="#" class="nav-link">Listings</a>
            <a href="#" class="nav-link">Admin</a>
        </nav>
    </header> -->
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    <h2>Register a New Student Account</h2>
                        <form id="signupForm" enctype="multipart/form-data">
                            <input type="text" name="name" placeholder="Full Name" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="password" placeholder="Confirm Password" required>

                            <select name="select_user_type">
                            <option>Student</option>
                            <option>House Owner</option>
                            </select>

                            <div class="file-upload">
                            <input type="file" name="passport" id="passport-upload" hidden>
                            <label for="passport-upload"><span>Upload Passport</span><i class="fas fa-cloud-upload-alt"></i></label>
                            </div>

                            <div class="file-upload">
                            <input type="file" name="visa" id="visa-upload" hidden>
                            <label for="visa-upload"><span>Upload Visa</span><i class="fas fa-cloud-upload-alt"></i></label>
                            </div>

                            <button type="submit" class="btn btn-register">Register</button>
                            </form>

                            <div id="response"></div>

                    <p class="switch-form">Already Have an account? <a href="/views/login.php?action=login">Login</a></p>
                </div>
            </div>

            <!-- <div class="form-column">
                <div class="form-wrapper">
                    <h2>Register as House Owner</h2>
                    <form>
                        <input type="text" placeholder="Full Name" required>
                        <input type="email" placeholder="Email" required>
                        <input type="password" placeholder="Password" required>
                        <input type="password" placeholder="Confirm Password" required>
                        <select>
                            <option>Dropdown</option>
                        </select>
                        <div class="file-upload">
                            <input type="file" id="docs-upload" hidden>
                            <label for="docs-upload"><span>Upload House Documents</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="file-upload">
                            <input type="file" id="reg-upload" hidden>
                            <label for="reg-upload"><span>Upload House Registration</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <button type="submit" class="btn btn-register">Register</button>
                    </form>
                    <p class="switch-form">Already Have an account? <a href="Login.html">Login</a></p>
                </div>
            </div> -->
        </div>
    </main>

    <footer>
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
    </footer>
    <script>
document.getElementById("signupForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "/index.php?action=signup", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("..........xhr.status",xhr)
            let res = JSON.parse(xhr.responseText);
            console.log(".......res.status",res)
            if (res.status == "success") {
                console.log(".......res.status",res.status)
                window.location.href = "/views/login.php?action=login";
            } else {
                document.getElementById("response").innerText = res.message;
            }
        }
    };

    xhr.send(formData);
});
</script>


</body>
</html>