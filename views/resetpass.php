<?php 
require __DIR__ . "/../config/database.php"; 
include "./views/header.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Reset Password</h2>

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/index.php?action=reset">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label>New Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="confirm" required><br><br>

    <button type="submit">Reset Password</button>
</form>

</body>
</html>