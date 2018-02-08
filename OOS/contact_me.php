<?php
require 'PHPMailer.php';
require 'Exception.php';
require 'SMTP.php';

// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['company'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
   echo "No arguments Provided!";
   return false;
}

$to = 'pgowdy1@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$from = 'noreply@builders-steel.com'; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$company = strip_tags(htmlspecialchars($_POST['company']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$mail = new PHPMailer(true);
try 
{
    // $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'localhost';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    // $mail->Username = 'builderssender';                 // SMTP username
    // $mail->Password = 'S3nd1NgTH3M@ilN0w';                           // SMTP password
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($from, 'Mailer');
    $mail->addAddress($to, $name);     // Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email from builders-steel.com';
    $mail->Body = "Message: ".$message."</br>"."Company:".$company;

    $mail->send();
    echo 'Message has been sent';
} 
catch (Exception $e) 
{
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

return true;

?>