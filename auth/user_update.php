<!DOCTYPE html>
<html lang="en">

<!-- Secure route for only user -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["logged_in"])) {
    echo '<script> location.href = "../index.php" </script>';
}
if (isset($_SESSION["is_admin"])) {
    echo '<script> location.href = "./admin_dashboard.php" </script>';
}
?>
<!-- User information's -->
<?php
include_once("../app/_dbConnection.php");
$user_id = $_SESSION['user_id'];

$userInstance = new Users();
$res = $userInstance->getUser($user_id);
$user = mysqli_fetch_assoc($res);
$email = $user['email'];
$phone = $user['phone'];
$address = $user['address'];
$full_name = $user['full_name'];
?>

<head>
    <?php include("./components/_bootstrapHead.php") ?>
    <title>Package Review</title>
    <style>
        .form-control:focus {
            border-color: #FF5361;
            outline: 0;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <nav id='navBar' class='navbar-white'>
        <a href='../index.php' class='logo'> triptrip </a>
        <ul class='nav-links'>
            <li><a href='../index.php'>Popular Places</a></li>
            <li><a href='../listing.php'>All packages</a></li>
        </ul>
        <?php
        if (isset($_SESSION["logged_in"])) {
            echo '<div class="profile-btns">';

            if (isset($_SESSION['is_admin'])) {
                echo '<a href="./admin_dashboard.php" title="Profile"><i class="fa-solid fa-address-card"></i></i></a>';
            } else {
                echo '<a href="./user_dashboard.php" title="Profile"><i class="fa-solid fa-address-card"></i></i></a>';
            }
            echo '<a href="../services/_logout.php" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>';
        } else {
            echo ' <a href="./registration.php" class="register-btn">Register Now</a>';
        }
        ?>
        <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
    </nav>
    <div class="container mt-5">
        <div class="main-body">
            <div>
                <div>
                    <div class="card mb-3">
                        <h2 class='text-center pt-2 mb-0'>Edit Your Current Information</h2>
                        <hr>
                        <form class='card-body review-form' method='post' action='./services/_user_update.php'>
                            <div class="row">
                                <label for="name" class="form-label">Full Name</label>
                                <input required class="form-control px-2" type="text" name="name" value="<?php echo $full_name ?>">
                            </div>
                            <div class="row">
                                <label for="email" class="form-label">Email</label>
                                <input required class="form-control px-2" type="email" name="email" value="<?php echo $email ?>">
                            </div>
                            <div class="row">
                                <label for="phone" class="form-label">Phone</label>
                                <input required class="form-control px-2" type="phone" name="phone" value="<?php echo $phone ?>">
                            </div>
                            <div class="row">
                                <label for="address" class="form-label">Address</label>
                                <textarea required class="form-control px-2" id="address" name="address" rows="5"><?php echo $address ?></textarea>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <button class='btn btn-cus' type='submit'>Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../components/_footer.php") ?>
</body>

</html>