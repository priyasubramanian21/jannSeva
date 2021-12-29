<?php

include '../../core/support/session.php';
include '../../core/support/postChecker.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use core\support\postChecker as post;
use service\user\UserServiceImpl as user;


$post = new post();
$profile = new user();
$session = new session();

$session->start();
$message = null;

$session->start();
$session->notSetS('login', "login");

if (!isset($_SESSION["user"]["UserId"])) {
    header("location: dashBoard/rest/login");
    unset($_SESSION["login"]);
    unset($_SESSION["signup"]);
    unset($_SESSION["user"]);
}

include '../inc/header.php';

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <br>
            <div class="text-center"><?php echo $message;  ?> </div> <br>

            <div class="container rounded bg-white mt-5 mb-5">

                <?php
                $res = array();
                $name = "";
                $email = "";
                $profileImg = "asset/image/icon/avatar.png";

                $profileData = $profile->userMainProfile($_SESSION['user']["UserId"], $res);


                if ($res["profile"] == true) {
                    $name = $res["user"]["FistName"] . " " . $res["user"]["LastName"];
                    $email = $res["user"]["EmailId"];
                    $profileImg = $res["user"]['profileImg'];

                    if ($profileImg == null or empty($profileImg)) {
                        $profileImg = 'http://localhost/jannSeva/asset/image/icon/avatar.png';
                    }
                }

                ?>

                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <form method="post" action="" enctype="multipart/form-data" id="myform">

                                <div class="rounded-circle avatar" id="avatar">

                                    <img class="rounded-circle mt-5" id="imgFile" onerror="this.onerror=null; this.src='<?= $profileImg ?>'" width="150px" height="150px" src="<?php echo  $data[0]['avatar']; ?>">
                                </div>

                                <div class="p-image">
                                    <input class="d-none" type="file" id="file" name="file" />
                                    <input type="button" class="upl-btn button" value="Upload" id="but_upload">

                                </div><br>
                            </form>
                            <span class="font-weight-bold"> <?= $name ?> </span>
                            <span class="text-black-50"><b>Male</b></span> <span class="text-black-50">
                                <?= $email ?></span> <span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>

                            <!-- <form > -->
                            <form class="col-md-12 grid-margin" method="post" id="profilerRegister">

                                <div class="row mt-2">

                                    <div class="col-md-6"><label class="labels">Name</label><input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo  $data[0]['FirstName']; ?>"></div>
                                    <div class="col-md-6"><label class="labels">Surname</label><input name="surname" type="text" class="form-control" value="<?php echo  $data[0]['LastName']; ?>" placeholder="surname"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Mobile Number</label><input name="mobile" type="text" class="form-control" placeholder="enter phone number" value="<?php echo  $data[0]['PhoneNumber']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Address Line 1</label><input name="address1" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo  $data[0]['Address1']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Address Line 2</label><input name="address2" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo  $data[0]['Address2']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Postcode</label><input name="postCode" type="text" class="form-control" placeholder="postCode" value="<?php echo  $data[0]['PostCode']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">State</label><input name="state" type="text" class="form-control" placeholder="state" value="<?php echo  $data[0]['State']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Area</label><input name="area" type="text" class="form-control" placeholder="area" value="<?php echo  $data[0]['Area']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Email ID</label><input name="email_id" type="text" class="form-control" placeholder="enter email id" value="<?php echo  $data[0]['EmailId']; ?>"></div>
                                    <div class="col-md-12"><label class="labels">Education</label><input name="education" type="text" class="form-control" placeholder="education" value="<?php echo  $data[0]['Education']; ?>"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">Country</label><input name="country" type="text" class="form-control" placeholder="country" value="<?php echo  $data[0]['Country']; ?>"></div>
                                    <div class="col-md-6"><label class="labels">State/Region</label><input name="state_region" type="text" class="form-control" value="<?php echo  $data[0]['StateRegion']; ?>" placeholder="state"></div>
                                </div>
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" onclick="profilerRegister()" type="button">Save Profile</button></div>

                                <!-- </form> -->

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience"><span>Id Proof Details</span></div><br>
                            <div class="col-md-12"><label class="labels">Uid Number</label><input name="uid" type="text" class="form-control" placeholder="experience" value="<?php echo  $data[0]['UID']; ?>"></div> <br>
                            <div class="col-md-12"><label class="labels">Pan Card Number</label><input name="pan_card" type="text" class="form-control" placeholder="additional details" value="<?php echo  $data[0]['PAN']; ?>"></div>
                        </div>
                    </div>
                </div>
            </div>

            </form>

        </div>
    </div>



</div>

<script type="text/javascript">
    function profilerRegister() {
        document.getElementById('profilerRegister').submit();
    }
</script>


<?php include "../inc/footer.php"; ?>