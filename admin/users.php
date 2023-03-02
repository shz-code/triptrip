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
            <li class="active"><a href="./users.php"><i class="fa-solid fa-users"></i><span>Users</span></a></li>
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
                        <h3>Total Users</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>15</h1>
                        <h3>New users <br>Last 7 days</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="new-users">
                    <div class="title">
                        <h2>All Users</h2>
                    </div>
                    <table>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Total Purchase</th>
                        </tr>
                        <tr>
                            <td><a href=""><i class="fa-regular fa-user"></i></a></td>
                            <td>Steve Doe</td>
                            <td>0176123123</td>
                            <td>1500 Tk</td>
                        </tr>
                        <tr>
                            <td><a href=""><i class="fa-regular fa-user"></i></a></td>
                            <td>John Steve</td>
                            <td>0176123123</td>
                            <td>1500 Tk</td>
                        </tr>
                        <tr>
                            <td><a href=""><i class="fa-regular fa-user"></i></a></td>
                            <td>John Doe</td>
                            <td>0176123123</td>
                            <td>1500 Tk</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>