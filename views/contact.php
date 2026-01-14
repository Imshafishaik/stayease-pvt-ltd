<?php include "./views/header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>

<section class="hero">
    <h1>Get in Touch</h1>
    <p>We're here to assist you with any questions.</p>
</section>

<section class="contact-container">

<form class="contact-form" method="POST" action="/index.php?action=emailSend">

    <label>Your name</label>
    <input type="text" name="name" placeholder="Enter your full name" required>

    <label>Your email</label>
    <input type="email" name="email" placeholder="you@example.com" required>

    <label>Subject</label>
    <input type="text" name="subject" placeholder="Your inquiry topic" required>

    <label>Message</label>
    <textarea name="message" placeholder="Type your message here" required></textarea>

    <button class="submit-btn" type="submit">Submit</button>
  </form>

<p id="alertBox" style="display:none;"></p>

<div class="map">
    <img src="../images/homeimages/mapimages.jpeg" alt="Map">
</div>

</section>

<!-- <script>
document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/index.php?action=emailSend", {
        method: "POST",
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        const alertBox = document.getElementById("alertBox");
        alertBox.style.display = "block";

        if (data.status === "success") {
            alertBox.innerHTML = "✅ " + data.message;
            alertBox.style.color = "green";
            this.reset();
        } else {
            alertBox.innerHTML = "❌ " + data.message;
            alertBox.style.color = "red";
        }
    }).catch(() => alert("Server error"));
});
</script> -->

</body>
</html>

<?php include "./views/footer.php"; ?>
