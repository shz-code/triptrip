<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "../app/_dbConnection.php";

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
if (isset($_POST["loginUser"]) && isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $auth = new Auth();

    // Check for invalid characters in password
    if (!checkPass($pass)) {
        die(header("HTTP/1.0 406 Not Acceptable Password."));
    }

    if (!$auth->checkAccountStatus($email)) {
        die(header("HTTP/1.0 403 Account Deactivated"));
    }



    // Paswword Encryption
    $pass = sha1($pass);

    return json_encode($auth->loginUser($email, $pass));
}
