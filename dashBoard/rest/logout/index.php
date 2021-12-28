<?php

include '../../core/support/session.php';

use core\support\session as session;

$session = new session();


$session->start();
$session->notSet('login');


$session->sessionOut('login');

?>