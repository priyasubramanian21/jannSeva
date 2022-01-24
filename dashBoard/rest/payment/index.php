<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';
require('config.php');
require('../../core/lib/razorpay/Razorpay.php');


use core\support\session as session;
use service\user\UserServiceImpl as user;
use Razorpay\Api\Api;

$session = new session();

$user = new user();
$api = new Api($keyId, $keySecret);

$session->start();

if (!isset($_SESSION["user"])) {
    header("location: login");
    unset($_SESSION["login"]);
    unset($_SESSION["signup"]);
    unset($_SESSION["user"]);
}

$session->notSetS('login', "pay");

$_SESSION["Pay1-re"] = "t:" . time() . "- V:1st-PMF -";

$orderData = [
    'receipt' => $_SESSION["Pay1-re"],
    'amount' => 500 * 100,
    'currency' => 'INR',
    'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$_SESSION['PMF1_amount'] = $orderData['amount'] / 100;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $displayAmount = $amount;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
    $checkout = $_GET['checkout'];
}

$data = [
    "key" => $keyId,
    "amount" => $amount,
    "name" => "B Fit",
    "description" => "JLE MARKETING PRIVATE LIMITED 1st PMF Payment",
    "image" => getenv("payImage"),
    "readonly" => [
        "name" => $_SESSION["user"]['FistName'] . $_SESSION["user"]['LastName'],
        "email" => $_SESSION["user"]['EmailId'],
        "contact" => $_SESSION["user"]['UserPhone'],
    ],
    "prefill" => [
        "name" => $_SESSION["user"]['FistName'] . $_SESSION["user"]['LastName'],
        "email" => $_SESSION["user"]['EmailId'],
        "contact" => $_SESSION["user"]['UserPhone'],
    ],
    "theme" => [
        "color" => getenv("payColor")
    ],
    "send_sms_hash" => true,
    "config" => [
        "display" => [
            "language" => "en"
        ]
    ],
    "order_id" => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
}

$json = json_encode($data);

require("checkout.php");
