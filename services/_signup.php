<?php
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

if (isset($_POST['newUser']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $db = new Query();
    
    // Check if Username Exists
    // $ck = "SELECT user_username FROM users WHERE user_username = '" . $username . "'";
    // $res = $conn->query($ck);
    // $res = $res->num_rows;

    // if ($res > 0) {
    //     die(header("HTTP/1.0 406 Username Exists"));
    // }

    // Check if Email Exists
    // $ck = "SELECT user_email FROM users WHERE user_email = '" . $email . "'";
    // $res = $conn->query($ck);
    // $res = $res->num_rows;

    // if ($res > 0) {
    //     die(header("HTTP/1.0 406 Email Exists"));
    // }


    // Check for invalid characters in password
    if (!checkPass($pass)) {
        die(header("HTTP/1.0 406 Not Acceptable Password."));
    }

    // Paswword Encryption
    $pass = sha1($pass);

    // $sql = "INSERT INTO users(user_username, user_email, user_pass) VALUES ('$username','$email','$pass')";

    try {
        $db->getPackagesCount();
        echo json_encode("Done");
    } catch (mysqli_sql_exception) {
        die(header("HTTP/1.0 500 Internal Server Error"));
    }
}
?>