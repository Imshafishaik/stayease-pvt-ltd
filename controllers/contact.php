<?php
require __DIR__ . "/../models/contact.php";
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "/../helpers/contactemail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;





class ContactController {

    private $model;

    public function __construct($pdo) {
        $this->model = new ContactModel($pdo);
    }

    public function contact() {
        require __DIR__ . "/../views/contact.php";
    }

    public function emailSend() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /index.php?action=contact");
            exit;
        }

        $name    = trim($_POST['name']);
        $email   = trim($_POST['email']);
        $subject = trim($_POST['subject']);
        $message = trim($_POST['message']);

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            die("All fields are required.");
        }

        $mail = new PHPMailer(true);

        try {
            // SMTP config
            $mail->isSMTP();
            $mail->Host       = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USER'];
            $mail->Password   = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['SMTP_PORT'];

            // Sender & Receiver
            $mail->setFrom($_ENV['SMTP_USER'], 'StayEase Contact');
            $mail->addAddress($_ENV['ADMIN_EMAIL']); // where you want messages

            // Email content
            $mail->isHTML(true);
            $mail->Subject = "Contact Form: $subject";
            $mail->Body = "
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <style>
    body {
      background-color: #f4f6f8;
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .header {
      background: #2d89ef;
      color: #ffffff;
      padding: 20px;
      text-align: center;
    }
    .content {
      padding: 25px;
      color: #333333;
    }
    .content p {
      line-height: 1.6;
      margin-bottom: 15px;
    }
    .content strong {
      color: #000000;
    }
    .message-box {
      background: #f4f6f8;
      padding: 15px;
      border-radius: 5px;
      margin-top: 10px;
      white-space: pre-line;
    }
    .footer {
      text-align: center;
      font-size: 13px;
      color: #777777;
      padding: 15px;
      background: #fafafa;
    }
  </style>
</head>
<body>

  <div class='email-container'>
    <div class='header'>
      <h2>📩 New Contact Message</h2>
      <p>StayEase Platform</p>
    </div>

    <div class='content'>
      <p><strong>Name:</strong> {$name}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Subject:</strong> {$subject}</p>

      <p><strong>Message:</strong></p>
      <div class='message-box'>
        {$message}
      </div>
    </div>

    <div class='footer'>
      © " . date('Y') . " StayEase. All rights reserved.
    </div>
  </div>

</body>
</html>
";


            $mail->send();

            header("Location: /index.php?action=contact");
            exit;

        } catch (Exception $e) {
            error_log("Mail error: {$mail->ErrorInfo}");
            header("Location: /index.php?action=contact");
            exit;
        }
    }

}