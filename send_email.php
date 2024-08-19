<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $smtp_host = $_POST['smtp_host'];
    $smtp_port = $_POST['smtp_port'];
    $smtp_user = $_POST['smtp_user'];
    $smtp_pass = $_POST['smtp_pass'];
    $smtp_secure = $_POST['smtp_secure'];
    $smtp_auth = isset($_POST['smtp_auth']) ? true : false;

    $emails = explode(',', $_POST['email']); // Split the emails by comma
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (
      !isset($smtp_host) ||
      !isset($smtp_port) ||
      !isset($smtp_user) ||
      !isset($smtp_pass) ||
      !isset($smtp_secure) ||
      !isset($smtp_auth) ||
      !isset($email) ||
      !isset($subject) ||
      !isset($message)
    ) {
      echo 'Please fill all fields';
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = $smtp_auth;
        if ($smtp_auth) {
            $mail->Username   = $smtp_user;
            $mail->Password   = $smtp_pass;
        }
        // Enable verbose debug output
        $mail->SMTPDebug = 4;
        $mail->Debugoutput = function($str, $level) {
            echo "Debug level $level: $str\n";
        };

        // SMTPSecure selection
        if ($smtp_secure == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif ($smtp_secure == 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        } elseif ($smtp_secure == 'starttls') {
            $mail->SMTPSecure = 'starttls';
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_NONE;
        }
        
        $mail->Port       = $smtp_port;

        // Recipients
        $mail->setFrom($smtp_user, 'Mailer');
        foreach ($emails as $email) {
            $email = trim($email); // Trim any extra spaces
            if (!empty($email)) {
                $mail->addAddress($email);
            }
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
