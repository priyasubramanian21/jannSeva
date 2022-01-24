<?php

include '../../core/support/session.php';
include '../../service/shop/shopService.php';
include "../../core/config/dataBase/connection.php";

use shopService\Shop as shopService;
use core\support\session as session;

$session = new session();
$session->start();
$userID = $_SESSION['user']['UserId'];

$Service = new shopService();

if (isset($_POST) && !empty($_POST)  && empty($_POST['shopID'])) {

    $response = $Service->shopInsert($_POST['sName'], $_POST['oName'], $_POST['phone'], $_POST['discount'], $_POST['sType'], $_POST['sCategory'], $_POST['add'], $_POST['state'], $_POST['add1'], $_POST['pin'], $_POST['city'], $_POST['country'], $userID);
} elseif (!empty($_POST['shopID'])) {

    $response = $Service->shopUpdate($_POST['sName'], $_POST['oName'], $_POST['phone'], $_POST['discount'], $_POST['sType'], $_POST['sCategory'], $_POST['add'], $_POST['state'], $_POST['add1'], $_POST['pin'], $_POST['city'], $_POST['country'], $_POST['shopID'], $userID);
}

$siteUrl = getenv("soPath");

header("location:" . $siteUrl . "home");
