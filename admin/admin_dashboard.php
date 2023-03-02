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
            <li class="active"><a href="./admin_dashboard.php"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a></li>
            <li><a href="./users.php"><i class="fa-solid fa-users"></i><span>Users</span></a></li>
            <li><a href="./packages.php"><i class="fa-solid fa-cube"></i><span>Packages</span></a> </li>
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
                        <h1>2194</h1>
                        <h3>Users</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>53</h1>
                        <h3>Packages</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-cube"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>15000 tk</h1>
                        <h3>Sales</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>
                </div>
            </div>
            <div class="content-2 dashboard">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Recent Payments</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                        <tr>
                            <td>Sara</td>
                            <td>Cox's Day</td>
                            <td>6500 Taka</td>
                            <td><a href="#" class="btn">View</a></td>
                        </tr>
                    </table>
                </div>
                <div class="new-users">
                    <div class="title">
                        <h2>New Users</h2>
                        <a href="./users.php" class="btn">View All</a>
                    </div>
                    <table>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                        </tr>
                        <tr>
                            <td><i class="fa-regular fa-user"></i></td>
                            <td>Steve Doe</td>
                        </tr>
                        <tr>
                            <td><i class="fa-regular fa-user"></i></td>
                            <td>John Steve</td>
                        </tr>
                        <tr>
                            <td><i class="fa-regular fa-user"></i></td>
                            <td>John Doe</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>