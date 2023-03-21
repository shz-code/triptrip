<!DOCTYPE html>
<html lang='en'>

<!-- Secure route for only admin -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['logged_in'])) {
    echo "<script> location.href = './index.php' </script>";
}
if (!isset($_SESSION['is_admin'])) {
    echo "<script> location.href = '../user_dashboard.php' </script>";
}
?>

<?php include('./components/_head.php') ?>
<!-- Package filters -->
<?php include('./services/_packages.php') ?>

<body>
    <div class='side-menu'>
        <ul>
            <li><a href='./admin_dashboard.php'><i class='fa-solid fa-chart-line'></i><span>Dashboard</span></a></li>
            <li><a href='./users.php'><i class='fa-solid fa-users'></i><span>Users</span></a></li>
            <li class='active'><a href=''><i class='fa-solid fa-cube'></i><span>Packages</span></a> </li>
            <li><a href='./sales.php'><i class='fa-solid fa-money-bill-trend-up'></i><span>Sales</span></a> </li>
        </ul>
    </div>
    <div class='container'>
        <?php include('./components/_header.php') ?>
        <div class='content'>
            <div class='cards'>
                <div class='card'>
                    <div class='box'>
                        <h1><?php echo $allPackagesCount ?></h1>
                        <h3>Total Package(s)</h3>
                    </div>
                    <div class='icon-case'>
                        <i class='fa-solid fa-cube'></i>
                    </div>
                </div>
                <div class='card'>
                    <div class='box'>
                        <h1><?php echo sizeof($activePackages) ?></h1>
                        <h3>Active Package(s)</h3>
                    </div>
                    <div class='icon-case'>
                        <i class='fa-solid fa-cube'></i>
                    </div>
                </div>
                <div class='card  add-package'>
                    <div class='box'>
                        <a href="./new_package.php"> Add New Package </a>
                    </div>
                </div>
            </div>
            <div class='content-2'>
                <div class='packages-container'>
                    <h2>Upcoming Packages</h2>
                    <div class='packages'>
                        <?php
                        foreach ($activePackages as $activePackage) {
                            // Package Features
                            $features = "<p class='icons'>";
                            if ($activePackage["is_hotel"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-hotel'></i>";
                            }
                            if ($activePackage["is_transport"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-bus-simple'></i>";
                            }

                            if ($activePackage["is_food"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-utensils'></i>";
                            }

                            if ($activePackage["is_guide"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-person-hiking'></i>";
                            }
                            $features .= "</p>";
                            echo "
                                <div class='package'>
                                <div class='img-box'>
                                <img src=" . $activePackage['master_image'] . " alt='Thumbnail'>
                            </div>
                            <div class='details'>
                                <div class='info'>
                                    " . $features . "
                                    <p>" . $activePackage['package_name'] . "</p>
                                    <p>" . $activePackage['package_price'] . " Taka / All Inclusive</p>
                                    <p>Tour Start: " . $activePackage['package_start'] . "</p>
                                </div>
                                <div class='btn'>
                                    <a  href='./edit_package.php?id=" . $activePackage['package_id'] . "'>Edit</a>
                                </div>
                            </div>
                            </div>
                                ";
                        }
                        ?>
                    </div>
                    <h2>Previous Packages</h2>
                    <div class='packages'>
                        <?php
                        foreach ($prevPackages as $prevPackage) {
                            // Package Features
                            $features = "<p class='icons'>";
                            if ($prevPackage["is_hotel"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-hotel'></i>";
                            }
                            if ($prevPackage["is_transport"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-bus-simple'></i>";
                            }

                            if ($prevPackage["is_food"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-utensils'></i>";
                            }

                            if ($prevPackage["is_guide"] == 1) {
                                $features .=
                                    "<i class='fa-solid fa-person-hiking'></i>";
                            }
                            $features .= "</p>";
                            echo "
                                <div class='package'>
                                <div class='img-box'>
                                <img src=" . $prevPackage['master_image'] . " alt='Thumbnail'>
                            </div>
                            <div class='details'>
                                <div class='info'>
                                " . $features . "
                                    <p>" . $prevPackage['package_name'] . "</p>
                                    <p>" . $prevPackage['package_price'] . " Taka / All Inclusive</p>
                                    <p>Tour Start: " . $prevPackage['package_start'] . "</p>
                                </div>
                                <div class='btn'>
                                <a  href='./edit_package.php?id=" . $prevPackage['package_id'] . "'>Edit</a>
                                </div>
                            </div>
                            </div>
                                ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>