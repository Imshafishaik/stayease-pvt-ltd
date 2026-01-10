<?php include "./views/header.php";?>

<link rel="stylesheet" href="../css/profile.css">

<div class="profile-container">

    <div class="profile-card">

        <div class="profile-header">
            <div class="avatar">
                <i class="fa fa-user"></i>
            </div>
            <h2><?= htmlspecialchars($user['user_name']) ?></h2>
            <p><?= htmlspecialchars($user['user_email']) ?></p>

            <span class="badge <?= $user['user_check'] ? 'verified' : 'pending' ?>">
                <?= $user['user_check'] ? 'Verified' : 'Pending Verification' ?>
            </span>
        </div>

        <div class="profile-body">

            <div class="profile-row">
                <span>User Type</span>
                <strong><?= ucfirst($user['user_type']) ?></strong>
            </div>

            <div class="profile-row">
                <span>Document 1</span>
                <?php if ($user['user_doc_one']): ?>
                    <a href="<?= $user['user_doc_one'] ?>" target="_blank">View</a>
                <?php else: ?>
                    <em>Not uploaded</em>
                <?php endif; ?>
            </div>

            <div class="profile-row">
                <span>Document 2</span>
                <?php if ($user['user_doc_two']): ?>
                    <a href="<?= $user['user_doc_two'] ?>" target="_blank">View</a>
                <?php else: ?>
                    <em>Not uploaded</em>
                <?php endif; ?>
            </div>

        </div>

        <div class="profile-footer">
            <a href="/index.php?action=editprofile" class="edit-btn">
                Edit Profile
            </a>
        </div>

    </div>

</div>

<?php include "./views/footer.php"; ?>
