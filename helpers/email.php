<?php
require __DIR__ . '/../vendor/autoload.php';

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
        $mail->Host       = $_ENV['SMTP_HOST'];      // smtp.gmail.com
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'];      // your gmail
        $mail->Password   = $_ENV['SMTP_PASS'];      // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];      // 587

        // SENDER
        $mail->setFrom($_ENV['SMTP_USER'], 'StayEase');

        // RECEIVER
        $mail->addAddress($toEmail, $toName);

        // EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;

        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log('SMTP Mail Error: ' . $mail->ErrorInfo);
        return false;
    }
}
