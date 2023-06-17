<?php
include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../app-assets/library/PHPMailer/src/Exception.php';
require '../app-assets/library/PHPMailer/src/PHPMailer.php';
require '../app-assets/library/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// Load the HTML email template
$template = file_get_contents('./email_template/verify.php');

// Replace the placeholders with dynamic data
$template = str_replace('{user_name}', 'test', $template);
$template = str_replace('{verification_link}', 'http://localhost:8090', $template);
$template = str_replace('{reply_to}', $_config['email']['reply'], $template);


try {
    // Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $_config['email']['host'];                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $_config['email']['username'];                // SMTP username
    $mail->Password = $_config['email']['password'];                        // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom($_config['email']['sender'], 'Sender');
    $mail->addAddress('javelunajames255@gmail.com', 'Recipient');     // Add a recipient
    $mail->addReplyTo($_config['email']['reply'], 'Information');

     // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Account Test';
     $mail->Body    = $template;


    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo 'Email sending failed: ' . $mail->ErrorInfo;
}

?>