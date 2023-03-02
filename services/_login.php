<?php
if (!isset($_SESSION))
    session_start();
include_once("./_dbConnection.php");

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
    // Check for invalid characters in password
    if (!checkPass($pass)) {
        die(header("HTTP/1.0 406 Not Acceptable Password."));
    }

    // Paswword Encryption
    $pass = sha1($pass);

    $sql = "SELECT user_email, user_pass, user_verification_status FROM users WHERE user_email= '" . $email . "' AND user_pass= '" . $pass . "' ";

    try {
        $res = $conn->query($sql);
        
        $num_rows = $res->num_rows;
        if($num_rows === 1)
        {
            $ck =  $res->fetch_assoc()['user_verification_status'];
            $ck = (int)$ck;
            if($ck == 1)
            {
                $_SESSION["logged_in"] = true;
                $_SESSION["Email"] = $email;
            }
            else{
                die(header("HTTP/1.0 403 Forbidden"));
            }
        }
        else{
            die(header("HTTP/1.0 404 User Not Found"));
        }

    } catch (mysqli_sql_exception) {
        die(header("HTTP/1.0 500 Internal Server Error"));
    }
    $conn->close();
}
?>