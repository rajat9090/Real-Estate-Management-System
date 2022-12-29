<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["tt"]))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/PHPMailer.php";


$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username="testmail.a234@gmail.com";
$mail->Password='test@123';
$mail->Port=465;
$mail->SMTPSecure = "ssl";

$mail->isHTML(true);
$mail->setFrom($tt);
$mail->addAddress("testmail.a234@gmail.com");
$mail->Subject=("$tt ($subject)");
$mail->Body =$message;
if ( $mail->send() ) {
    $status="success";
    $response="Email is sent!";
}else{
    $status="failed";
    $response="Something is wrong: <br>".$mail->ErrorInfo;
}
exit(json_encode(array("status"=>$status,"response"=>$response)));
}
?>