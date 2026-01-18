<?php
require __DIR__ . "/../config/database.php";
include "./views/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayease | Register Page</title>

    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<main class="main-content">
    <div class="forms-container">
        <div class="form-column">
            <div class="form-wrapper">

                <h2>Register a New Student Account</h2>

                <form id="signupForm" enctype="multipart/form-data">

                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required>

                    <select name="select_user_type" id="user-type" required>
                        <option value="">Select User Type</option>
                        <option value="student">Student</option>
                        <option value="owner">House Owner</option>
                    </select>

                    <!-- Student Files -->
                    <div id="student-files" style="display: none;">
                        <div class="file-upload">
                        <input type="file" accept=".pdf" name="passport" id="passport-upload" hidden>
                        <label for="passport-upload"><span>Upload Passport</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="file-upload">
                        <input type="file" accept=".pdf" name="visa" id="visa-upload" hidden>
                        <label for="visa-upload"><span>Upload Visa</span><i class="fas fa-cloud-upload-alt"></i></label> 
                        </div>   
                    </div>

                    <!-- House Owner Files -->
                    <div id="house-files" style="display: none;">
                        <div class="file-upload">
                        <input type="file" accept=".pdf" name="house-document" id="house-document-upload" hidden>
                        <label for="house-document-upload"><span>Upload House Document</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="file-upload">
                        <input type="file" accept=".pdf" name="house-registration" id="house-registration-upload" hidden>
                        <label for="house-registration-upload"><span>Upload House Registration</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                    </div>

                    <div class="terms-box">
                        <label>
                            <input type="checkbox" name="terms_accepted" required>
                            I agree to the 
                            <a href="/index.php?action=terms" target="_blank">
                                Terms & Conditions
                            </a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register">Register</button>
                </form>

                <div id="response"></div>

                <p class="switch-form">
                    Already have an account?
                    <a href="/index.php?action=loginpage">Login</a>
                </p>

            </div>
        </div>
    </div>
</main>

<script>
    const userTypeSelect = document.getElementById("user-type");
    const studentFiles = document.getElementById("student-files");
    const houseFiles = document.getElementById("house-files");

    userTypeSelect.addEventListener("change", function () {
        if (this.value === "student") {
            studentFiles.style.display = "block";
            houseFiles.style.display = "none";
        } else if (this.value === "owner") {
            studentFiles.style.display = "none";
            houseFiles.style.display = "block";
        } else {
            studentFiles.style.display = "none";
            houseFiles.style.display = "none";
        }
    });

    const form =  document.getElementById("signupForm");
    const responseEl = document.getElementById("response");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        responseEl.innerText = "";

        const email = form.email.value.trim();
        const password = form.password.value;
        const confirmPassword = form.confirm_password.value;

        // EMAIL VALIDATION
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showError("Please enter a valid email address.");
        return;
    }

    // PASSWORD LENGTH
    if (password.length < 8) {
        showError("Password must be at least 8 characters long.");
        return;
    }

    // PASSWORD COMPLEXITY
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        showError("Password must contain at least 1 uppercase letter and 1 number.");
        return;
    }

    // PASSWORD MATCH
    if (password !== confirmPassword) {
        showError("Password and Confirm Password do not match.");
        return;
    }

    // TERMS CHECK
    if (!form.terms_accepted.checked) {
        showError("You must accept the Terms & Conditions.");
        return;
    }
        

        const formData = new FormData(this);

        fetch("/index.php?action=signup", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = "/index.php?action=usercheck";
            } else {
                showError(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            responseEl.innerText = "File too large it shuld be less than 2MB.";
            responseEl.style.color = "red";
        });
    });

    function showError(message) {
        responseEl.innerText = message;
        responseEl.style.color = "red";
    }
</script>

</body>
</html>

<?php include "./views/footer.php"; ?>
