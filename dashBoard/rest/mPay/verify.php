<?php

require('../payment/config.php');

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';
include '../../service/payment/PaymentServiceImpl.php';
require('../../core/lib/razorpay/Razorpay.php');
include("../../core/lib/dompdf/autoload.inc.php");
include '../../core/support/InvoiceTemp.php';


use core\support\session as session;
use service\payment\PaymentServiceImpl as payment;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Dompdf\Dompdf as PdfLib;
use service\user\UserServiceImpl as user;

$api = new Api($keyId, $keySecret);

$session = new session();
$user = new user();
$session->start();
$session->notSet('login');

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature'],
            'amount' => $_SESSION['PMF_amount'],
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    $data = array();
    $data = $attributes;

    $session = new session();
    $payment = new payment();

    $session->start();


    $pdfLib = new PdfLib();
    $pdfLib->loadHtml(templateInvoice($_SESSION['razorpay_order_id']));
    $pdfLib->setPaper('A4', 'portrait');
    $pdfLib->render();
    $pdf = $pdfLib->output();

    $pdfName = round(microtime(true) * 1000) . ".pdf";
    $pdf_upload_dir = 'storage/invoice/' . $pdfName;

    $rootFolder = '';

    $pdfStore = $rootFolder . $pdf_upload_dir;

    $status = file_put_contents($pdfStore, $pdf);

    if ($status) {


        if (isset($_SESSION["user"])) {

            $userId = $_SESSION["user"]['UserId'];
            $rep_id = $_SESSION["PayCus-re"];


            // echo "Done";

            return $payment->PMFPay($userId, $attributes, $rep_id, $pdf_upload_dir, $_SESSION['PMF_count']);
        } else {

            echo "session not found";
        }
    } else {
        echo "Server Error";
    }
} else {
    echo $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}


function templateInvoice($order_id)
{

    $fnx = strtoupper($_SESSION["user"]['FistName'][0]);
    $fny = strtolower(substr($_SESSION["user"]['FistName'], 1));

    $lnx = strtoupper($_SESSION["user"]['LastName'][0]);
    $lny = strtolower(substr($_SESSION["user"]['LastName'], 1));

    $FullName = $fnx . $fny . " " . $lnx . $lny;

    $userData['FullName'] = $FullName;

    $userData['EmailId'] = strtoupper($_SESSION["user"]['EmailId'][0]) . strtolower(substr($_SESSION["user"]['EmailId'], 1));


    $orderId = ltrim($order_id, 'order_');

    return invoiceTemplate($userData, $_SESSION["PayCus-re"], $orderId, $_SESSION['PMF_amount'], $_SESSION['PMF_count']);
}
