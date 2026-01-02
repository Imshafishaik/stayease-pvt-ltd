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
                            </div> <div id="house-files" style="display:none;">
                                 <input type="file" name="house-document" id="house-document-upload" > 
                                 <input type="file" name="house-registration" id="house-registration-upload" > 
                                </div> 
                                <button type="submit" class="btn btn-register">Register</button>
                             </form> <div id="response"></div> 
                             <p class="switch-form">Already Have an account? <a href="/index.php?action=loginpage">Login</a></p>
                             </div> 
                            </div> 
                        </div> 
                    </main> 
                    <!-- <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script> <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-storage-compat.js"></script> --> 
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
                         fetch("/index.php?action=signup", { method: "POST", body: formData }).then(res => res.json()).then(data => { if(data.status === "success"){ window.location.href = "/index.php?action=loginpage"; } else { responseEl.innerText = data.message; responseEl.style.color = "red"; } }).catch(err => { console.error(err); responseEl.innerText = "Error uploading files."; responseEl.style.color = "red"; }); }); </script> 
                         </body>
                          </html> 
                          <?php include "./views/footer.php" ?>