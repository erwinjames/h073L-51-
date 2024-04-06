<?php
require 'vendor/autoload.php';
require 'openpgp-php/lib/openpgp.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'mail.hotelasiacebu.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'it@hotelasiacebu.com';
    $mail->Password   = 'sTxGLCy+ciHH';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('it@hotelasiacebu.com', 'testing');
    $mail->addAddress('manugasewinjames@gmail.com', 'Erwin James Test');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';

    // Define email body
    $html_body = 'This is the HTML message body <b>in bold!</b>';
    $text_body = 'This is the body in plain text for non-HTML mail clients';

    // Read the recipient's public key from the .asc file
    $public_key_file = 'secret_room/KUNIO_0x50A57360_public.asc';
    $public_key = file_get_contents($public_key_file);

    // Encrypt the email content using the recipient's public key
    $encrypted_html_body = encryptEmailContent($html_body, $public_key);
    $encrypted_text_body = encryptEmailContent($text_body, $public_key);

    // Include encrypted content in the email body
    $mail->Body = $encrypted_html_body . '<br>' . $encrypted_text_body;

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Function to encrypt email content using the recipient's public key
function encryptEmailContent($content, $public_key) {
    // Parse the public key
    $key = OpenPGP_Message::parse($public_key);

    // Encrypt the content
    $encrypted = $key->encrypt($content);

    // Return the encrypted content
    return $encrypted;
}
?>
