<?php
include_once "../app/_dbConnection.php";

if (isset($_POST["query"]) && isset($_POST['start']) && isset($_POST['end'])) {
    $location = $_POST['query'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $packagesInstance = new Packages();
    $data = array();

    if ($location != "") {
        $allRes = $packagesInstance->getPackagesWithQueryCount(($location));
        $res = $packagesInstance->getPackages($location, $start, $end);
        array_push($data, $allRes);
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($data, $row);
        }
    } else {
        $allRes = $packagesInstance->getPackagesCount();
        $res = $packagesInstance->getPackages("All", $start, $end);
        array_push($data, $allRes);
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($data, $row);
        }
    }
    $out = array_values($data);
    echo json_encode($out);
}
