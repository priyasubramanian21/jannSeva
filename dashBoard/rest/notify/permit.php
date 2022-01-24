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

if (isset($_SESSION["permit_id"]))
{
    $message = $helper->setConfirmed($_SESSION["permit_id"]);

    $_SESSION["permit_id_Message"] = $message;

    header("location: notification");
}
die();
