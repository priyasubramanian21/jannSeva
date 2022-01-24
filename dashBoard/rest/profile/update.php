<?php
include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use Service\user\UserServiceImpl as Service;

use core\support\session as session;

$session = new session();

$session->start();

$userID = $_SESSION['user']['UserId'];

if (isset($_POST) && !empty($_POST)) {

    $Service = new Service();
    $response = $Service->updateProfile($_POST['dob'], $_POST['mobile'], $_POST['state'], $_POST['district'], $_POST['uid'], $_POST['contact_info'], $_POST['file'], $userID);

    header("location: home");
}
