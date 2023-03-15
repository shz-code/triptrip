<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <?php include_once './app/_dbConnection.php' ?>
    <title>Triptrip - Listings</title>
</head>
<?php include './components/_head.php' ?>
<?php
// error_reporting(0);
if (isset($_GET["loc"]) && isset($_GET['g'])) {
    $location = ($_GET["loc"]);
    $guest = $_GET["g"];
} else {
    $location = "";
    $guest = 0;
}
?>

<body>
    <nav id='navBar' class='navbar-white'>
        <a href='./index.php' class='logo'> triptrip </a>
        <ul class='nav-links'>
            <li><a href='./index.php'>Popular Places</a></li>
            <li><a href='./listing.php' class='active'>All packages</a></li>
        </ul>
        <?php include("./components/_navBtns.php") ?>
    </nav>


    <div class='container'>
        <div class='list-container'>
            <div class='left-col'>
                <?php
                $packages = new Packages();

                if ($location != "") {
                    $allPackages = $packages->getPackagesWithQueryCount($location);
                    $res = $packages->getPackages($location, 0, 5);
                } else {
                    $allPackages = $packages->getPackagesCount();
                    $res = $packages->getPackages("All", 0, 5);
                }
                echo "<p class='available-package'>Total <span id='all-packages-count'>$allPackages</span> Package(s) Available</p>
                <h1>Find Your Suitable Package in <span class='brand'>triptrip</span></h1>
                <div class='package-container'>";
                while ($row = mysqli_fetch_assoc($res)) {
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
                    echo "<div class='package'>
                    <div class='package-img'>
                        <img src=" . $row['master_image'] . ">
                    </div>
                    <div class='package-info'>
                        <p>" . $row['package_location'] . "</p>
                        <h3>" . $row['package_name'] . "</h3>";
                    if ($row["is_hotel"] == 1) {
                        echo "Hotel / ";
                    }

                    if ($row["is_transport"] == 1) {
                        echo "Transport / ";
                    }

                    if ($row["is_food"] == 1) {
                        echo "Food / ";
                    }

                    if ($row["is_guide"] == 1) {
                        echo "Tour Guide";
                    }

                    echo "<br>
                        " . $stars . "
                        <p>" . $row['package_desc'] . "</p>
                        <div class='hotel-chekins'>
                        <h4>Tour Start: " . $row['package_start'] . "</h4>
                        <h4>Tour End: " . $row['package_end'] . "</h4>
                        </div>
                        <div><a href='./package.php?id=" . $row['package_id'] . "' class='btn'>View Details</a></div>
                        <div class='package-price'>
                            <h4>" . $row['package_price'] . " Taka <span>All Inclusive</span></h4>
                        </div>
                    </div>
                </div>";
                }
                echo "</div>";
                ?>
            </div>
            <div class='right-col'>
                <div>
                </div>
                <div class='sidebar'>
                    <p>Search for your desired destination and get <span class="brand brand-inline">triptrip</span> selected packages.</0>
                    <form class='search-listing' id="search-form">
                        <?php
                        echo "<input type='text' id='sidebar-search-input' name='sidebar-search-input' value=\"$location\" placeholder='Where are you going?'>";
                        ?>
                        <button type='submit'><i class='fa-solid fa-magnifying-glass'></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class='pagination'>
            <i class='fa-solid fa-chevron-left'></i>
            <span class='current pagination-btn' data-target='1' onclick='paginationBtnHandle()'>1</span>
            <div class="pagination-btns-container">
                <?php
                for ($i = 2; $i < ($allPackages / 5) + 1; $i++) {
                    echo "<span class='pagination-btn' data-target='" . $i . "' onclick='paginationBtnHandle()'>" . $i . "</span>";
                }
                ?>
            </div>
            <i class='fa-solid fa-chevron-right'></i>
        </div>
    </div>
    <!-- ===========footer=================== -->
    <?php include "./components/_footer.php" ?>


    <?php include "./components/_js.php" ?>

    <script>
        let paginationBtns = document.querySelectorAll(".pagination-btn");
        var allPackagesCount = parseInt($("#all-packages-count").html());
        let urlParams = new URLSearchParams(location.search);
        let query = "";
        if (urlParams.has('loc')) {
            query = urlParams.get('loc');
        };

        const addPackage = (package) => {
            const {
                package_id,
                package_name,
                package_rating,
                package_start,
                package_end,
                package_desc,
                package_price,
                package_location,
                is_hotel,
                is_transport,
                is_food,
                is_guide,
                master_image
            } = package;
            let stars = "";
            let cmp_stars = 0;
            // Full Stars
            for (i = 1; i <= parseInt(package_rating); i++) {
                stars += "<i class='fa-solid fa-star'></i>";
                cmp_stars++;
            }
            // Half Start
            half_star = package_rating - cmp_stars;
            if (half_star < 1 && half_star > 0) {
                stars += "<i class='fa-solid fa-star-half-stroke'></i>";
            }
            // Remaining Starts
            rem_stars = 5 - package_rating;
            for (i = 1; i <= rem_stars; i++) {
                stars += "<i class='fa-regular fa-star'></i>";
            }
            document.querySelector(".package-container")
                .innerHTML +=
                `<div class='package'>
                <div class='package-img'>
                    <img src='${master_image}'>
                </div>
                <div class='package-info'>
                    <p>${package_location}</p>
                    <h3>${package_name}</h3>
                    <p>
                    ${parseInt(is_hotel) === 1 ? "Hotel / " : ""}
                    ${parseInt(is_transport) === 1 ? "Transport / " : ""}
                    ${parseInt(is_food) === 1 ? "Food / " : ""}
                    ${parseInt(is_guide) === 1 ? "Tour Guide " : ""}
                    </p>
                    ${stars}
                    <p>${package_desc}</p>
                    <div class='hotel-chekins'>
                            <h4>Tour Start: ${package_start}</h4>
                            <h4>Tour End: ${package_end}</h4>
                    </div>
                    <div><a href='./package.php?id=${package_id}' class='btn'>View Details</a></div>
                    <div class='package-price'>
                        <h4>${package_price} Taka <span>Starting Price</span></h4>
                    </div>
                </div>
            </div>`;
        };

        const handlePagination = (packages, page) => {
            let res = "";
            for (i = 2; i < (packages / 5) + 1; i++) {
                if (i === parseInt(page)) res += `<span class='pagination-btn current' data-target='${i}' onclick='paginationBtnHandle()'>${i}</span>`;
                else res += `<span class='pagination-btn' data-target='${i}' onclick='paginationBtnHandle()'>${i}</span>`;
            }
            $(".pagination-btns-container").html(res);
        };

        const ajaxCall = async (query, start = 1, end = 5000, page) => {
            $.ajax({
                url: "./services/_packagePagination.php",
                method: "POST",
                type: "json",
                data: {
                    query: query,
                    start: start - 1,
                    end: end,
                },
                success: (data) => {
                    data = JSON.parse(data);
                    $("#all-packages-count").html(`${data[0]}`);
                    $(".package-container").html("");

                    handlePagination(data[0], page);

                    data.map((package, index) => {
                        if (index != 0) addPackage(package)
                    });
                    $("html, body").animate({
                        scrollTop: 0
                    });
                },
                error: (data) => {
                    console.log("Error");
                }
            });
        }

        const paginationBtnHandle = async () => {
            if (!event.target.classList.contains("current")) {
                var page = parseInt(event.target.getAttribute("data-target"));
                var end = page * 5;
                var start = end - 4;
                await ajaxCall(query, start, 5, page);
                $(".current").removeClass("current");
                event.target.classList.add("current");
            }
        }

        $("#search-form").submit((e) => {
            e.preventDefault();
            $(".current").removeClass("current");
            paginationBtns[0].classList.add("current");

            var loc = $("#sidebar-search-input").val();
            query = loc;
            if (query === "") ajaxCall(query, 1, 5);
            else ajaxCall(query, 1, 5);
        })
    </script>

</body>

</html>