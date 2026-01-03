<?php

require __DIR__ . "/../helpers/user.php";
// Start session if not already started
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/header.css">
<title>Stayease</title>
</head>

<body>
<header class="main_header_navbar">
    <div class="logo">
        <img src="../../images/homeimages/logo.jpg" alt="Stayease">
    </div>

    <div class="menu-toggle" id="menuToggle">☰</div>

    <nav class="nav-links" id="navLinks">
        <a href="/index.php?action=home">Home</a>
        <a href="/index.php?action=listing">Find Accommodation</a>

        <?php if (auth_user_id() && auth_user_type() === 'owner'): ?>
            <a href="/index.php?action=owner">For Owners</a>
        <?php endif; ?>

        <a href="/index.php?action=contact">Contact Us</a>
        <a href="/index.php?action=getfaqs">FAQs</a>

        <?php if (auth_user_id()): ?>
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileBtn">
                    <?= htmlspecialchars(auth_user_name()) ?> ▼
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    <a href="/index.php?action=myprofile">My Profile</a>
                    <a href="/index.php?action=orders">My Orders</a>
                    <a href="/index.php?action=logout" class="logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="/index.php?action=loginpage" class="login-btn">Login</a>
        <?php endif; ?>
    </nav>
</header>



<script>
/* MOBILE NAV TOGGLE */
document.getElementById("menuToggle").addEventListener("click", function () {
    document.getElementById("navLinks").classList.toggle("active");
});

/* PROFILE DROPDOWN */
document.getElementById("profileBtn")?.addEventListener("click", function (e) {
    e.stopPropagation();
    document.getElementById("profileMenu").classList.toggle("show");
});

/* CLOSE DROPDOWNS ON OUTSIDE CLICK */
document.addEventListener("click", function () {
    document.getElementById("profileMenu")?.classList.remove("show");
});
</script>

</body>
</html>

