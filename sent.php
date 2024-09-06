<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "Exception.php";
require_once "PHPMailer.php";
require_once "SMTP.php";

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'nourelhoudaassiddeki@gmail.com';  // Replace with your email
$mail->Password = 'Mehemetabe';         // Replace with your email password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->Port = 1025; 
    $mail->CharSet = "utf-8";

    $mail->addAddress("brouette@site.fr");
    $mail->addCC("copie@site.fr");
    $mail->addBCC("copiecachee@site.fr");
    $mail->setFrom("no-reply@site.fr");
    $mail->Subject = "Sujet du message";
    $mail->Body = "Contenu du message";

    $mail->send();
    echo "Message envoyé";
} catch (Exception $e) {
    echo "Erreur: {$mail->ErrorInfo}";
}

$to = "brouette@site.fr";
$subject = "Test de mail";
$message = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum architecto temporibus eveniet deleniti nemo sit porro nesciunt maxime nostrum aliquid perspiciatis, necessitatibus ad quibusdam suscipit. Repellendus quis nihil facere dolorem.";
$message = wordwrap($message, 70, "\r\n");
$headers = [
    "From" => "no-reply@site.fr",
    "Reply-To" => "adresse@site.fr",
    "Cc" => "copie@site.fr",
    "Bcc" => "copiecachee@site.fr",
    "Content-Type" => "text/html; charset=utf-8"
];

mail($to, $subject, $message, $headers);
?>
