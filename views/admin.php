<?php
require __DIR__ . "/../config/database.php";

// include "./views/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css"/>
    <title>Admin Page</title>
</head>
<body>
    Admin page
    <div class="add_blocks">
        <div class="add_block">
            <p>Manage Students</p>

            <a href="/manage/users">Manage Users</a>
        </div>
        <div class="add_block">
            <p>Manage Faqs</p>
            <a href="/manage/users">Manage Faqs</a>
        </div>
        <div class="add_block">
            <p>Manage House Owner</p>
            <a href="/manage/users">Manages</a>
        </div>
    </div>
</body>
</html>

<?php

include "./views/footer.php";
?>