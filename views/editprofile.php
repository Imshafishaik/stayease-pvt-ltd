<?php
require __DIR__ . "/../config/database.php";
include "./views/header.php";

$edituser = $edituser ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/editprofile.css">
</head>
<body>

<div class="profile-container">
    <div class="profile-card">


<form id="editForm" enctype="multipart/form-data">
    <h2>Edit Profile</h2>
    <input type="text" name="name" value="<?= htmlspecialchars($edituser['user_name']) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($edituser['user_email']) ?>" required>

    <input type="password" name="password" placeholder="New password (optional)">

    <p>Current Documents:</p>
    <?php if ($edituser['user_doc_one']): ?>
        <a href="<?= $edituser['user_doc_one'] ?>" target="_blank">Document 1</a>
    <?php endif; ?>

    <?php if ($edituser['user_doc_two']): ?>
        <a href="<?= $edituser['user_doc_two'] ?>" target="_blank">Document 2</a>
    <?php endif; ?>

    <input type="file" name="doc_one">
    <input type="file" name="doc_two">

    <button type="submit">Update</button>
</form>

<div id="response"></div>

</div>
</div>

<script>
document.getElementById("editForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("/index.php?action=updateprofile", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            alert("Profile updated successfully");
            location.reload();
        } else {
            document.getElementById("response").innerText = data.message;
        }
    })
    .catch(() => {
        document.getElementById("response").innerText = "Server error";
    });
});
</script>

</body>
</html>
