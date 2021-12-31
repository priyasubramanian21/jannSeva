<?php
include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use Helpher\Helpher as Helper;

$profile = new Helper();
$session = new session();

$session->start();
$session->notSet('login');

$message = "";
$userID = "";
$Amount = "";

if (isset($_SESSION["l_userID"])) {
    $userID = $_SESSION["l_userID"];
}

if (isset($_SESSION["l_amount"])) {
    $Amount = $_SESSION["l_amount"];
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

                $profileData = $profile->userProfile($userID, $res);


                if ($res["profile"] == true) {

                    $email = $res["user"]["EmailId"];
                    $profileImg = $res["user"]['profileImg'];

                    if ($profileImg == null or empty($profileImg)) {
                        $profileImg = 'asset/image/icon/avatar.png';
                    }
                }

                ?>

                <div class="row">
                    <div class="col-md-4 "></div>
                    <div class="col-md-4 ">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <form method="post" action="sendNotification" enctype="multipart/form-data" id="myform">
                                <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
                                <div class="rounded-circle avatar" id="avatar">

                                    <img class="rounded-circle mt-5" id="imgFile" onerror="this.onerror=null; this.src='<?= $profileImg ?>'" width="150px" height="150px" src="<?php echo  $data[0]['avatar']; ?>">
                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-6"><label class="labels">Name</label><input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo  $res["user"]['FistName']; ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">Surname</label><input name="surname" type="text" class="form-control" value="<?php echo  $res["user"]['LastName']; ?>" placeholder="surname" readonly></div>
                                </div>

                                <div class="row mt-2">

                                    <div class="col-md-6"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="Email" value="<?php echo  $email; ?>" readonly></div>

                                    <div class="col-md-6"><label class="labels">Mobile no.</label><input name="mobileno" type="text" class="form-control" placeholder="Contact number" value="<?php echo $res["user"]['user_phone']; ?>" readonly></div>

                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-6"><label class="labels">Gpay or phone pay or Bhim or upi id</label><input name="uid" type="text" class="form-control" placeholder="" value="<?php echo $res["user"]['uid']; ?>" readonly></div>

                                    <div class="col-md-6"><label class="labels">Whatsapp OR Telegram</label><input name="contact_info" type="text" class="form-control" placeholder="" value="<?php echo $res["user"]['contact_info']; ?>" readonly></div>

                                </div>


                                <div class="row mt-2">

                                    <div class="col-md-12"><label class="labels">Amount</label> <input name="amount" type="text" class="form-control" placeholder="amount" value="<?php echo  $Amount; ?>" readonly></div>

                                </div>

                                <div class="row mt-2">

                                    <div class="col-md-12"><input type="submit" class="btn btn-primary profile-button" style=" width: 35%; height: 150%;"></div>

                                </div>
                            </form>

                        </div>
                    </div>


                </div>
            </div>



        </div>
    </div>



</div>
<?php include "../inc/footer.php"; ?>