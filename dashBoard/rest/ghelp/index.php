<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use service\user\UserServiceImpl as user;

$session = new session();
$user = new user();

$session->start();
$session->notSet('dashBoard/rest/login');



include "../inc/header.php";

?>
<style>
    tr:nth-child(n + 6) {
        display: none;
    }

    body {
        counter-reset: Serial;
    }

    tr td:first-child:before {
        counter-increment: Serial;
        content: counter(Serial);
    }
</style>



<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">GIVE HELP</h4>
                            <p class="card-description"> Date : <code><?php echo Date("d F, y") ?></code> </p>
                            <div class="table-responsive">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            <th> User Id </th>
                                            <th> Amount </th>
                                            <th> Status </th>
                                            <th> Phone Number </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        echo $user->myHelp($_SESSION['user']['UserId']); ?>

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