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
if (isset($_SESSION['user']['UserId'])) {
    $connectID = $_SESSION['user']['UserId'];
    $arrayVal = $user->getPercentageConnect($connectID);
}


?>
<style>
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
                            <h4 class="card-title">Level</h4>
                            <p class="card-description"> Date : <code><?php echo Date("d F, y") ?></code> </p>
                            <div class="table-responsive">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            <th> User Id </th>
                                            <th> Amount </th>
                                            <th> Phone Number </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if ($_GET['level'] == 1) {
                                        ?>

                                            <?php

                                            if (isset($arrayVal['level1']['data'])) {
                                                for ($x = 0; $x < count($arrayVal['level1']['data']); $x++) {  ?>
                                                    <tr>
                                                        <td></td>
                                                        <td> <?php

                                                                echo $arrayVal['level1']['data'][$x]['user_first_name'] . " " . $arrayVal['level1']['data'][$x]['user_last_name'] ?> </td>
                                                        <td> <?php

                                                                echo $arrayVal['level1']['data'][$x]['user_id'] ?></td>
                                                        <td> ₹ 500 </td>

                                                        <td> <?php

                                                                echo $arrayVal['level1']['data'][$x]['user_phone'] ?></td>
                                                    </tr>

                                            <?php  }
                                            } ?>
                                        <?php } elseif ($_GET['level'] == 2) { ?>

                                            <?php
                                            if (isset($arrayVal['level2']['data'])) {
                                                for ($x = 0; $x < count($arrayVal['level2']['data']); $x++) {  ?>
                                                    <tr>
                                                        <td></td>
                                                        <td> <?php

                                                                echo $arrayVal['level2']['data'][$x]['user_first_name'] . " " . $arrayVal['level2']['data'][$x]['user_last_name'] ?> </td>
                                                        <td> <?php

                                                                echo $arrayVal['level2']['data'][$x]['user_id'] ?></td>
                                                        <td> ₹ 500 </td>

                                                        <td> <?php

                                                                echo $arrayVal['level2']['data'][$x]['user_phone'] ?></td>
                                                    </tr>

                                            <?php  }
                                            } ?>
                                        <?php } elseif ($_GET['level'] == 3) { ?>

                                            <?php
                                            if (isset($arrayVal['level3']['data'])) {
                                                for ($x = 0; $x < count($arrayVal['level3']['data']); $x++) {  ?>
                                                    <tr>
                                                        <td></td>
                                                        <td> <?php

                                                                echo $arrayVal['level3']['data'][$x]['user_first_name'] . " " . $arrayVal['level3']['data'][$x]['user_last_name'] ?> </td>
                                                        <td> <?php

                                                                echo $arrayVal['level3']['data'][$x]['user_id'] ?></td>
                                                        <td> ₹ 500 </td>

                                                        <td> <?php

                                                                echo $arrayVal['level3']['data'][$x]['user_phone'] ?></td>
                                                    </tr>

                                            <?php  }
                                            } ?>
                                        <?php } elseif ($_GET['level'] == 4) { ?>

                                            <?php
                                            if (isset($arrayVal['level4']['data'])) {
                                                for ($x = 0; $x < count($arrayVal['level4']['data']); $x++) {  ?>
                                                    <tr>
                                                        <td></td>
                                                        <td> <?php

                                                                echo $arrayVal['level4']['data'][$x]['user_first_name'] . " " . $arrayVal['level4']['data'][$x]['user_last_name'] ?> </td>
                                                        <td> <?php

                                                                echo $arrayVal['level4']['data'][$x]['user_id'] ?></td>
                                                        <td> ₹ 500 </td>

                                                        <td> <?php

                                                                echo $arrayVal['level4']['data'][$x]['user_phone'] ?></td>
                                                    </tr>

                                            <?php  }
                                            } ?>
                                        <?php } elseif ($_GET['level'] == 5) { ?>

                                            <?php
                                            if (isset($arrayVal['level5']['data'])) {
                                                for ($x = 0; $x < count($arrayVal['level5']['data']); $x++) {  ?>
                                                    <tr>
                                                        <td></td>
                                                        <td> <?php

                                                                echo $arrayVal['level5']['data'][$x]['user_first_name'] . " " . $arrayVal['level5']['data'][$x]['user_last_name'] ?> </td>
                                                        <td> <?php

                                                                echo $arrayVal['level5']['data'][$x]['user_id'] ?></td>
                                                        <td> ₹ 800 </td>

                                                        <td> <?php

                                                                echo $arrayVal['level5']['data'][$x]['user_phone'] ?></td>
                                                    </tr>

                                            <?php  }
                                            } ?>
                                        <?php } ?>
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