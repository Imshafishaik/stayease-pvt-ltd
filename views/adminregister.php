<?php
require __DIR__ . "/../config/database.php";

// include "./views/header.php";
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
    <h2>Admin Registration</h2>
    <div id="register-msg"></div>
    <form id="admin-register-form">
        <input type="text" name="admin_name" placeholder="Name" required>
        <input type="email" name="admin_email" placeholder="Email" required>
        <input type="password" name="admin_password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
        <p class="switch-form">Already have an account? <a href="/index.php?action=7654">Login</a></p>
    </form>
</div>
</div>
<script>
document.getElementById('admin-register-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('/index.php?action=admin_registering', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msgDiv = document.getElementById('register-msg');
        if (data.status === 'success') {
            msgDiv.innerHTML = `<p style="color:green;">${data.message}</p>`;
            this.reset();
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
// include "./views/footer.php"
?>