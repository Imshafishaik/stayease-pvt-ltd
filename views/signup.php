<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   <main class="main-content">
    <div class="forms-container">
        <div class="form-column">
            <div class="form-wrapper">
                <h2>Register a New Student Account</h2>
                <form id="signupForm" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>

                    <select name="select_user_type" id="user-type" required>
                        <option value="">Select User Type</option>
                        <option value="student">Student</option>
                        <option value="owner">House Owner</option>
                    </select>

                    <div id="student-files" style="display:none;">
                        <input type="file" name="passport" id="passport-upload" >
                        <input type="file" name="visa" id="visa-upload" >
                    </div>

                    <div id="house-files" style="display:none;">
                        <input type="file" name="house-document" id="house-document-upload" >
                        <input type="file" name="house-registration" id="house-registration-upload" >
                    </div>

                    <button type="submit" class="btn btn-register">Register</button>
                </form>

                <div id="response"></div>
                <p class="switch-form">Already Have an account? <a href="/index.php?action=loginpage">Login</a></p>
            </div>
        </div>
    </div>
</main>


<!-- <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-storage-compat.js"></script> -->

<script>
const userTypeSelect = document.getElementById("user-type");
const studentFiles = document.getElementById("student-files");
const houseFiles = document.getElementById("house-files");

userTypeSelect.addEventListener("change", function () {
    if (this.value === "student") {
        studentFiles.style.display = "block";
        houseFiles.style.display = "none";
    } else if (this.value === "owner") {
        studentFiles.style.display = "none";
        houseFiles.style.display = "block";
    } else {
        studentFiles.style.display = "none";
        houseFiles.style.display = "none";
    }
});

document.getElementById("signupForm").addEventListener("submit", function(e){
    e.preventDefault();
    const responseEl = document.getElementById("response");
    responseEl.innerText = "";

    const formData = new FormData(this);

    fetch("/index.php?action=signup", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            window.location.href = "/index.php?action=loginpage";
        } else {
            responseEl.innerText = data.message;
            responseEl.style.color = "red";
        }
    })
    .catch(err => {
        console.error(err);
        responseEl.innerText = "Error uploading files.";
        responseEl.style.color = "red";
    });
});
</script>


<!-- <script>

const firebaseConfig = {
    apiKey: "AIzaSyC3J1rrO2zZdD2V8CQRRbZV_ct6xcQVOhQ",
    authDomain: "stayease-95aca.firebaseapp.com",
    projectId: "stayease-95aca",
    storageBucket: "stayease-95aca.appspot.com",
    messagingSenderId: "901757039156",
    appId: "1:901757039156:web:750c53416531122cd75061"
  };

  firebase.initializeApp(firebaseConfig);
  const storage = firebase.storage();

const userTypeSelect = document.getElementById("user-type");
const studentFiles = document.getElementById("student-files");
const houseFiles = document.getElementById("house-files");

userTypeSelect.addEventListener("change", function () {
    if (this.value === "student") {
        studentFiles.style.display = "block";
        houseFiles.style.display = "none";

        // optional: clear house files
        document.getElementById("house-document-upload").value = "";
        document.getElementById("house-registration-upload").value = "";

    } else if (this.value === "owner") {
        studentFiles.style.display = "none";
        houseFiles.style.display = "block";

        // optional: clear student files
        document.getElementById("passport-upload").value = "";
        document.getElementById("visa-upload").value = "";
    } else {
        studentFiles.style.display = "none";
        houseFiles.style.display = "none";
    }
});



userTypeSelect.addEventListener("change", function () {
    const isStudent = this.value === "student";

    document.getElementById("passport-upload").required = isStudent;
    document.getElementById("visa-upload").required = isStudent;

    document.getElementById("house-document-upload").required = !isStudent;
    document.getElementById("house-registration-upload").required = !isStudent;
});


function showError(message) {
    const response = document.getElementById("response");
    response.style.color = "red";
    response.innerText = message;
}

function clearError() {
    const response = document.getElementById("response");
    response.innerText = "";
}


document.getElementById("signupForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    clearError();

    const name = this.name.value.trim();
    const email = this.email.value.trim();
    const password = this.password.value;
    const confirmPassword = document.getElementById("confirm-password").value;
    const userType = document.getElementById("user-type").value;

    // ---------- BASIC VALIDATION ----------
    if (!name || !email || !password || !confirmPassword || !userType) {
        showError("All fields are required");
        return;
    }

    if (password.length < 8) {
        showError("Password must be at least 8 characters");
        return;
    }

    if (password !== confirmPassword) {
        showError("Passwords do not match");
        return;
    }

    // ---------- FILE VALIDATION ----------
    let file1 = null;
    let file2 = null;

    if (userType === "student") {
        file1 = document.getElementById("passport-upload").files[0];
        file2 = document.getElementById("visa-upload").files[0];

        if (!file1 || !file2) {
            showError("Passport and Visa are required for students");
            return;
        }
    }

    if (userType === "owner") {
        file1 = document.getElementById("house-document-upload").files[0];
        file2 = document.getElementById("house-registration-upload").files[0];

        if (!file1 || !file2) {
            showError("House documents are required for owners");
            return;
        }
    }

    // ---------- FIREBASE UPLOAD ----------
    const uploadFile = async (file, folder) => {
        const ref = storage.ref(`${folder}/${Date.now()}_${file.name}`);
        await ref.put(file);
        return await ref.getDownloadURL();
    };

    try {
        let docOneURL = null;
        let docTwoURL = null;

        if (userType === "student") {
            docOneURL = await uploadFile(file1, "students/passports");
            docTwoURL = await uploadFile(file2, "students/visas");
        }

        if (userType === "owner") {
            docOneURL = await uploadFile(file1, "owners/house_documents");
            docTwoURL = await uploadFile(file2, "owners/house_registrations");
        }

        const formData = new FormData(this);
        formData.append("doc_one", docOneURL);
        formData.append("doc_two", docTwoURL);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?action=signup", true);
        xhr.onload = function () {
            const res = JSON.parse(xhr.responseText);
            if (res.status === "success") {
                window.location.href = "/index.php?action=loginpage";
            } else {
                showError(res.message);
            }
        };
        xhr.send(formData);

    } catch (error) {
        console.error(error);
        showError("File upload failed. Try again.");
    }
});
</script> -->



</body>
</html>

<?php
include "./views/footer.php"
?>