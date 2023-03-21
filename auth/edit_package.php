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
<!-- Get Package id -->
<?php
if (isset($_GET['id'])) {
    $package_id = ($_GET['id']);
} else {
    $package_id = 0;
}
?>

<?php include("./components/_head.php") ?>
<!-- Package Information's -->
<?php
include_once("../app/_dbConnection.php");

$packages = new Packages();
$res = $packages->getPackage($package_id);
$package = mysqli_fetch_assoc($res);
if ($res->num_rows == 0) {
    echo '<script> location.href = "./packages.php" </script>';
} else {
    $package_name = $package['package_name'];
    $package_desc = $package['package_desc'];
    $package_start = $package['package_start'];
    $package_end = $package['package_end'];
    $package_price = $package['package_price'];
    $package_capacity = $package['package_capacity'];
    $package_location = $package['package_location'];
    $map_loc = $package['map_loc'];
    $master_image = $package['master_image'];
    $extra_image_1 = $package['extra_image_1'];
    $extra_image_2 = $package['extra_image_2'];
    $is_hotel = $package['is_hotel'];
    $is_transport = $package['is_transport'];
    $is_food = $package['is_food'];
    $is_guide = $package['is_guide'];
    // var_dump($package);
}

?>

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
            <form method="post" action="./services/_editPackage.php" class="new-package-form">
                <input type="hidden" name="package_id" value="<?php echo $package_id ?>">
                <div class="form-inner">
                    <div class="input-group">
                        <label for="name">Package Name</label>
                        <input required type="text" name="package_name" id="name" value="<?php echo $package_name ?>">
                    </div>
                    <div class="input-group">
                        <label for="desc">Package Description</label>
                        <textarea name="package_desc" rows="5" id="desc"><?php echo $package_desc ?></textarea>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="start">Package Start Date</label>
                            <input required type="date" name="start" id="start" value="<?php echo $package_start ?>">
                        </div>
                        <div class="input-group">
                            <label for="end">Package End Date</label>
                            <input required type="date" name="end" id="end" value="<?php echo $package_end ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="price">Package Price</label>
                            <input required type="number" name="price" id="price" value="<?php echo $package_price ?>">
                        </div>
                        <div class="input-group">
                            <label for="capacity">Package Capacity</label>
                            <input required type="number" name="capacity" id="capacity" value="<?php echo $package_capacity ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="loc">Package Location</label>
                            <input type="text" name="loc" id="loc" value="<?php echo $package_location ?>">
                        </div>
                        <div class="features">
                            <div class="input-group">
                                <label>Features</label>
                            </div>
                            <input type="checkbox" value="hotel" name="features[]" id="hotel" <?php if ($is_hotel == 1) echo 'checked' ?>> <label for="hotel">Hotel</label>
                            <input type="checkbox" value="transport" name="features[]" id="transport" <?php if ($is_transport == 1) echo 'checked' ?>> <label for="transport">Transport</label>
                            <input type="checkbox" value="food" name="features[]" id="food" <?php if ($is_food == 1) echo 'checked' ?>> <label for="food">Food</label>
                            <input type="checkbox" value="guide" name="features[]" id="guide" <?php if ($is_guide == 1) echo 'checked' ?>> <label for="guide">Guide</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="map">Map Location</label>
                        <input type="text" name="map" id="map" value="<?php echo $map_loc ?>">
                    </div>
                    <div class="input-group">
                        <label for="master-img">Master Image</label>
                        <input required type="text" name="master-img" id="master-img" value="<?php echo $master_image ?>">
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="ex1">Extra Image 1</label>
                            <input type="text" name="ex1" id="ex1" value="<?php echo $extra_image_1 ?>">
                        </div>
                        <div class="input-group">
                            <label for="ex2">Extra Image 2</label>
                            <input type="text" name="ex2" id="ex2" value="<?php echo $extra_image_2 ?>">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Update" name="submit" class="btn" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>