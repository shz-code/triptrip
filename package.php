<!DOCTYPE html>
<html lang='en'>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php include './components/_head.php';
include_once './app/_dbConnection.php';

if (isset($_GET['id'])) {
    $package_id = ($_GET['id']);
} else {
    $package_id = 0;
}

$packages = new Packages();

$res = $packages->getPackage($package_id);
$row = mysqli_fetch_assoc($res);
?>

<body>
    <nav id='navBar' class='navbar-white'>
        <a href='./index.php' class='logo'> triptrip </a>
        <ul class='nav-links'>
            <li><a href='./index.php'>Popular Places</a></li>
            <li><a href='./listing.php'>All packages</a></li>
        </ul>
        <?php include("./components/_navBtns.php") ?>
    </nav>
    <?php
    // Check if data is available
    if ($res->num_rows == 0) {
        echo "
        <div class='package-details'>
            <div class='package-title'>
                <h1>No Related Package Found...</h1>
            </div>
        </div>";
    } else {

        $location = $row["map_loc"];
        // Handle rating starts
        $stars = "";
        $cmp_stars = 0;
        // Full Stars
        for ($i = 1; $i <= $row['package_rating']; $i++) {
            $stars .= "<i class='fa-solid fa-star'></i>";
            $cmp_stars++;
        }
        // Half Start
        $half_star = $row['package_rating'] - $cmp_stars;
        if ($half_star < 1 && $half_star > 0) {
            $stars .= "<i class='fa-solid fa-star-half-stroke'></i>";
        }
        // Remaining Starts
        $rem_stars = 5 - $row['package_rating'];
        for ($i = 1; $i <= $rem_stars; $i++) {
            $stars .= "<i class='fa-regular fa-star'></i>";
        }
        // Package Features
        $features = "<ul class='details-list'>";
        if ($row["is_hotel"] == 1) {
            $features .=
                "<li>
            <i class='fa-solid fa-hotel'></i>Hotel <br>
            <span>
                Hotel is<strong class='brand-inline brand'>triptrip </strong> verified with excellent
                customer service.
            </span>
        </li>";
        }

        if ($row["is_transport"] == 1) {
            $features .=
                "<li>
            <i class='fa-solid fa-bus-simple'></i>Transport <br>
            <span>
                Transportation includes bus tickets from and to " . $row['package_location'] . ".
            </span>
        </li>";
        }

        if ($row["is_food"] == 1) {
            $features .=
                "<li>
            <i class='fa-solid fa-utensils'></i>Food <br>
            <span>
                Breakfast and Dinner included in the package.
            </span>
        </li>";
        }

        if ($row["is_guide"] == 1) {
            $features .=
                "<li>
            <i class='fa-solid fa-person-hiking'></i>Tour Guide <br>
            <span>
                100% trusted local guide is assigned for sight seeing.
            </span>
        </li>";
        }

        $features .= "</ul>";

        echo "<div class='package-details'>
        <div class='package-title'>
            <h1>" . $row["package_name"] . "</h1>
            <div class='row'>
                <div>
                    " . $stars . "
                    <span>" . $row["package_rating"] . "</span>
                </div>
                <div>
                    <p>Location:<span>" . $row["package_location"] . ", Bangladesh</span></p>
                </div>
            </div>
        </div>";

        echo "
        <div class='gallery'>
            <div class='gallery-img-1'><img src=" . $row['master_image'] . "></div>
            <div class='gallary-img-grp'>
                <img src=" . $row['extra_image_1'] . ">
                <img src=" . $row['extra_image_2'] . ">
            </div>
        </div>";

        echo "
        <div class='small-ditails'>
            <h3>Tour Starts: " . $row["package_start"] . "</h3>
            <h3>Tour Ends: " . $row["package_end"] . "</h3>
            <h4>" . $row["package_price"] . " Taka / All Inclusive</h4>
            <div>
                <hr class='line'>
                <form class='check-form' method='post'>
                    <p class='status-msg'></p>
                    <button class='check-btn'>Check Availability</button>
                </form>
                <h2>The packages comes with <i class='fa-solid fa-chevron-down'></i></h2>
                    " . $features . "
                <hr class='line'>
                <p class='package-desc'>" . $row['package_desc'] . "</p>
                <hr class='line'>
                <div class='map'>
                    <h3>Location On</h3>
                    <iframe
                        src=" . $location . "
                        width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy'
                        referrerpolicy='no-referrer-when-downgrade'>
                    </iframe>
                    <b>" . $row['package_location'] . "</b>
                </div>
            </div>
        </div>
    </div>";
    }
    ?>
    <!-- ==================footer====================== -->
    <?php include "./components/_footer.php" ?>
    <?php include './components/_js.php' ?>
    <script>
        let urlParams = new URLSearchParams(location.search);
        packageId = urlParams.get('id');

        $(".check-form").submit(e => {
            e.preventDefault();
            $(".check-btn").html("Checking");
            $.ajax({
                url: "./services/_packageAvailability.php",
                method: "POST",
                type: "json",
                data: {
                    package_id: packageId,
                },
                success: (data) => {
                    data = JSON.parse(data);
                    if (data > 0) {
                        $(".status-msg").html("Avaiable for booking. <a href=''>Click here to proceed booking.</a>");
                    } else {
                        $(".status-msg").html("Sorry this package is already full.")
                    }
                    $(".check-btn").html("Check Availability");
                },
                error: (data) => {
                    if (data.statusText === "Forbidden") {
                        $(".status-msg").html("Sign in first. <a href='./registration.php'>Click Here</a>");
                    } else if (data.statusText === "Finished") {
                        $(".status-msg").html("Sorry this package is already finished.");
                    }
                    $(".check-btn").html("Check Availability");
                },
            });
        })
    </script>

</body>

</html>