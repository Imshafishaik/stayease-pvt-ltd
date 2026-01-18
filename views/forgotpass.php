<?php 
include "./views/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayease | Forgot Password</title>
    <link rel="stylesheet" href="../css/login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    
                    <form id="forgotForm">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <p id="forgotResponse"></p>
                        <button type="submit" class="btn btn-reset">Send Reset Link</button>
                    </form>
                    <p class="switch-form">Remember your password? <a href="/index.php?action=loginpage">Go back to Login</a></p>
                </div>
            </div>
        </div>
    </main>

    <script>
document.getElementById("forgotForm").addEventListener("submit", function(e){
    e.preventDefault();

    fetch("/index.php?action=forgot", {
        method: "POST",
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        const msg = document.getElementById("forgotResponse");
        msg.innerText = data.message;
        msg.style.color = data.status === "success" ? "green" : "red";
    });
});
</script>

</body>
</html>

<?php
include "./views/footer.php"
?>