<?php
include_once("../app/_dbConnection.php");

$packagesInstance = new Packages();
$packages = $packagesInstance->getPackages('All');
$allPackagesCount = $packages->num_rows;

$curr_date = date("Y-m-d");
$timestamp2 = strtotime($curr_date);

$prevPackages = array();
$activePackages = array();

while ($row = mysqli_fetch_assoc($packages)) {

    if ($row['package_start']) {
        $package_start = $row['package_start'];
        $timestamp1 = strtotime($package_start);

        $diff = $timestamp1 - $timestamp2;

        if ($diff * 86400 > 0) {
            array_push($activePackages, $row);
        } else {
            array_push($prevPackages, $row);
        }
    } else array_push($prevPackages, $row);
}
