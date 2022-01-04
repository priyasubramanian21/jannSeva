<?php
include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use Helpher\Helpher as Helper;

$helper = new Helper();
$session = new session();

$session->start();
$session->notSet('dashBoard/rest/login');
$siteUrl = 'http://localhost/jannSeva/';

$message = $helper->clearNotify($_SESSION['user']['UserId']);

header("location: " . $siteUrl . "dashBoard/rest/notify?message=" . $message);
