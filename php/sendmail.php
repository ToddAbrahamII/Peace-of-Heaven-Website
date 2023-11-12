<html>
    <head>
        <title>Email Send</title>
    </head>
    <body>
        <p>Sending email.</p>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$rdir = str_replace("\\", "/", __DIR__);                    //Root Dir
require '/usr/share/php/PHPMailer/src/Exception.php';
require '/usr/share/php/PHPMailer/src/PHPMailer.php';
require '/usr/share/php/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "email-smtp.us-east-2.amazonaws.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "AKIAWVM7JJ4E5Z7MKJ6S";
    $mail->Password = "BIYk3onGZgFHKn3+BazLoTcfJo/t76fCnBbkIXTVRcro";
    $mail->SetFrom("noreply@peaceofheavenpetcare.net");
    $mail->Subject = "Test";
    $mail->Body = "This is a real message from the automated service.";
    $mail->AddAddress("pohpc.email.service@gmail.com");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
?>
    </body>
</html>