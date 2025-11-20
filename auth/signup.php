<?php
require __DIR__ . "/../config/database.php";
require __DIR__ . '/../vendor/autoload.php';


include "../common/header.php";


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// $firebase = (new Factory())
//     ->withServiceAccount(__DIR__ . '/../stayease-95aca-firebase-adminsdk-fbsvc-2d09962c4a.json');

// $storage = $firebase->createStorage();

// $bucket = $storage->getBucket();

// $name     = $_POST['name'];
// $email    = $_POST['email'];
// $password = $_POST['password']; 
// $role     = $_POST['role'];


// if ($name && $email && $password && $role && isset($_FILES['passport_upload']) && isset($_FILES['visa_upload'])) {
//     $passport_upload     = $_FILES['passport_upload']['tmp_name'];
//     $visa_upload     = $_FILES['visa_upload']['tmp_name'];

//     $passportfilename  = time() . "_" . $_FILES['passport_upload']['name'];
//     $visafilename  = time() . "_" . $_FILES['visa_upload']['name'];

//     $bucket->upload(
//         fopen($passport_upload, 'r'),
//         [
//             'name' => 'uploads/' . $passportfilename,
//             'predefinedAcl' => 'publicRead'
//         ]
//     );

//     $bucket->upload(
//         fopen($visa_upload, 'r'),
//         [
//             'name' => 'uploads/' . $visafilename,
//             'predefinedAcl' => 'publicRead'
//         ]
//     );

//     $imageUrl1 = "https://storage.googleapis.com/" 
//                 . $bucket->name() 
//                 . "/uploads/" 
//                 . $passportfilename;

//     $imageUrl2 = "https://storage.googleapis.com/" 
//                 . $bucket->name() 
//                 . "/uploads/" 
//                 . $visafilename;
// }

// $sql = "INSERT INTO users (name, email, password, role, user_doc_one,user_doc_two)
//         VALUES (:name, :email, :password, :role, :passport_upload, :visa_upload)";

// $stmt = $pdo->prepare($sql);

// $stmt->execute([
//     ':name'  => $name,
//     ':email' => $email,
//     ':password' => $password,
//     ':role'  => $role,
//     ':user_doc_one' => $imageUrl1,
//     ':user_doc_two' => $imageUrl2,
// ]);

// echo "<h2>Signup Successful!</h2>";
// echo "<p>Image URL: $imageUrl</p>";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
        <!-- <header>
            <nav class="navbar">
                <a href="login.php" class="nav-link">Login</a> 
                <a href="signup.php" class="nav-link">Register</a>
                <a href="#" class="nav-link">Listings</a>
                <a href="#" class="nav-link">Admin</a>
            </nav>
        </header> -->
    <main class="main-content">
        <div class="forms-container">
            <div class="form-column">
                <div class="form-wrapper">
                    <h2>Register a New Student Account</h2>
                    <form action="signup.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="name" placeholder="Confirm Password" required>
                        <select name="usertype">
                            <option>Student</option>
                            <option>House Owner</option>
                            <option>Admin</option>
                        </select>
                        <div class="file-upload">
                            <input type="file" id="passport-upload" name="passport_upload" hidden>
                            <label for="passport-upload"><span>Upload Passport</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="file-upload">
                            <input type="file" id="visa-upload" name="visa_upload" hidden>
                            <label for="visa-upload"><span>Upload Visa</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <button type="submit" class="btn btn-register">Register</button>
                    </form>
                    <p class="switch-form">Already Have an account? <a href="login.php">Login</a></p>
                </div>
            </div>

            <!-- <div class="form-column">
                <div class="form-wrapper">
                    <h2>Register as House Owner</h2>
                    <form>
                        <input type="text" placeholder="Full Name" required>
                        <input type="email" placeholder="Email" required>
                        <input type="password" placeholder="Password" required>
                        <input type="password" placeholder="Confirm Password" required>
                        <select>
                            <option>Dropdown</option>
                        </select>
                        <div class="file-upload">
                            <input type="file" id="docs-upload" hidden>
                            <label for="docs-upload"><span>Upload House Documents</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="file-upload">
                            <input type="file" id="reg-upload" hidden>
                            <label for="reg-upload"><span>Upload House Registration</span><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <button type="submit" class="btn btn-register">Register</button>
                    </form>
                    <p class="switch-form">Already Have an account? <a href="Login.html">Login</a></p>
                </div>
            </div> -->
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="contact-info">
                <h4>Contact Us</h4>
                <p>Email: support@accommodateme.com</p>
                <p>Phone: +33 1 23 45 67 89</p>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>