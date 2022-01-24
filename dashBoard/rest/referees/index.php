<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use service\user\UserServiceImpl as user;

$session = new session();
$user = new user();

$session->start();
$session->notSet('login');
include "../inc/header.php";

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">My Connection</h4>
                            <p class="card-description"> Date : <code><?php echo Date("d F, y") ?></code> </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Profile </th>
                                            <th> Full Name </th>
                                            <th> User unId </th>
                                            <th> Phone Number </th>
                                            <th> Email Id </th>
                                            <th> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php echo $user->myConnection($_SESSION["user"]['UserId']) ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>

<?php include "../inc/footer.php"; ?>
