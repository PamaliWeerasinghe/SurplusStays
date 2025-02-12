<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

class Mail
{
    public static function sendMail($toEmail,$toName,$subject,$body)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = SMTP_SETTINGS['smtp_host'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = SMTP_SETTINGS['smtp_auth'];                                   //Enable SMTP authentication
            $mail->Username   = SMTP_SETTINGS['smtp_username'];                     //SMTP username
            $mail->Password   = SMTP_SETTINGS['smtp_password'];                               //SMTP password
            $mail->SMTPSecure = SMTP_SETTINGS['smtp_secure']==='tls'? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(SMTP_SETTINGS['from_email'], SMTP_SETTINGS['from_name']);
            $mail->addAddress('sakiththewmika@gmail.com', 'Sakith Thewmika');     //Add a recipient
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


