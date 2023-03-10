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
$username = $user['username'];
$email = $user['email'];
$date_created = $user['date_created'];
$date_created = date_create($date_created);
$date_created = date_format($date_created, "Y-m-d");
$phone = $user['phone'];
$address = $user['address'];
$full_name = $user['full_name'];
?>
<!-- User Purchases -->
<?php
$transactionInstance = new Transactions();
$transactions = $transactionInstance->userAllTransactions($user_id);
?>

<head>
    <?php include("./components/_bootstrapHead.php") ?>
    <title>User Profile</title>
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
                <div class=" mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="mt-3">
                                    <h4><?php echo $username ?></h4>
                                    <p class="text-muted font-size-sm">User since: <?php echo $date_created ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div>
                                <div>
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="text-secondary">
                                    <?php echo $full_name ?>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="text-secondary">
                                    <?php echo $email ?>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="text-secondary">
                                    <?php echo $phone ?>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <div>
                                <div>
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="text-secondary">
                                    <?php echo $address ?>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <a class="btn btn-cus" target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>All Purchase Records</h2>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Transaction Id</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Package Name</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Generate Invoice</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($transactions)) {
                    echo "
                    <tr>
                        <th scope='row'>" . $row['trans_date'] . "</th>
                        <td>" . $row['trans_id'] . "</td>
                        <td>" . $row['card_type'] . "</td>
                        <td>" . $row['package_name'] . "</td>
                        <td>" . $row['trans_amount'] . "</td>
                        <td>
                        <a href='./generatePDF.php?package_id=" . $row['package_id'] . "&user_id=" . $user_id . "'>
                            Ck
                        </a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include("../components/_footer.php") ?>
    </script>
</body>

</html>