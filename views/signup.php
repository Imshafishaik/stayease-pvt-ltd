<?php include 'header.php'; ?>

<div class="container">
    <h2>Sign Up</h2>
    <form action="../controllers/signup.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="userType">I am a:</label>
        <select id="userType" name="userType" required>
            <option value="student">Student</option>
            <option value="owner">House Owner</option>
        </select>

        <button type="submit">Sign Up</button>
    </form>
</div>

<?php include 'footer.php'; ?>