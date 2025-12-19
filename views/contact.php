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

</body>
</html>

<?php
include "./views/footer.php"
?>

