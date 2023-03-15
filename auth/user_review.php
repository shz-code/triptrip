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

<!-- Get Package id -->
<?php
if (isset($_GET['id'])) {
    $package_id = ($_GET['id']);
} else {
    $package_id = 0;
}
?>
<!-- User information's -->
<?php
include_once("../app/_dbConnection.php");
$user_id = $_SESSION['user_id'];
?>
<!-- User Purchase Check -->
<?php
$transactionInstance = new Transactions();
$transactions = $transactionInstance->getUserTransaction($user_id, $package_id);
$row_count = $transactions->num_rows;
?>

<head>
    <?php include("./components/_bootstrapHead.php") ?>
    <link rel="stylesheet" href="style.css">
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
        <a href='./index.php' class='logo'> triptrip </a>
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
                        <?php
                        if ($row_count > 0) {
                            echo "
                            <h2 class='text-center pt-2 mb-0'>Write a review</h2>
                            <hr>
                            <form class='card-body review-form' method='post' action='./services/_review_submit.php'>
                            ";
                        } else {
                            echo "
                            <form class='card-body review-form'>
                            ";
                        }
                        ?>
                        <div class="row">
                            <label for="desc" class="form-label">Review</label>
                            <textarea required class="form-control px-2" name="desc" rows="5">Excellent!</textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="form-label" for="rating">Rating</label>
                            <input required class="form-control px-2" placeholder="4.8" type="number" name="rating" min=1 max=5>
                        </div>
                        <input required type="hidden" name="package_id" value="<?php echo $package_id ?>">
                        <hr>
                        <div>
                            <div>
                                <?php
                                if ($row_count > 0) {
                                    echo "
                                <button class='btn btn-cus' type='submit'>Submit</button>
                            ";
                                } else {
                                    echo "
                                <a class='btn btn-cus'>Not Allowed</a>
                            ";
                                }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../components/_footer.php") ?>
    </script>
</body>

</html>