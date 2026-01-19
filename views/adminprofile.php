<?php
require __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../helpers/user.php";

// include "./views/header.php";
$students_admin = $students_admin ?? [];
$owner_admin = $owner_admin ?? [];
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayease | Admin Dashboard</title>
    <link rel="stylesheet" href="../css/adminprofile.css"> 
    <link rel="icon" type="image/png" href="../images/homeimages/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

    <nav class="navbar_faq">
        <div class="nav-left">
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
                     <li><a href="/index.php?action=adm_terms_conditions">Terms & Conditions</a></li>               
                </ul>
            </div>

            <section class="content">

                <div class="documents" >
                    <h2 class="documents-header">User Documents</h2>
                    <div class="scrollbar">
                    <div class="student-documents">

                        <?php foreach ($students_admin as $stu_adm): ?>
                            <div class="document-card">
                                <div class="document-info">
                                    <a href="<?= htmlspecialchars($stu_adm['user_doc_one']) ?>" target="_blank">
                                        Student Passport Document<!-- <img src="<?= htmlspecialchars($stu_adm['user_doc_one']) ?>" class="profile-pic"> -->
                                    </a>

                                    <a href="<?= htmlspecialchars($stu_adm['user_doc_two']) ?>" target="_blank">
                                        Student Visa Document<!-- <img src="<?= htmlspecialchars($stu_adm['user_doc_two']) ?>" class="profile-pic"> -->
                                    </a>

                                    <div class="document-details">
                                        <p class="document-owner">
                                            <!-- <?= htmlspecialchars($stu_adm['user_type']) ?> -->
                                        </p>
                                        <!-- <p class="document-type">Student</p> -->
                                    </div>
                                </div>

                                <div class="document-actions">
                                    <!-- <button
                                        type="button"
                                        class="action accept"
                                        onclick="updateDocument(<?= (int)$stu_adm['user_id'] ?>, 'student', 'accept')">
                                        Accept
                                    </button>

                                    <button
                                        type="button"
                                        class="action reject"
                                        onclick="updateDocument(<?= (int)$stu_adm['user_id'] ?>, 'student', 'reject')">
                                        Reject
                                    </button> -->

                                    <button class="action accept" onclick="updateDocument(<?= (int)$stu_adm['user_id'] ?>,'accept')">
                                        Accept
                                    </button>

                                    <button class="action reject" onclick="updateDocument(<?= (int)$stu_adm['user_id'] ?>,'reject')">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

            <section class="content">

                <div class="documents" >
                    <h2 class="documents-header">House Owner Documents</h2>
                    <div class="scrollbar">
                    <div class="student-documents">

                        <?php foreach ($owner_admin as $own_admin): ?>
                            <div class="document-card">
                                <div class="document-info">
                                    <a href="<?= htmlspecialchars($own_admin['user_doc_one']) ?>" target="_blank">
                                        House Registration Document<!-- <img src="<?= htmlspecialchars($own_admin['user_doc_one']) ?>" class="profile-pic"> -->
                                    </a>

                                    <a href="<?= htmlspecialchars($own_admin['user_doc_two']) ?>" target="_blank">
                                        House Owner Document<!-- <img src="<?= htmlspecialchars($own_admin['user_doc_two']) ?>" class="profile-pic"> -->
                                    </a>

                                    <div class="document-details">
                                        <p class="document-owner">
                                            <!-- <?= htmlspecialchars($own_admin['user_name']) ?> -->
                                        </p>
                                        <!-- <p class="document-type">Student</p> -->
                                    </div>
                                </div>

                                <div class="document-actions">
                                    <!-- <button
                                        type="button"
                                        class="action accept"
                                        onclick="updateDocument(<?= (int)$own_admin['user_id'] ?>, 'student', 'accept')">
                                        Accept
                                    </button>

                                    <button
                                        type="button"
                                        class="action reject"
                                        onclick="updateDocument(<?= (int)$own_admin['user_id'] ?>, 'student', 'reject')">
                                        Reject
                                    </button> -->

                                    <button class="action accept" onclick="updateDocument(<?= (int)$own_admin['user_id'] ?>,'accept')">
                                        Accept
                                    </button>

                                    <button class="action reject" onclick="updateDocument(<?= (int)$own_admin['user_id'] ?>,'reject')">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
        </main>

    </div>

    <script>

    function updateDocument(userId, action) {
        console.log(".........userId, action",userId, action);
        
        fetch('/index.php?action=approveDocument', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams({user_id: userId, action: action})
        })
        .then(r => r.json())
        .then(d => {
            if (d.status === 'success') location.reload();
            else alert(d.message);
        });
    }
    </script>

</body>
</html>
