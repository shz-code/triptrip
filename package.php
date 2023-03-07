<!DOCTYPE html>
<html lang='en'>

<?php include('./components/_head.php');
include_once('./services/_dbConnection.php');

if (isset($_GET['id'])) {
    $package_id = ($_GET['id']);
} else {
    $package_id = 0;
}

$query = new Query();

$res = $query->getPackage($package_id);
$row = mysqli_fetch_assoc($res);
?>

<body>
    <nav id='navBar' class='navbar-white'>
        <a href='./index.php' class='logo'> triptrip </a>
        <ul class='nav-links'>
            <li><a href='./index.php'>Popular Places</a></li>
            <li><a href='./listing.php'>All packages</a></li>
        </ul>
        <?php
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['logged_in'])) {
            echo " <a href='./services/_logout.php' class='register-btn'>Logout</a>";
        } else {
            echo " <a href='./registration.php' class='register-btn'>Register Now</a>";
        }
        ?>
        <i class='fa-solid fa-bars' onclick='togglebtn()'></i>
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
    } else
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
    if ($row["is_hotel"] == 1)
        $features .= 
        "<li>
            <i class='fa-solid fa-hotel'></i>Hotel <br>
            <span> 
                Hotel is<strong class='brand-inline brand'>triptrip </strong> verified with excellent
                customer service. 
            </span>
        </li>";
    if ($row["is_transport"] == 1)
        $features .= 
        "<li>
            <i class='fa-solid fa-bus-simple'></i>Transport <br>
            <span>
                Transportation includes bus tickets from and to ".$row['package_location'].".
            </span>
        </li>";
    if ($row["is_food"] == 1)
        $features .= 
        "<li>
            <i class='fa-solid fa-utensils'></i>Food <br>
            <span>
                Breakfast and Dinner included in the package.
            </span>
        </li>";
    if ($row["is_guide"] == 1)
        $features .= 
        "<li>
            <i class='fa-solid fa-person-hiking'></i>Tour Guide <br>
            <span>
                100% trusted local guide is assigned for sight seeing.
            </span>
        </li>";
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
        </div>
        <div class='gallery'>
            <div class='gallery-img-1'><img src='./assets/images/house-1.png'></div>
            <div><img src='./assets/images/house-2.png'></div>
            <div> <img src='./assets/images/house-3.png'></div>
        </div>
        <div class='small-ditails'>
            <p>2,4 guests</p>
            <h3>Tour Starts: " . $row["package_start"] . "</h3>
            <h3>Tour Ends: " . $row["package_end"] . "</h3>
            <h4>" . $row["package_price"] . " Taka / Starting Price</h4>
            <div>
                <hr class='line'>
                <form class='check-form'>
                    <div class='guest-field'>
                        <label>Guests</label>
                        <select name='' id='guest-select'>
                            <option value='' hidden>Choose guests number</option>
                            <option value='2'>2</option>
                            <option value='4'>4</option>
                        </select>
                    </div>
                    <button type='submit'>Check Availability</button>
                </form>
                <h2>The packages comes with <i class='fa-solid fa-chevron-down'></i></h2>
                ".$features."
                <hr class='line'>
                <p class='package-desc'>".$row['package_desc']."</p>
                <hr class='line'>
                <div class='map'>
                    <h3>Location On</h3>
                    <iframe
                        src=" . $location . "
                        width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy'
                        referrerpolicy='no-referrer-when-downgrade'></iframe>
                    <b>".$row['package_location']."</b>
                </div>
            </div>
        </div>
    </div>";
    ?>
    <!-- ==================footer====================== -->
    <div class='container'>
        <div class='about-msg'>
            <h2>About <span class='brand'>triptrip</span></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eius cumque, provident quaerat aspernatur
                architecto totam ea corrupti esse repudiandae omnis asperiores voluptas! Error libero nisi adipisci rem,
                molestiae et iste exercitationem asperiores esse eum facere ipsa voluptatem odit omnis iusto dolor atque
                non eos maiores. Libero dolor fuga possimus.</p>
        </div>
        <div class='footer'>
            <a href='https://www.facebook.com/akibul.hasan.13'><i class='fa-brands fa-facebook-f'></i></a>
            <a href=''><i class='fa-brands fa-youtube'></i></a>
            <a href=''><i class='fa-brands fa-twitter'></i></a>
            <a href=''><i class='fa-brands fa-linkedin'></i></a>
            <a href=''><i class='fa-brands fa-instagram'></i></a>
            <hr>
            <p>&copy; All rights reserved.</p>
        </div>
    </div>
    <?php include('./components/_js.php') ?>

</body>

</html>