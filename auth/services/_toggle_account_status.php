<?php
include_once("../../app/_dbConnection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer();
    try {
        //Server settings
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = ''; //SMTP username
        $mail->Password = ''; //SMTP password
        $mail->SMTPSecure = 'tls'; //Enable  TLS encryption
        $mail->Port = 587; //TCP port to connect to

        //Recipients
        $mail->setFrom('');
        $mail->addAddress($to); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $msg;

        if ($mail->send())
            null;
        else
            die(header("HTTP/1.0 500 Internal Server Error Email"));
    } catch (Exception $e) {
        die(header("HTTP/1.0 500 Internal Server Error Email"));
    }
}

if (isset($_POST['id'])) {

    $user_id = $_POST['id'];

    $userInstance = new Users();
    $res = $userInstance->getUser($user_id);
    $user = mysqli_fetch_assoc($res);
    if ($user['account_status'] == 1) {
        $userInstance->updateAccountStatus($user_id, 0);
        $mailHtml = "<div>
        <h3> <b>" . $user['full_name'] . "</b> we are sad to inform you that your account has been restricted. <br>
        If you think this is a mistake than contact with us as soon as possible.
        </div>";
        // smtp_mailer($user['email'], 'Account Verification', $mailHtml);
    } else {
        $userInstance->updateAccountStatus($user_id, 1);
    }
    echo "<script> location.href = '../users.php' </script>";
}
