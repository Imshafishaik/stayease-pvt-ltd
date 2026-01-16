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
                    <li><a href="/index.php?action=adm_terms_conditions">Terms & Conditions</a></li>                               
                </ul>
            </div>
            <section class="content">
            <h1>Terms & Conditions Management</h1>
            <form id="termsForm">
                <textarea id="editor" name="content">
                    <?= htmlspecialchars($terms) ?>
                </textarea>

                <br>
                <button type="submit">Save</button>
            </form>
            <div id="response"></div>
            </section>
    </main>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <script>
let editorInstance;

ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', 'link', '|',
            'bulletedList', 'numberedList', '|',
            'blockQuote', 'insertTable', '|',
            'undo', 'redo'
        ]
    })
    .then(editor => {
        editorInstance = editor;
    })
    .catch(error => {
        console.error(error);
    });

const form = document.getElementById("termsForm");
const responseEl = document.getElementById("response");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    const htmlContent = editorInstance.getData();

    const formData = new FormData();
    formData.append("content", htmlContent);

    fetch("/index.php?action=edit_terms_conditions", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            responseEl.innerText = "Terms updated successfully";
            responseEl.style.color = "green";
        } else {
            responseEl.innerText = data.message;
            responseEl.style.color = "red";
        }
    })
    .catch(() => {
        responseEl.innerText = "Something went wrong";
        responseEl.style.color = "red";
    });
});
</script>

</body>
</html>