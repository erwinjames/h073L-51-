<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require '../vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to DEBUG_SERVER for troubleshooting
        $mail->isSMTP();
        $mail->Host       = 'mail.hotelasiacebu.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'it@hotelasiacebu.com';
        $mail->Password   = ''; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('it@hotelasiacebu.com', 'Hotel Asia');
        $mail->addAddress('manugasewinjames@gmail.com', 'Erwin James Test');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reservation Details';
        $mail->Body    = generateEmailBody($_POST);
        
        // Send the email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If the form is not submitted, redirect or display an error message
    echo "Form submission error: Method not allowed.";
}

// Function to generate email body
function generateEmailBody($formData) {
    $message = '<h1>Reservation Details</h1>';
    foreach ($formData as $key => $value) {
        $message .= '<p>' . ucfirst($key) . ': ' . $value . '</p>';
    }
    return $message;
}
?>
