<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./components/_head.php" ?>
    <title>Triptrip</title>
</head>

<body>
    <div class="header">
        <nav id="navBar">
            <a href="./index.php" class="logo"> triptrip </a>
            <ul class="nav-links">
                <li><a href="./index.php" class="active">Popular Places</a></li>
                <li><a href="./listing.php">All packages</a></li>
            </ul>
            <?php include("./components/_navBtns.php") ?>
        </nav>
        <div class="container hero">
            <h1>Travel Bangladesh Like Never Before</h1>
            <div class="search-bar">
                <form method="post" id="search_form">
                    <div class="location-input">
                        <label>Location</label>
                        <input required type="text" id="location" placeholder="Where are you going?">
                    </div>
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>


    <!-- ---------exclusives------------ -->
    <div class="container">
        <h2 class="sub-title">Exclusive Packages</h2>
        <div class="exclusives">
            <div>
                <img src="https://i.redd.it/8nweob7bjd001.jpg">
                <span>
                    <h3>Cox's Bazar</h3>
                    <p>Starts @ 4000 Taka</p>
                </span>
            </div>
            <div>
                <img src="https://4.bp.blogspot.com/-mdhiT5vtA_A/TyZ6nLh1RDI/AAAAAAAAAA0/wPKDcNBcUTM/s1600/sundarban+forest3.jpg">
                <span>
                    <h3>Sundarbans</h3>
                    <p>Starts @ 3000 Taka</p>
                </span>
            </div>
            <div>
                <img src="https://th.bing.com/th/id/R.25148796f3a95244b27a261256084c4b?rik=KmmFNVd97%2bjhog&pid=ImgRaw&r=0">
                <span>
                    <h3>Bandarban</h3>
                    <p>Starts @ 3500 Taka</p>
                </span>
            </div>
            <div>
                <img src="https://th.bing.com/th/id/OIP.Y7VuBeaYWrUrIl1l8KWwkQHaEK?pid=ImgDet&rs=1">
                <span>
                    <h3>Saint Martin</h3>
                    <p>Starts @ 5000 Taka</p>
                </span>
            </div>
        </div>

        <!-- -------------------Trending Places------------- -->

        <h2 class="sub-title">Trending Places</h2>
        <div class="tranding">
            <div>
                <img src="https://th.bing.com/th/id/OIP.HBapS0SdsaLKwebDgCzW9gHaEO?pid=ImgDet&rs=1">
                <h3>Sajek Valley</h3>
            </div>
            <div>
                <img src="https://th.bing.com/th/id/OIP.pmLRmfoPqY9l7tWUasGoAgHaES?pid=ImgDet&rs=1">
                <h3>Ratargul Swamp Forest</h3>
            </div>
            <div>
                <img src="https://i.ytimg.com/vi/eFrr7jWJ9q8/maxresdefault.jpg">
                <h3>Inani Beach</h3>
            </div>
            <div>
                <img src="https://th.bing.com/th/id/OIP.F13moM_Fj9DVoRNKvtK6FwHaEK?pid=ImgDet&rs=1">
                <h3>Kuakata Sea Beach</h3>
            </div>
        </div>


        <!-- ---------------call to action----------- -->
        <div class="cta">
            <h3>Awesome Packages <br> For you and your friends/family.</h3>
            <p>Great combo with unbeatable prices <br> transport, accomodation & food all inclusive.</p>
            <a href="#" class="cta-btn">Book your first tour now!</a>
        </div>

        <!-- ==============Travellers Stories============== -->

        <h2 class="sub-title">Travellers Stories</h2>
        <div class="stories">
            <div class="travellers-card">
                <img src="https://th.bing.com/th/id/R.4333832c4bf1ac8a33b7de33edf931f6?rik=L5WmyYEBGCsuLQ&riu=http%3a%2f%2fblogs.ubc.ca%2ftheglobalspectrum%2ffiles%2f2015%2f11%2flets-travel-to-bangladesh-with-simon-urwin-featured.jpg&ehk=xhl0gLFAo9b9whN8uY4zQflUaC7EkHLpJE0XWQUVf3I%3d&risl=&pid=ImgRaw&r=0">
                <p><a href="https://awaywiththesteiners.com/travel-in-bangladesh/">Travelling in Bangladesh Starter</a>
                </p>
            </div>
            <div class="travellers-card">
                <img src="https://th.bing.com/th/id/OIP.n57Nzsy-0WkE-Uxc0ZKSjQHaFj?pid=ImgDet&rs=1">
                <p><a href="https://nijhoom.com/star-mosque/">Star-Mosque</a></p>
            </div>
            <div class="travellers-card">
                <img src="https://i.pinimg.com/originals/62/9a/6d/629a6d25b7aca83f4835ea5b87de9260.jpg">
                <p><a href="https://nijhoom.com/puthia/">Puthia Temple Complex</a></p>
            </div>
        </div>
        <a href="https://nijhoom.com/bangladesh-travel-blog/" class="Start-btn">Go to travel blog</a>
    </div>
    <!-- ===============footer================ -->
    <?php include "./components/_footer.php" ?>
    <?php include "./components/_js.php" ?>
    <script>
        $("#search_form").submit(e => {
            e.preventDefault();
            var loc = $("#location").val();
            var guest = $("#guest").val();
            window.location = `http://localhost/triptrip/listing.php?loc=${loc}&g=${guest}`;
        })
    </script>
</body>

</html>