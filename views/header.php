<?php

require __DIR__ . "/../helpers/user.php";

$action = $_GET['action'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/header.css">
<link rel="icon" type="image/png" href="../images/homeimages/logo.jpg">
<!-- <title>Stayease</title> -->
</head>

<body>
<header class="main_header_navbar">
    <div class="logo">
        <img src="../../images/homeimages/logo.jpg" alt="Stayease">
    </div>

    <div class="menu-toggle" id="menuToggle">☰</div>

    <nav class="nav-links" id="navLinks">
        <a class="<?= $action === 'home' ? 'active' : '' ?>" href="/index.php?action=home">Home</a>
        <a class="<?= $action === 'listing' ? 'active' : '' ?>" href="/index.php?action=listing">Find Accommodation</a>

        <?php if (auth_user_id() && auth_user_type() === 'owner'): ?>
            <a class="<?= $action === 'owner' ? 'active' : '' ?>" href="/index.php?action=owner">For Owners</a>
        <?php endif; ?>

        <a class="<?= $action === 'contact' ? 'active' : '' ?>" href="/index.php?action=contact">Contact Us</a>
        <a class="<?= $action === 'getfaqs' ? 'active' : '' ?>" href="/index.php?action=getfaqs">FAQs</a>
        <?php if (auth_user_id()): ?>
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileBtn">
                    <?= htmlspecialchars(auth_user_name()) ?> ▼
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    <a href="/index.php?action=myprofile">My Profile</a>
                     <?php if (auth_user_id() && auth_user_type() !== 'owner'): ?>
                    <a href="/index.php?action=allfavourites">My Favourites</a>
                    <?php endif; ?>
                     <?php if (auth_user_id() && auth_user_type() !== 'owner'): ?>
                    <a href="/index.php?action=orders">My Orders</a>
                    <?php endif; ?>
                    <a href="/index.php?action=logout" class="logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="/index.php?action=signuppage" class="login-btn">Register</a>
        <?php endif; ?>
    </nav>
</header>

<script>

const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", function (e) {
    e.stopPropagation();
    navLinks.classList.toggle("active");

    // Change icon ☰ ↔ ✕
    menuToggle.textContent = navLinks.classList.contains("active") ? "✕" : "☰";
});


document.getElementById("profileBtn")?.addEventListener("click", function (e) {
    e.stopPropagation();
    document.getElementById("profileMenu").classList.toggle("show");
});


document.addEventListener("click", function () {
    document.getElementById("profileMenu")?.classList.remove("show");
});
</script>

</body>
</html>

