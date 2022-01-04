<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use service\user\UserServiceImpl as user;
use Helpher\Helpher as Helper;

$session = new session();
$user = new user();
$Helper = new Helper();

$session->start();
$session->notSet('dashBoard/rest/login');
$message = '';
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

$siteURL = 'http://localhost/jannSeva/';

include "../inc/header.php";

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
            <br>
            <div class="text-center"><?php echo $message;  ?> </div> <br>

            <div class="col-md-12 grid-margin">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Notification</h4>
                            <p class="card-description"> Date : <code><?php echo Date("d F, y") ?></code> </p>
                            <a href="clear.php" style="float: right;"><label class='badge badge-info'> ClearALL </label></a>
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

                                        $data = $Helper->myNotification($_SESSION['user']['UserId']);


                                        ?>

                                        <?php if ($data['receiver'] == 0 && empty($data['status'])) { ?>

                                            <tr> <label class='badge badge-danger'> No Record Founds.</label> </tr>
                                        <?php

                                        } elseif ($data['status'] == 'Available') { ?>

                                            <tr> <label class='badge badge-info'> Please Complete your GiveHelp Payment. You have <?php echo $data['count']; ?> Receiver Waiting!! </label> </tr>

                                            <?php
                                        } else {
                                            for ($x = 0; $x < count($data['receiver']); $x++) {
                                                $res = array();
                                                $Data = $Helper->userProfile($data['receiver'][$x]['sender_id'], $res);

                                                $redirectUrl = "permit.php?sender_id=" . $data['receiver'][$x]['sender_id'];
                                                $status = "Click confirmed";


                                            ?>
                                                <tr>
                                                    <td> </td>
                                                    <td><?= $Data['user']['FistName'] . " " . $Data['user']['LastName'] ?> </td>
                                                    <td><?= $data['receiver'][$x]['sender_id'] ?></td>
                                                    <td><?= $data['receiver'][$x]['amount'] ?> </td>
                                                    <td> <a href="<?= $redirectUrl ?>"><label class='badge badge-danger'><?= $status ?> </label></a></td>
                                                    <td><?= $Data['user']['user_phone'] ?> </td>
                                                </tr>

                                        <?php }
                                        } ?>

                                        <?php if (!empty($data['generalNotify'])) {

                                            for ($x = 0; $x < count($data['generalNotify']); $x++) {
                                                $res = array();
                                                $DataI = $Helper->userProfile($data['generalNotify'][$x]['sender_id'], $res);

                                                $redirectUrl = $siteURL . "dashBoard/rest/pmf/index.php";
                                                $status = "Pay Your PSC";

                                        ?>

                                                <tr>
                                                    <td> </td>
                                                    <td><?= $DataI['user']['FistName'] . " " . $DataI['user']['LastName'] ?> </td>
                                                    <td><?= $data['generalNotify'][$x]['sender_id'] ?></td>
                                                    <td><?= $data['generalNotify'][$x]['amount'] ?> </td>
                                                    <td> <a href="<?= $redirectUrl ?>"><label class='badge badge-danger'><?= $status ?> </label></a>
                                                    </td>
                                                    <td><?= $DataI['user']['user_phone'] ?> </td>
                                                </tr>

                                        <?php }
                                        } ?>
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