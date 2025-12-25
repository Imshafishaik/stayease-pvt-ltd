<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/header.css"/>
    <title>Stayease</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-img">
            <img src="../../images/homeimages/logo.jpg" height="60px"/>
        </div>
        <div class="nav-bar-list">
          <ul>
            <li><a href="/index.php?action=home">Home</a></li>
            <li><a href="/index.php?action=listing" >Find Accomodation</a></li>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'owner'): ?>
    <li><a href="/index.php?action=owner">For Owners</a></li>
<?php endif; ?>
            <li><a href="/index.php?action=contact">Contact us</a></li>
            <li><a href="/index.php?action=getfaqs">FAQS</a></li>
            <?php
                if (isset($_SESSION['user_id'])):   
                ?>
                <li><a href="/index.php?action=logout">Logout (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a></li>
                <?php else: ?>
                <li><a href="/index.php?action=loginpage">Login</a></li>
                <?php endif; ?>
         </ul>
        </div>
      </div>
</body>
</html>