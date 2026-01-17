<?php 
// include "./views/header.php";
require __DIR__ . "/../helpers/user.php";
require_once __DIR__ . "/../helpers/user.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminfaq.css"> 
    <title>Document</title>
</head>
<body>
<nav class="navbar_faq">
        <div class="nav-left">
            <!-- <div class="logo">StayEase</div> -->
            <!-- <div class="search-box">
                <input type="text" placeholder="Search houses, amenities, and owners">
                <i class="fa fa-search"></i>
            </div> -->
        </div>

        
        <div class="nav-right">
            <?php if (admin_user_id()): ?>
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileBtn">
                    <?= htmlspecialchars(admin_user_name()) ?>  
                </button>
                <a href="/index.php?action=logout" class="logout">Logout</a>
            </div>
            <?php else: ?>
            <a href="/index.php?action=7654" class="login-btn">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
            <div class="sidebar">
                <h3 class="sidebar-title">Quick Links</h3>
                <ul class="quick-links scrollbar">
                    <li><a href="/index.php?action=adminprofile">User Management</a></li>
                    <li><a href="/index.php?action=adm_mng_faq">Faq Management</a></li>                 
                </ul>
            </div>

<section class="content">
<?php if (empty($faqs)): ?>
    <p>All FAQs are answered</p>
<?php endif; ?>

<?php foreach ($faqs as $faq): ?>
    <div class="faq-box">
        <p><strong>Q:</strong> <?= htmlspecialchars($faq['question']) ?></p>

        <?php if (!$faq['answer']): ?>
    <button onclick="submitAnswer(<?= $faq['faq_id'] ?>)">Submit</button>
<?php else: ?>
    <p> <?= htmlspecialchars($faq['answer']) ?></p>
    <small class="answered-label">Answered</small>
<?php endif; ?>

        <!-- <button onclick="submitAnswer(<?= $faq['faq_id'] ?>)">Submit</button> -->
    </div>
<?php endforeach; ?>
</section>
</main>
<script>
function submitAnswer(faqId) {
    const answer = document.getElementById("answer-" + faqId).value;

    fetch("/index.php?action=admin_answer_faq", {
    method: "POST",
    credentials: "same-origin",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `faq_id=${faqId}&answer=${encodeURIComponent(answer)}`
})

    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            location.reload();
        } else {
            alert(data.message);
        }
    });
}
</script>
</body>
</html>



<?php include "./views/footer.php"; ?>
