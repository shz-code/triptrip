<?php
include_once "../app/_dbConnection.php";

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

function checkPass($pass)
{
    $invalid = array("=", "*", "-", "#", "$", "'");
    $flag = true;
    for ($x = 0; $x < strlen($pass); $x++) {
        for ($i = 0; $i < sizeof($invalid); $i++) {
            if ($pass[$x] == $invalid[$i]) {
                $flag = false;
                break;
            }
        }
    }
    return $flag;
}

if (isset($_POST['newUser']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $auth = new Auth();

    // Check if username exists
    if (!$auth->checkUserName($username)) {
        die(header("HTTP/1.0 406 Username Exists"));
    }

    // Check if Email exists
    if (!$auth->checkEmail($email)) {
        die(header("HTTP/1.0 406 Email Exists"));
    }

    // Check for invalid characters in password
    if (!checkPass($pass)) {
        die(header("HTTP/1.0 406 Not Acceptable Password."));
    }

    // Password Encryption
    $pass = sha1($pass);

    if ($auth->createUser($username, $email, $pass) == '200') {
        $mailHtml = "<div>
        <h3>Welcome $username to triptrip. Travel Bangladesh like never before. <br>
        <a href='http://localhost/triptrip/listing.php'>Check our triptrip recommended packages</a> and start planning for your next trip!
        </div>";
        // smtp_mailer($email, 'Account Verification', $mailHtml);
        echo '200';
    }
}
