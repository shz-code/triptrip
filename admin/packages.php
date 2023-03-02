<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Triptrip - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="side-menu">
        <ul>
            <li><a href="./admin_dashboard.php"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a></li>
            <li><a href="./users.php"><i class="fa-solid fa-users"></i><span>Users</span></a></li>
            <li class="active"><a href=""><i class="fa-solid fa-cube"></i><span>Packages</span></a> </li>
            <li><a href=""><i class="fa-solid fa-money-bill-trend-up"></i><span>Saes</span></a> </li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="brand-name">
                    <a href="../index.php" class="logo">triptrip</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1>4</h1>
                        <h3>Total Packages</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-cube"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>2</h1>
                        <h3>Active Packages</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-cube"></i>
                    </div>
                </div>
                <div class="card  add-package">
                    <div class="box">
                        Add New Package
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="packages-container">
                    <h2>Upcoming Packages</h2>
                    <div class="packages">
                        <div class="package">
                            <div class="img-box">
                                <img src="../assets/images/house-1.png" alt="Cox's">
                            </div>
                            <div class="details">
                                <div class="info">
                                    <p class="icons"><i class="fa-solid fa-hotel"></i><i class="fa-solid fa-bus-simple"></i><i class="fa-solid fa-utensils"></i><i class="fa-solid fa-person-hiking"></i></p>
                                    <p>Cox's Bazar 3 days</p>
                                    <p>Starting Price 5500 Taka</p>
                                    <p>Tour Start: 00-00-0000</p>
                                </div>
                                <div class="btn">
                                    <a href="">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="package">
                            Package 2
                        </div>
                    </div>
                    <h2>Previous Packages</h2>
                    <div class="packages">
                        <div class="package">
                            <div class="img-box">
                                <img src="../assets/images/house-1.png" alt="Cox's">
                            </div>
                            <div class="details">
                                <div class="info">
                                    <p class="icons"><i class="fa-solid fa-hotel"></i><i class="fa-solid fa-bus-simple"></i><i class="fa-solid fa-utensils"></i><i class="fa-solid fa-person-hiking"></i></p>
                                    <p>Cox's Bazar 3 days</p>
                                    <p>Starting Price 5500 Taka</p>
                                </div>
                                <div class="btn">
                                    <a href="">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="package">
                            Package 2
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>