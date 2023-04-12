<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("../../app/_dbConnection.php");

if (isset($_POST['desc']) && isset($_POST['rating']) && isset($_POST['package_id'])) {

    $desc = $_POST['desc'];
    $rating = $_POST['rating'];
    $package_id = $_POST['package_id'];

    $testimonialInstance = new Testimonials();
    $packageInstance = new Packages();
    $package = $packageInstance->getPackage($package_id);
    $package = mysqli_fetch_assoc($package);
    $prevRating = $package['package_rating'];
    if ($prevRating == 0) {
        $newRating = $rating;
    }
    else $newRating = ($prevRating + $rating) / 2;
    $packageInstance->updateRating($package_id, $newRating);
    echo $testimonialInstance->addTestimonial($desc, $_SESSION['user_id'], $package_id, $rating);
    echo "<script> location.href = '../user_dashboard.php' </script>";
}
