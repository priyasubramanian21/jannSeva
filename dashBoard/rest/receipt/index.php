

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
                                    <h4 class="card-title">Payment Receipt</h4>
                                    <p class="card-description"> Date :  <code><?php echo Date("d F, y") ?></code> </p>
                                    <div class="table-responsive">


                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Receipt ID </th>
                                                <th> Number Of PMF </th>
                                                <th> Amount </th>
                                                <th> Status </th>
                                                <th> Receipt </th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php echo $user->myReceiptListing($_SESSION["user"]['UserId']) ?>


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
