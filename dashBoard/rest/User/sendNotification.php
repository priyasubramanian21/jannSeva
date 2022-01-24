<?php
include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use Helpher\Helpher as Helper;

$helper = new Helper();
$session = new session();

$session->start();
$session->notSet('login');
$siteUrl = '';

$status = $helper->setNotification($_POST['userID'], $_POST['amount'], $_SESSION['user']['UserId']);

header("location: GiveHelp");
