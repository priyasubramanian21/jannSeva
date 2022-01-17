<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';
require('../payment/config.php');
require('../../core/lib/razorpay/Razorpay.php');

use core\support\session as session;
use service\user\UserServiceImpl as user;
use Razorpay\Api\Api;


$api = new Api($keyId, $keySecret);

$session = new session();
$user = new user();

$session->start();
$session->notSet('login');

$totalPMF = 100;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['pmf']) || isset($_POST['total']) || isset($_POST['inlineFormInputGroupUsername2'])) {

        if ($_POST['total'] && !empty($_POST['total']) && $_POST['total'] != 0.00) {
            $cPmf = $_POST['total'];
        } elseif ($_POST['inlineFormInputGroupUsername2']) {
            $cPmf = $_POST['inlineFormInputGroupUsername2'];
        } else {
            $cPmf = $_POST['pmf'];
        }

        $userPayedPMF = $user->numberOfPMF($_SESSION["user"]['UserId']);


        if ($userPayedPMF >= $totalPMF) {
            header('refresh: 5; url=../');
            echo '<br><pre> Hi ' . $_SESSION["user"]['FistName'] . " " . $_SESSION["user"]['LastName'] . '<br> User Maximum PMF Payed now you cannot able to pay. Please contact admin <br> Redirecting in <span id="countdown">10</span>.';
        } elseif (($userPayedPMF + $cPmf) >= $totalPMF) {

            $ablePMF = $totalPMF - $userPayedPMF;
            if ($_POST['total']) {
                $ablePMF = $cPmf / 500;
            }

            pay($api, $ablePMF, $displayCurrency, $keyId);
        } else {

            pay($api, $cPmf, $displayCurrency, $keyId);
        }
    } else {
        header('Location: psc');
    }
}

function pay($api, $cPmf, $displayCurrency, $keyId)
{
    $pmfAmount = $cPmf * 500;
    $_SESSION["PayCus-re"] = "U:" . $_SESSION["user"]['UserId'] . "- t:" . time() . "- V:" . $cPmf;

    $orderData = [
        'receipt' => $_SESSION["PayCus-re"],
        'amount' => $pmfAmount * 100,
        'currency' => 'INR',
        'payment_capture' => 1
    ];

    $razorPMFOrder = $api->order->create($orderData);

    $razorpayOrderId = $razorPMFOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $_SESSION['PMF_amount'] = $orderData['amount'] / 100;
    $_SESSION['PMF_count'] = $cPmf;

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
        "description" => "JLE MARKETING PRIVATE LIMITED" . $_SESSION['PMF_count'] . " PMF Payment",
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

    require("../payment/checkout.php");
}

?>

<script type="text/javascript">
    (function() {
        var timeLeft = 10,
            cinterval;

        var timeDec = function() {
            timeLeft--;
            document.getElementById('countdown').innerHTML = timeLeft;
            if (timeLeft === 0) {
                clearInterval(cinterval);
            }
        };

        cinterval = setInterval(timeDec, 1000);
    })();
</script>
