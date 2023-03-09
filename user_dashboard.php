<!DOCTYPE html>
<html lang="en">

<!-- Secure route for only user -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["logged_in"])) {
    echo '<script> location.href = "./index.php" </script>';
}
if (isset($_SESSION["is_admin"])) {
    echo '<script> location.href = "./admin/admin_dashboard.php" </script>';
}
?>

<?php include("./components/_head.php") ?>

<body>
    <div class="header">
        <nav id="navBar">
            <a href="./index.php" class="logo"> triptrip </a>
            <ul class="nav-links">
                <li><a href="./index.php">Popular Places</a></li>
                <li><a href="./listing.php">All packages</a></li>
            </ul>
            <?php include("./components/_navBtns.php") ?>
        </nav>
        <div class="container hero">
            <h1>Welcome user</h1>
            <div class="">
                <?php echo var_dump($_SESSION) ?>
            </div>
        </div>
    </div>
</body>

</html>