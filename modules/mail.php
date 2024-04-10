<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.hotelasiacebu.com';               //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'it@hotelasiacebu.com';                 //SMTP username
    $mail->Password   = 'sTxGLCy+ciHH';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('it@hotelasiacebu.com', 'Hotel Asia');
    $mail->addAddress('manugasewinjames@gmail.com', 'Erwin James Test');     //Add a recipient

    // Content
    $message = '<h1>Reservation Details</h1>';
    $message .= '<p>Account Name: ' . $_POST['acount_name'] . '</p>';
    $message .= '<p>Primary Name: ' . $_POST['p_name'] . '</p>';
    $message .= '<p>Gender: ' . $_POST['gender'] . '</p>';
    $message .= '<p>Address: ' . $_POST['address'] . '</p>';
    $message .= '<p>Telephone Number: ' . $_POST['telnum'] . '</p>';
    $message .= '<p>Fax Number: ' . $_POST['faxnum'] . '</p>';
    $message .= '<p>Email: ' . $_POST['email'] . '</p>';
    $message .= '<p>Confirm Email: ' . $_POST['cmail'] . '</p>';
    $message .= '<p>Check In/Out: ' . $_POST['CheckInOut'] . '</p>';
    $message .= '<p>Card Name: ' . $_POST['card_name'] . '</p>';
    $message .= '<p>Card Number: ' . $_POST['card_number'] . '</p>';
    $message .= '<p>Card Expiry Month: ' . $_POST['card_expiry_month'] . '</p>';
    $message .= '<p>Card Expiry Year: ' . $_POST['card_expiry_year'] . '</p>';
    $message .= '<p>Card CVV: ' . $_POST['card_cvv'] . '</p>';
    $message .= '<p>Number of Adults: ' . $_POST['num_of_adults'] . '</p>';
    $message .= '<p>Number of Children: ' . $_POST['num_of_child'] . '</p>';
    $message .= '<p>Room Type: ' . $_POST['roomType'] . '</p>';
    $message .= '<p>Number of Rooms: ' . $_POST['num_rooms'] . '</p>';
    $message .= '<p>Number of Guests: ' . $_POST['numOfguest'] . '</p>';
    $message .= '<p>Preferred Bed Type: ' . $_POST['preBedType'] . '</p>';
    $message .= '<p>Extra Bed: ' . $_POST['extrabed'] . '</p>';
    $message .= '<p>Flight and Arrival Details: ' . $_POST['flightAndArrival'] . '</p>';
    // Add more fields as needed
    
    $mail->isHTML(true);                           // Set email format to HTML
    $mail->Subject = 'Reservation Details';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
