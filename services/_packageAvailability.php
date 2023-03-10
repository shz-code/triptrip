<?php
include_once "../app/_dbConnection.php";

if (isset($_POST['package_id'])) {
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["logged_in"])) {
        die(header("HTTP/1.0 403 Forbidden"));
    }

    // Check if the package is already finished or not
    $package_id = $_POST['package_id'];
    $packagesInstance = new Packages();
    $res = $packagesInstance->getPackage($package_id);
    $row = mysqli_fetch_assoc($res);

    $package_start = $row['package_start'];
    $curr_date = date("Y-m-d");

    $datetime1 = strtotime($package_start);
    $datetime2 = strtotime($curr_date);

    $diff = $datetime1 - $datetime2;
    if ($diff * 86400 < 1) {
        die(header("HTTP/1.0 406 Finished"));
    }

    // Check if package is already full or not
    $package_capacity = $row['package_capacity'];
    $package_booked = $row['package_booked'];
    $available_slots = $package_capacity - $package_booked;

    echo json_encode($available_slots);
}
