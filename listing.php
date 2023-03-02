<!DOCTYPE html>
<html lang='en'>
<?php include_once('./services/_dbConnection.php') ?>
<?php include('./components/_head.php') ?>

<?php
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
        <a href='./registration.php' class='register-btn'>Register Now</a>
        <i class='fa-solid fa-bars' onclick='togglebtn()'></i>
    </nav>


    <div class='container'>
        <div class='list-container'>
            <div class='left-col'>
                <?php
                $query = new Query();

                if ($location != "") {
                    $allPackages = $query->getPackagesWithQueryCount($location);
                    $res = $query->getPackages($location, 0, 5);
                } else {
                    $allPackages = $query->getPackagesCount();
                    $res = $query->getPackages("All", 0, 5);
                }

                echo "<p class='available-package'>Total <span id='all-packages-count'>$allPackages</span> Package(s) Available</p>
                <h1>Find Your Suitable Package in <span class='brand'>triptrip</span></h1>
                <div class='package-container'>";
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<div class='package'>
                    <div class='package-img'>
                        <img src='./assets/images/image-s1.png'>
                    </div>
                    <div class='package-info'>
                        <p>" . $row['package_location'] . "</p>
                        <h3>" . $row['package_name'] . "</h3>
                        <p>Transport / Hotel / Food / Tour Guide</p>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star-half-stroke'></i>
                        <i class='fa-regular fa-star'></i>
                        <p>" . $row['package_desc'] . "</p>
                        <div class='hotel-chekins'>
                            <h4>Hotel Check-in: 00/00/0000</h4>
                            <h4>Hotel Check-out: 00/00/0000</h4>
                        </div>
                        <div><a href='./package.php' class='btn'>View Details</a></div>
                        <div class='package-price'>
                            <p>2,4 Guests</p>
                            <h4>" . $row['package_price'] . " Taka <span>Starting Price</span></h4>
                        </div>
                    </div>
                </div>";
                }
                echo "</div>";
                ?>
            </div>
            <div class='right-col'>
                <div>
                    <form class='search-listing' id="search-form">
                        <?php
                        echo "<input type='text' id='sidebar-search-input' name='sidebar-search-input' value=\"$location\" placeholder='Where are you going?'>";
                        ?>
                        <button type='submit'><i class='fa-solid fa-magnifying-glass'></i></button>
                    </form>
                </div>
                <div class='sidebar'>
                    <h2>Select Filters</h2>
                    <h3>Package Inclusives</h3>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Transport</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Food</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Guides</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Hotel</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Resort</p> <span>(0)</span>
                    </div>
                    <h3>Guests</h3>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>Solo</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>2</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>3</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>4</p> <span>(0)</span>
                    </div>
                    <div class='filter'>
                        <input type='checkbox'>
                        <p>5</p> <span>(0)</span>
                    </div>
                    <div class='sidebar-link'>
                        <a href='#'>Contact us for custom packages</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($allPackages > 5) {
            echo "<div class='pagination'>
                <i class='fa-solid fa-chevron-left'></i>
                <span class='current pagination-btn' data-target='1'>1</span>";

            for ($i = 2; $i < ($allPackages / 5) + 1; $i++) {
                echo "<span class='pagination-btn' data-target='" . $i . "'>" . $i . "</span>";
            }
            echo "<i class='fa-solid fa-chevron-right'></i>
            </div>";
        }
        ?>
        <!-- ===========footer=================== -->
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


    <?php include("./components/_js.php") ?>

    <script>
        let paginationBtns = document.querySelectorAll(".pagination-btn");
        var allPackagesCount = parseInt($("#all-packages-count").html());
        let urlParams = new URLSearchParams(location.search);
        let query = "";
        if (urlParams.has('loc')) {
            query = urlParams.get('loc');
        }

        const addPackage = (package) => {
            const { package_name, package_rating, package_desc, package_price, package_location } = package;
            document.querySelector(".package-container")
                .innerHTML +=
                `<div class='package'>
                <div class='package-img'>
                    <img src='./assets/images/image-s1.png'>
                </div>
                <div class='package-info'>
                    <p>${package_location}</p>
                    <h3>${package_name}</h3>
                    <p>Transport / Hotel / Food / Tour Guide</p>
                    <i class='fa-solid fa-star'></i>
                    <i class='fa-solid fa-star'></i>
                    <i class='fa-solid fa-star'></i>
                    <i class='fa-solid fa-star-half-stroke'></i>
                    <i class='fa-regular fa-star'></i>
                    <p>${package_desc}</p>
                    <div class='hotel-chekins'>
                        <h4>Hotel Check-in: 00/00/0000</h4>
                        <h4>Hotel Check-out: 00/00/0000</h4>
                    </div>
                    <div><a href='./package.php' class='btn'>View Details</a></div>
                    <div class='package-price'>
                        <p>2,4 Guests</p>
                        <h4>${package_price} Taka <span>Starting Price</span></h4>
                    </div>
                </div>
            </div>`;
        }

        const ajaxCall = (query, start = 1, end = 5000) => {
            
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
                    if(parseInt(data[0]) === allPackagesCount) $(".pagination").css("display","flex");
                    $(".package-container").html("");
                    data.map((package,index) =>{
                        if(index != 0) addPackage(package)
                    });
                    $("html, body").animate({ scrollTop: 0 });
                },
                error: (data) => {
                    console.log("Error");
                }
            });
        }


        paginationBtns.forEach((item) => {
            item.addEventListener("click", (e) => {
                if (!e.target.classList.contains("current")) {
                    $(".current").removeClass("current");
                    e.target.classList.add("current");
                    var page = parseInt(e.target.getAttribute("data-target"));
                    var end = page * 5;
                    var start = end - 4;
                    ajaxCall(query,start,end);
                }
            })
        });

        $("#search-form").submit((e) => {
            e.preventDefault();
            $(".current").removeClass("current");
            paginationBtns[0].classList.add("current");
            $(".pagination").css("display","none");

            var loc = $("#sidebar-search-input").val();
            query = loc;
            if(query === "") ajaxCall(query,1,5);
            else ajaxCall(query);
        })
    </script>

</body>

</html>