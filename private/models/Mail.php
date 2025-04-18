<?php
//Import PHPMailer classes into the global namespace
require PHPMAILER . '/PHPMailer.php';
require PHPMAILER . '/SMTP.php';
require PHPMAILER . '/Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
            $mail->Port       = SMTP_SETTINGS['smtp_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(SMTP_SETTINGS['from_email'], SMTP_SETTINGS['from_name']);
            $mail->addAddress($toEmail, $toName);     //Add a recipient
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
           
            if ($mail->send()) {
                return true;
            } else {
                return "Mailer Error: " . $mail->ErrorInfo; // Show error message
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    //send admin the dashboard link to continue
    public static function sendAdminDashboard($toEmail,$token)
    {
        //load the teamplate
        $template=file_get_contents(TEMPLATEROOT.'/sendAdminToDashboard.html');
        //create link
        $link= LOGIN.'/verifyEmail?token='.$token;

        //replace placeholders
        $template=str_replace('{{verification_link}}',$link,$template);
        $template=str_replace('{{year}}',date('Y'),$template);

        $subject="Login to Dashboard";

        return self::sendMail($toEmail,'',$subject,$template);
    }
    //send the login page link to the regiatered user
    public static function sendLoginToRegistered($toEmail,$token)
    {
        //load the template
        $template=file_get_contents(TEMPLATEROOT.'/sendLoginToRegistered.html');
        //create link
        $link=ADMIN.'/verifyEmail?token='.$token;
        //replace placeholders
        $template=str_replace('{{verification_link}}',$link,$template);
        $template=str_replace('{{year}}',date('Y'),$template);

        $subject="Login Now";

        return self::sendMail($toEmail,'',$subject,$template);

    }
    //send the link to the customer complaint
    public static function sendCustomerComplaint($complaint_id,$date,$toEmail)
    {
        //load the template
        $template=file_get_contents(TEMPLATEROOT.'/sendCustomerComplaintToAdmin.html');
        //create the link
        $link=ADMIN.'/viewComplaint?id='.$complaint_id;
        //replace placeholders
        $template=str_replace('{{review_link}}',$link,$template);
        // $template=str_replace('{{customer_name}}',$cus_name,$template);
        $template=str_replace('{{date}}',$date,$template);
        $template=str_replace('{{complaint_id}}',$complaint_id,$template);
        $template=str_replace('{{year}}',date('Y'),$template);
        $subject="Customer Complaints";

        return self::sendMail($toEmail,'',$subject,$template);


    }
}



