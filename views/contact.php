<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>




<section class="hero">
    <h1>Get in Touch</h1>
    <p>We're here to assist you with any questions.</p>
</section>

<section class="contact-container">

    <form class="contact-form">
        <label>Your name</label>
        <input type="text" placeholder="Enter your full name">

        <label>Your email</label>
        <input type="email" placeholder="you@example.com">

        <label>Subject</label>
        <input type="text" placeholder="Your inquiry topic">

        <label>Message</label>
        <textarea placeholder="Type your message here"></textarea>

        <button class="submit-btn">Submit</button>
    </form>

    <div class="map">
        <img src="../images/homeimages/mapimages.jpeg" alt="Map">
    </div>

</section>

<section class="info-box">
    <div class="info">
        <h3>Call Us</h3>
        <p>+33 1 23 45 67 89 +33 1 98 76 54 32</p>
    </div>

    <div class="info">
        <h3>Email Us</h3>
        <p><a href="mailto:support@studentaccommodation.com">support@studentaccommodation.com</a></p>
    </div>

    <div class="info">
        <h3>Visit Our Office</h3>
        <p>123 Rue de Paris Paris,<br>France 75001</p>
    </div>
</section>

</body>
</html>


<!-- <!DOCTYPE html>
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
</html> -->