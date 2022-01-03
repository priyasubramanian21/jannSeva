<?php
include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use Helpher\Helpher as Helper;

$helper = new Helper();
$session = new session();

$session->start();
$session->notSet('dashBoard/rest/login');
$siteUrl = '';

$message = $helper->clearNotify($_SESSION['user']['UserId']);

$_SESSION["permit_id_Message"] = $message;

header("location: notification");

