<?php

include_once("./app/_dbConnection.php");

$val_id = urlencode($_POST['val_id']);
$store_id = urlencode("rooki64087f61151b1");
$store_passwd = urlencode("rooki64087f61151b1@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if ($code == 200 && !(curl_errno($handle))) {
    $result = json_decode($result);

    # TRANSACTION INFO
    $tran_date = $result->tran_date;
    $tran_id = $result->tran_id;
    $val_id = $result->val_id;
    $amount = $result->amount;
    $card_no = $result->card_no;

    # ISSUER INFO
    $card_type = $result->card_type;

    # API AUTHENTICATION
    $user_id =  $result->value_a;
    $package_id = $result->value_b;

    $transactionInstance = new Transactions();
    $transactionInstance->createNewTransaction($tran_id, $user_id, $package_id, $amount, $tran_date, $card_no, $val_id, $card_type);
    $packagesInstance = new Packages();
    $res = $packagesInstance->getPackage($package_id);
    $package = mysqli_fetch_assoc($res);
    $count = $package['package_booked'];
    $count = $count + 1;
    $packagesInstance->updatePackagePurchase($package_id, $count);
    echo var_dump($result);
} else {

    echo "Failed to connect with SSLCOMMERZ";
}
?>
<html>
<title>Successful Purchase</title>

<body>
    <h1>Your purchase is completed.</h1>
    <p>Redirecting to dashboard in <span class="counter"></span></p>

    <script>
        let countDown = 5;
        setInterval(() => {
            countDown--;
            document.querySelector(".counter").innerHTML = countDown;
        }, 1000)
        setTimeout(() => {
            location.href = "./auth/user_dashboard.php";
        }, 5000);
    </script>
</body>

</html>