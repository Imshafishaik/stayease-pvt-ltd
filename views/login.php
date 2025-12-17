<?php include 'header.php'; ?>

<div class="container">
    <h2>Login</h2>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
        echo '<p style="color:red;">Invalid email or password.</p>';
    }
    if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
        echo '<p style="color:green;">Signup successful! Please login.</p>';
    }
    ?>
    <form action="../controllers/login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>