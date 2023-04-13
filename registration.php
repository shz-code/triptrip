<!DOCTYPE html>
<html lang="en">

<?php include "./components/_head.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["logged_in"])) {
    echo '<script> location.href = "./index.php" </script>';
}
?>

<body>
    <div class="registration-header">
        <nav id="navBar">
            <a href="./index.php" class="logo"> triptrip </a>
            <ul class="nav-links">
                <li><a href="./index.php">Popular Places</a></li>
                <li><a href="./listing.php">All packages</a></li>
            </ul>
            <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
        </nav>
        <div class="registration">
            <div class="from-box">
                <h1 id="title">Sign Up</h1>
                <!-- Alert notification placeholder -->
                <div class="notification">

                </div>
                <!-- Alert notification placeholder -->
                <form>
                    <div class="input-group">
                        <div class="input-field" id="nameField">
                            <i class="fa-solid fa-user"></i>
                            <input required type="text" placeholder="Username" name="username" id="username">
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input required type="email" placeholder="Email" name="email" id="email">
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input required type="password" placeholder="Password" name="password" id="password">
                            <i class="fa-solid fa-eye show_password"></i>
                        </div>
                        <p style="text-align: center; font-weight:bold">Remember your password carefully!</a></p>
                    </div>
                    <div class="btn-field">
                        <button type="button" id="signupBtn">Sign up</button>
                        <button type="button" id="signinBtn" class="disable">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================footer====================== -->
    <?php include("./components/_footer.php") ?>

    <?php include "./components/_js.php" ?>
    <script src="./assets/js/registration.js"></script>
</body>

</html>