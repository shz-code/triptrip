<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <?php include './components/_head.php' ?>
    <title>Triptrip - Package</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/package.css">
</head>
<?php include_once './app/_dbConnection.php';

if (isset($_GET['id'])) {
    $package_id = ($_GET['id']);
} else {
    $package_id = 0;
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = 0;
}

$packages = new Packages();

$res = $packages->getPackage($package_id);
$row = mysqli_fetch_assoc($res);

// Check if user already purchased the package
$ckUser = 0;
$transactionInstance = new Transactions();
if (isset($_SESSION['logged_in'])) {
    $transaction = $transactionInstance->checkUserTransaction($_SESSION['user_id'], $package_id);
    $ckUser = $transaction->num_rows;
}
?>

<?php include("./utilities/countStars.php") ?>

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
        $stars = countStars($row['package_rating']);
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
                    <span>" . number_format((float) $row["package_rating"], 1, '.', '')  . "</span>
                </div>
                <div>
                    <p>Location:<span>" . $row["package_location"] . ", Bangladesh</span></p>
                </div>
            </div>
        </div>";
        echo "
        <div class='gallery'>
            <div class='gallery-img-1'><img src=" . $row['master_image'] . "></div>
            <div class='gallery-img-grp'>
                <img src=" . $row['extra_image_1'] . ">
                <img src=" . $row['extra_image_2'] . ">
            </div>
        </div>";

        echo "
        <div class='small-details'>
            <h3>Tour Starts: " . $row["package_start"] . "</h3>
            <h3>Tour Ends: " . $row["package_end"] . "</h3>
            <h4>" . $row["package_price"] . " Taka / All Inclusive</h4>
            <div>
                <hr class='line'>";

        if (!isset($_SESSION['is_admin'])) {
            echo
            "       <div class='check-form'>
                        <p class='status-msg'></p>";
            if ($ckUser > 0) {
                echo  "<button class='check-btn'>You Have Already Purchased this package.</button>";
            } else  echo  "<button  class='check-btn btn-activate'>Check Availability</button>";
            echo    "</div>";
        }


        echo "<h2>The packages comes with <i class='fa-solid fa-chevron-down'></i></h2>
                    " . $features . "
                <hr class='line'>
                <p class='package-desc'>" . $row['package_desc'] . "</p>
                <hr class='line'>
                <div class='map'>
                    <h3>Location On</h3>
                    <iframe
                        src=" . $location . "
                        width='600' 
                        height='450' 
                        style='border:0' 
                        allowfullscreen='' 
                        loading='lazy'
                        referrerpolicy='no-referrer-when-downgrade'>
                    </iframe>
                    <b>" . $row['package_location'] . "</b>
                </div>
            </div>
        </div>
    </div>";
    }
    ?>
    <?php
    $testimonialInstance = new Testimonials();
    $testimonials = $testimonialInstance->getPackageTestimonials($package_id);
    ?>
    <!-- Reviews  -->
    <div class='what-say'>
        <div class='container'>
            <h3><?php
                if ($testimonials->num_rows > 0) {
                    echo "What People Say";
                } else echo "No Reviews Yet";
                ?></h3>
            <div class='row'>
                <div class='col-md-12'>
                    <div id='testimonial-slider' class='owl-carousel'>
                        <?php
                        while ($row = mysqli_fetch_assoc($testimonials)) {
                            $stars = countStars($row['rating']);
                            echo "
                                <div class='testimonial'>
                                <div class='testimonial-content'>
                                <div class='testimonial-icon'>
                                <i class='fa fa-quote-left'></i>
                                </div>
                                <p class='description'>
                                " . $row['message'] . "
                                </p>
                                <p class='testimonial-rating'>
                                " . $stars . "
                                </p>
                                </div>
                                <h3 class='title'> " . $row['full_name'] . "</h3>
                                </div>
                                ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include "./components/_footer.php" ?>
    <?php include './components/_js.php' ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#testimonial-slider").owlCarousel({
                items: 3,
                itemsDesktop: [1000, 3],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 2],
                itemsMobile: [650, 1],
                pagination: true,
                navigation: false,
                slideSpeed: 1000,
                autoPlay: true
            });
        });
    </script>
    <script>
        let urlParams = new URLSearchParams(location.search);
        packageId = urlParams.get('id');

        $(".btn-activate").click(e => {
            e.preventDefault();
            $(".btn-activate").html("Checking");
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
                        $(".status-msg").html(`Available for booking. <a href=<?php echo "./services/_checkout.php?package=" . $package_id . "&user=" . $user_id ?>>Click here to proceed booking.</a>`);
                    } else {
                        $(".status-msg").html("Sorry this package is already full.")
                    }
                    $(".btn-activate").html("Check Availability");
                },
                error: (data) => {
                    if (data.statusText === "Forbidden") {
                        $(".status-msg").html("Sign in first. <a href='./registration.php'>Click Here</a>");
                    } else if (data.statusText === "Finished") {
                        $(".status-msg").html("Sorry this package is already finished.");
                    }
                    $(".btn-activate").html("Check Availability");
                },
            });
        })
    </script>


</body>

</html>