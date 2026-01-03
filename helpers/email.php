<?php
require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendBookingMail(
    string $toEmail,
    string $toName,
    string $subject,
    string $htmlBody
): bool {

    $mail = new PHPMailer(true);

    try {
        // SMTP CONFIG
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'];
        $mail->Password   = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];

        // SENDER
        $mail->setFrom($_ENV['SMTP_USER'], 'StayEase');

        // RECEIVER
        $mail->addAddress($toEmail, $toName);

        // EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = $subject;
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

        return true;   

    } catch (Exception $e) {
        error_log('SMTP Mail Error: ' . $mail->ErrorInfo);

        return false;  
    }
}

