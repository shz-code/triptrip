<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("../../app/_dbConnection.php");

if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email'])) {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $userInstance = new Users();
    echo $userInstance->updateUser($_SESSION['user_id'], $email, $phone, $name, $address);

    echo "<script> location.href = '../user_dashboard.php' </script>";
}
