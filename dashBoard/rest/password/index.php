<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php

include '../../core/support/session.php';
include '../../core/support/postChecker.php';
include '../../service/user/UserServiceImpl.php';


use core\support\session as session;
use core\support\postChecker as post;
use service\user\UserServiceImpl as user;
use Helpher\Helpher as Helpher;

$Helpher = new Helpher();
$post = new post();
$user = new user();
$session = new session();


$session->start();
$message = null;

$getVal = $Helpher->checkGiveHelpStatus($_SESSION['user']['UserId']);

if (isset($getVal) && $getVal !=0) {
    $giveHelpStatus = 1;
} else {
    $giveHelpStatus = 0;
}

if (isset($_POST['submit'])) {

    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $res = array();

    $userID = $_SESSION['user']['UserId'];

    if ($password == $cpassword) {


        $message = $user->updatePassword($password, $userID);

        if ($message == true) {
            header("location: home");
        } else {
            $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check Password</span>';
        }
    } else {
        $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check Password</span>';
    }
}

include '../inc/header.php';

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <br>
            <div class="text-center"><?php echo $message;  ?> </div> <br>
            <!-- <form > -->

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <form class="pt-3" method="post" id="restSystem" action="#">

                                <div class="d-flex justify-content-between align-items-center experience"><span>Rest Password</span></div></BR>


                                <div class="form-group">
                                    <input type="password" name="password" required minlength="6" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="cpassword" required minlength="6" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3" style="width: fit-content;">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit">Update Password</button>
                                </div>
                                <!-- </form> -->

                            </form>

                        </div>

                    </div>

                      <div class="col-md-5" <?php if ($giveHelpStatus == 1) { ?> style="display: none;" <?php } ?>>


                        <div class=" p-3 py-5">
                            
                            <div class="d-flex justify-content-between align-items-center experience"><span>Change Connect</span></div></BR>


                            <div class="form-group">
                                <input type="text" name="connect" required class="form-control form-control-lg" id="connect" placeholder="Refernce ID">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="user" id='user' class="form-control form-control-lg" value="<?php echo $_SESSION['user']['UserId']; ?>">

                                <input type="text" name="name" id='name' class="form-control form-control-lg" placeholder="Connect Name">
                            </div>

                            <div class="mt-3" style="display: true; width: fit-content;">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="button" id="getConnect">Verify</button>
                            </div>




                            <div class="mt-3" style="width: fit-content;">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="button" id="getConform" >Conform</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>



</div>
<script src="connectjs"></script>


<?php include "../inc/footer.php"; ?>