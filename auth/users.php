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
<?php include("./components/_head.php");
include_once("../app/_dbConnection.php");
$usersInstance = new Users();
$users = $usersInstance->getAllUsers();
$usersCount = $usersInstance->getUsersCount();
?>

<body>
    <div class="side-menu">
        <ul>
            <li><a href="./admin_dashboard.php"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a></li>
            <li class="active"><a href="./users.php"><i class="fa-solid fa-users"></i><span>Users</span></a></li>
            <li><a href="./packages.php"><i class="fa-solid fa-cube"></i><span>Packages</span></a> </li>
            <li><a href="./sales.php"><i class="fa-solid fa-money-bill-trend-up"></i><span>Sales</span></a> </li>
        </ul>
    </div>
    <div class="container">
        <?php include("./components/_header.php") ?>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1><?php echo $usersCount ?></h1>
                        <h3>Total User(s)</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="new-users">
                    <div class="title">
                        <h2>All Users</h2>
                    </div>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registration Date</th>
                            <th>Account Status</th>
                        </tr>
                        <?php
                        while ($user = mysqli_fetch_assoc($users)) {
                            echo "
                                <tr>
                                    <td>" . $user['username'] . "</td>
                                    <td>" . $user['email'] . "</td>
                                    <td>" . $user['date_created'] . "</td>
                                    <td>
                                        <button class='btn'></button>
                                        <button class='btn'></button>
                                    </td>
                                </tr>";
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>