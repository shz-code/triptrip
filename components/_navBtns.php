<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["logged_in"])) {
    echo '<div class="profile-btns">';

    if (isset($_SESSION['is_admin'])) {
        echo '<a href="./auth/admin_dashboard.php" title="Profile"><i class="fa-solid fa-address-card"></i></i></a>';
    } else {
        echo '<a href="./auth/user_dashboard.php" title="Profile"><i class="fa-solid fa-address-card"></i></i></a>';
    }
    echo '<a href="./services/_logout.php" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>';
} else {
    echo ' <a href="./registration.php" class="register-btn">Register Now</a>';
}
?>
<i class="fa-solid fa-bars" onclick="togglebtn()"></i>