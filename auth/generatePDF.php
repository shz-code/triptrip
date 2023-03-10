<!DOCTYPE html>
<html lang="en">

<!-- Secure route for only users -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["logged_in"])) {
    echo '<script> location.href = "../index.php" </script>';
}
?>

<?php
include_once("../app/_dbConnection.php");
if (isset($_GET['package_id']) && isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    $package_id = $_GET["package_id"];
    $transactionInstance = new Transactions();
    $res = $transactionInstance->getUserTransaction($user_id, $package_id);
    $transaction = mysqli_fetch_assoc($res);
    $trans_id = $transaction['trans_id'];
    $trans_amount = $transaction['trans_amount'];
    $trans_date = $transaction['trans_date'];
    $card_type = $transaction['card_type'];
    $package_name = $transaction['package_name'];
    $package_start = $transaction['package_start'];
    $full_name = $transaction['full_name'];
    $address = $transaction['address'];
    $phone = $transaction['phone'];
    $email = $transaction['email'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets//css/style.css">
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="container-sm mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice For >> <strong>Transaction ID: <?php echo $trans_id ?></strong></p>
                    </div>
                    <hr>
                </div>
                <!-- <?php echo var_dump($full_name) ?> -->
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0"></i>
                            <p class="pt-0 brand">triptrip</p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted"><span class="fw-bold"><?php echo $full_name ?></span></li>
                                <li class="text-muted"><?php echo $address ?></li>
                                <li class="text-muted"><i class="fas fa-phone"></i> <?php echo $phone ?></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Transaction</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID: </span><?php echo $trans_id ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Transaction Date: </span><?php echo $trans_date ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-success text-light fw-bold">
                                        Paid</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Package Name</th>
                                    <th scope="col">Tour Date</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $package_name ?></td>
                                    <td><?php echo $package_start ?></td>
                                    <td><?php echo $card_type ?></td>
                                    <td><?php echo $trans_amount ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p>The payment is verified by SSL Commerz</p>
                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span><?php echo $trans_amount ?> Taka</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(0%)</span>0 Taka</li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;"><?php echo $trans_amount ?></span> Taka</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                        </div>
                        <div class="col-xl-2">
                            <button type="button" class="btn btn-outline-secondary text-capitalize print-btn">Print Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector(".print-btn").addEventListener("click", e => {
            window.print();
        })
    </script>
</body>

</html>