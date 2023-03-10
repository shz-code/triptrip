<!DOCTYPE html>
<html lang="en">

<!-- Secure route for only admin -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["logged_in"])) {
    echo '<script> location.href = "./index.php" </script>';
}
if (!isset($_SESSION["is_admin"])) {
    echo '<script> location.href = "../user_dashboard.php" </script>';
}
?>
<?php include("./components/_head.php") ?>
<?php include_once("../app/_dbConnection.php") ?>

<body>
    <div class="side-menu">
        <ul>
            <li><a href="./admin_dashboard.php"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a></li>
            <li><a href="./users.php"><i class="fa-solid fa-users"></i><span>Users</span></a></li>
            <li class="active"><a href="./packages.php"><i class="fa-solid fa-cube"></i><span>Packages</span></a> </li>
            <li><a href="./sales.php"><i class="fa-solid fa-money-bill-trend-up"></i><span>Sales</span></a> </li>
        </ul>
    </div>
    <div class="container">
        <?php include("./components/_header.php") ?>
        <div class="content">
            <form method="post" action="./services/_newPackage.php" class="new-package-form">
                <div class="form-inner">
                    <div class="input-group">
                        <label for="name">Package Name</label>
                        <input required type="text" name="package_name" id="name">
                    </div>
                    <div class="input-group">
                        <label for="desc">Package Description</label>
                        <textarea name="package_desc" rows="5" id="desc"></textarea>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="start">Package Start Date</label>
                            <input required type="date" name="start" id="start">
                        </div>
                        <div class="input-group">
                            <label for="end">Package End Date</label>
                            <input required type="date" name="end" id="end">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="price">Package Price</label>
                            <input required type="number" name="price" id="price">
                        </div>
                        <div class="input-group">
                            <label for="capacity">Package Capacity</label>
                            <input required type="number" name="capacity" id="capacity">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="loc">Package Location</label>
                            <input type="text" name="loc" id="loc">
                        </div>
                        <div class="features">
                            <div class="input-group">
                                <label>Features</label>
                            </div>
                            <input type="checkbox" value="hotel" name="features[]" id="hotel"> <label for="hotel">Hotel</label>
                            <input type="checkbox" value="transport" name="features[]" id="transport"> <label for="transport">Transport</label>
                            <input type="checkbox" value="food" name="features[]" id="food"> <label for="food">Food</label>
                            <input type="checkbox" value="guide" name="features[]" id="guide"> <label for="guide">Guide</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="map">Map Location</label>
                        <input type="text" name="map" id="map">
                    </div>
                    <div class="input-group">
                        <label for="master-img">Master Image</label>
                        <input required type="text" name="master-img" id="master-img">
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="ex1">Extra Image 1</label>
                            <input type="text" name="ex1" id="ex1">
                        </div>
                        <div class="input-group">
                            <label for="ex2">Extra Image 2</label>
                            <input type="text" name="ex2" id="ex2">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Submit" name="submit" class="btn" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>