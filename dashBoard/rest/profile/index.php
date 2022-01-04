<?php

include '../../core/support/session.php';
include '../../core/config/inc.php';
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

$referralLink = soPath . "dashBoard/rest/signUp/index.php?ReferenceID=" . $_SESSION["user"]["UserId"];

include '../inc/header.php';

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <br>
            <div class="text-center"><?php echo $message;  ?> </div> <br>
            <!-- <form > -->
            <form class="col-md-12 grid-margin" method="post" action="update.php" id="profilerRegister">


                <div class="container rounded bg-white mt-5 mb-5">

                    <?php
                    $res = array();
                    $name = "";
                    $email = "";
                    $profileImg = "asset/image/icon/avatar.png";

                    $profileData = $profile->userMainProfile($_SESSION['user']["UserId"], $res);

                    $data = $profile->getProfileData($_SESSION['user']["UserId"]);


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

                                        <img class="rounded-circle mt-5" id="imgFile" onerror="this.onerror=null; this.src='<?= $profileImg ?>'" width="150px" height="150px" src="<?php echo  $data['profile_img']; ?>">
                                    </div>

                                    <div class="p-image">
                                        <input class="d-none" type="file" id="file" name="file" />
                                        <input type="button" class="upl-btn button" value="Upload" id="but_upload">

                                    </div><br>
                                </form>
                                <span class="font-weight-bold"> <?= $name ?> </span>
                                <span class="text-black-50"><b>Male</b></span> <span class="text-black-50">
                                    <?= $email ?></span> <span> </span>

                                <span class="font-weight-bold" style="padding-top: 25%;"><b><strong>Reference Link </strong></b></span> <span class="text-black-50">
                                    <?= $referralLink ?></span> <span> </span>
                            </div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Settings</h4>
                                </div>


                                <div class="row mt-2">
                                    <input name=userID type="hidden" value="<?php echo  $data['user_id']; ?>" />

                                    <div class="col-md-6"><label class="labels">Name</label><input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo  $data['user_first_name']; ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">Surname</label><input name="surname" type="text" class="form-control" value="<?php echo  $data['user_last_name']; ?>" placeholder="surname" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">DOB</label><input name="dob" type="date" class="form-control" placeholder="Date of Birth" value="<?php echo  $data['dob']; ?>"></div>

                                    <div class="col-md-12"><label class="labels">Mobile Number</label><input name="mobile" type="text" class="form-control" placeholder="enter phone number" value="<?php echo  $data['user_phone']; ?>" readonly></div>

                                    <div class="col-md-12"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="enter Email" value="<?php echo  $data['user_email']; ?>" readonly></div>

                                    <div class="col-md-12"><label class="labels">State</label><input name="state" type="text" class="form-control" placeholder="state" value="<?php echo  $data['state']; ?>"></div>

                                    <div class="col-md-12"><label class="labels">District</label><input name="district" type="text" class="form-control" placeholder="area" value="<?php echo  $data['district']; ?>"></div>

                                </div>



                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center experience"><span>Id Proof Details</span></div></BR>
                                <div class="col-md-12"><label class="labels"> Gpay or phone pay or Bhim or upi id</label><input name="uid" type="text" class="form-control" placeholder="upi ID" value="<?php echo  $data['uid']; ?>"></div>

                                <div class="col-md-12"><label class="labels">Whatsapp OR Telegram</label><input name="contact_info" type="text" class="form-control" placeholder="Enter any one contact info" value="<?php echo  $data['contact_info']; ?>"></div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" onclick="profilerRegister()" type="button">Save Profile</button></div>
                        </div>
                    </div>
                </div>

                <!-- </form> -->

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