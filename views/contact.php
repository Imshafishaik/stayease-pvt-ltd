<?php
require __DIR__ . "/../config/database.php";

include "../common/header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CreativeSpace</title>
    <link href="../css/contact.css" rel="stylesheet" type="text/css" />
</head>
<body>


    <div class="contact_section">
        <form>
            <h1>
                Contact Form
            </h1>
            <div class="contact_input">
            <label>Your Name</label><br>
            <input type="text" placeholder="Enter your full name" />
            </div>
            <div class="contact_input">
            <label>Your Email</label><br>
            <input type="text" placeholder="you@gmail.com" />
            </div>

            <div class="contact_input">
            <label>Subject</label><br>
            <input type="text" placeholder="Your inquiry topic" />
            </div>

            <div class="contact_input">
            <label>Message</label><br>
            <input type="text" placeholder="Type your message here" />
            </div>
            <button type="submit">Submit</button>
        </form>
        <div>
            <img src="../images/contact/iseplocation.webp" />
        </div>
    </div>
</body>
</html>