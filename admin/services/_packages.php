<?php
include_once("../app/_dbConnection.php");

$packagesInstance = new Packages();
$packages = $packagesInstance->getPackages('All');
$allPackagesCount = $packages->num_rows;

$curr_date = date("Y-m-d");
$datetime2 = date_create($curr_date);

$prevPackages = array();
$activePackages = array();

while ($row = mysqli_fetch_assoc($packages)) {

    if ($row['package_start']) {
        $package_start = $row['package_start'];
        $datetime1 = date_create($package_start);

        $diff = date_diff($datetime1, $datetime2);

        if ($diff->d > 0) {
            array_push($activePackages, $row);
        } else {
            array_push($prevPackages, $row);
        }
    } else array_push($prevPackages, $row);
}
