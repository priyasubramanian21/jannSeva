<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use service\user\UserServiceImpl as user;

$page = "Home";

$session = new session();
$user = new user();

$session->start();
$session->notSetS('login', "login");


include "../inc/header.php";


?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">


                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Welcome <?php echo $_SESSION["user"]['FistName'] . "  " . $_SESSION["user"]['LastName']; ?> </h3>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card tale-bg">
                            <div class="card-people mt-auto">
                                <img src="http://localhost/jannSeva/asset/image/logo/jle.png" alt="people">

                                <div class="card-body">
                                    <p class="fs-30 mb-2">
                                        <small><?php echo $_SESSION["user"]['FistName'] . "  " . $_SESSION["user"]['LastName']; ?></small>
                                    </p>
                                    <p><small> ID : <?php echo $_SESSION["user"]['UserId'] ?> </small></p>

                                    <p> Total Give Help : ₹5,150.00</p>
                                    <p> Total PMF : <?php $PMF1 = $user->totalPayedPMF($_SESSION["user"]['UserId']);
                                                    echo round($PMF1, 2) ?></p>
                                    <p> Total Tax : <?php echo round($user->totalPayedTax($PMF1), 2); ?></p>
                                    <p class="fs-30 mb-2"><small> <small>Total Received Help : ₹6,700.00</small>
                                        </small></p>


                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 grid-margin transparent">
                        <div class="row">

                            <?php echo $user->myConnectionShort($_SESSION["user"]['UserId']) ?>

                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

</div>


<?php include "../inc/footer.php"; ?>