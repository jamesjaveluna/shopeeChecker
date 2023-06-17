<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/app-assets/library/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/app-assets/library/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/app-assets/library/PHPMailer/src/SMTP.php';

class Mailer {
    protected $mail;

    public function __construct() {
        include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';
        $this->mail = new PHPMailer(true);

        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = $_config['email']['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_config['email']['username'];
        $this->mail->Password = $_config['email']['password']; 
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function sendEmail($to, $subject, $body, $altBody = '') {
        include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';
        try {
            $this->mail->isHTML(true);  
            $this->mail->setFrom($_config['email']['sender'], $_config['email']['name']);
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = $altBody;

            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}