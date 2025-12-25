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
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="admin_login_form">
<div class="form-container">
    <h2>Admin Login</h2>
    <div id="login-msg"></div>
    <form id="admin-login-form">
        <input type="email" name="admin_email" placeholder="Email" required>
        <input type="password" name="admin_password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p class="switch-form">Don't have an account? <a href="/index.php?action=admin_register">Register</a></p>
    </form>
</div>
</div>
<script>
document.getElementById('admin-login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('/index.php?action=admin_logining', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msgDiv = document.getElementById('login-msg');
        if (data.status === 'success') {
            msgDiv.innerHTML = `<p style="color:green;">${data.message}</p>`;
            // Redirect to dashboard after 1s
            setTimeout(() => { window.location.href = '/index.php?action=adminprofile'; }, 1000);
        } else {
            msgDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
        }
    })
    .catch(err => console.error(err));
});
</script>

</body>
</html>

<?php
include "./views/footer.php"
?>