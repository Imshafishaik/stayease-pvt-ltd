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
    
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    <h2>Login to Your Account</h2>
                    
                    <form id="loginForm">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <a href="/index.php?action=forgot" class="forgot-password">forgot password?</a>
                        <p id="loginResponse" style="color:red;"></p>
                        <button type="submit" class="btn btn-login">Login</button>
                    </form>
                    <p class="switch-form">Don't have an account? <a href="/index.php?action=signuppage">Register</a></p>
                </div>
            </div>
        </div>
    </main>

    
    <script>
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email")?.value?.trim();
    const password = document.getElementById("password")?.value;
    const responseEl = document.getElementById("loginResponse");

    responseEl.innerText = "";

    // EMAIL VALIDATION
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        responseEl.innerText = "Please enter a valid email address.";
        return;
    }

    // PASSWORD LENGTH
    if (password.length < 8) {
        responseEl.innerText = "Password must be at least 8 characters long.";
        return;
    }

    // PASSWORD COMPLEXITY
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        responseEl.innerText =
            "Password must contain at least 1 uppercase letter and 1 number.";
        return;
    }


    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/index.php?action=login", true);

    xhr.onload = function () {
        try {
            const res = JSON.parse(xhr.responseText);

            if (res.status === "success") {
                window.location.href = "/index.php?action=home";
            } else {
                responseEl.innerText = res.message;
            }
        } catch (e) {
            responseEl.innerText = "Unexpected server response.";
        }
    };

    xhr.onerror = function () {
        responseEl.innerText = "Server error. Please try again.";
    };

    xhr.send(formData);
});
</script>
</body>
</html>

<?php
include "./views/footer.php"
?>