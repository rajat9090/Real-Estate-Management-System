<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$subject = $_POST['subject'] ?? false;
$name = $_POST['name'] ?? false;
$mail = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ? $_POST['email'] : false;
$phone = preg_match("/[0-9]+/",$_POST['phone']) ? $_POST['phone'] : false;
$message = htmlentities($_POST['message']) ?? false;

if($subject && $name && $mail&& $phone && $message) {
$mailFrom = "testmail.a234@gmail.com";
$mailName = "Real Estate"; 
$mailPassword = "fwqdnmxaoqhmykqk";

$subject = "Contact Form";
$host = "smtp.gmail.com";
$port = 587;
$mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $port;
        $mail->Username = $mailFrom;
        $mail->Password = $mailPassword;
        $mail->setFrom($mailFrom, $mailName);
        $mail->addAddress($_POST['email']);
        $mail->addAddress($mailFrom);
        $mail->IsHTML(true);
        $mail->Subject = "$subject";
        $mail->Body = "Phone Number $phone <br><br>Message to Admin <br><br>".$message;
        if($mail->send()){ 
            echo "<script type='text/javascript'>alert('Thanks For Contacting Us...');
            location='http://localhost/rems/index.php';
            </script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('oops something went wrong...');
            location='http://localhost/rems/index.php';
            </script>";
    }