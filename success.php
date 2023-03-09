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
    $card_issuer = $result->card_issuer;

    # API AUTHENTICATION
    $user_id =  $result->value_a;
    $package_id = $result->value_b;

    $transactionInstance = new Transactions();
    echo $transactionInstance->createNewTransaction($tran_id, $user_id, $package_id, $amount, $tran_date, $card_no, $val_id);
} else {

    echo "Failed to connect with SSLCOMMERZ";
}
