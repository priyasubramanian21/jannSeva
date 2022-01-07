<?php include '../../core/config/inc.php';
$siteUrl = soPath;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $titleName; ?> - Forgot Password</title>

    <link rel="stylesheet" href="<?php echo $siteUrl; ?>asset/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="<?php echo $siteUrl; ?>asset/image/logo/jle.svg" />
</head>


<?php

include '../../core/support/session.php';
include '../../core/support/postChecker.php';
include '../../service/user/UserServiceImpl.php';
include '../../core/support/emailOTP.php';
require '../../core/lib/PHPMailer/src/Exception.php';
require '../../core/lib/PHPMailer/src/PHPMailer.php';
require '../../core/lib/PHPMailer/src/SMTP.php';


use core\support\session as session;
use core\support\postChecker as post;
use service\user\UserServiceImpl as user;


$post = new post();
$user = new user();
$session = new session();

$session->start();
$session->set('dashBoard/rest/home');
$message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if ($_POST['email']) {

        $res = $user->checkEmail($_POST['email']);
        $message = $res['message'];
        $success = $res['success'];
    } else {
        $success = 0;
        $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please enter Valid EmailID</span>';
    }


    if (!empty($_POST["otp"])) {
        $res = $user->otpVerification($_POST['otp']);
        $message = $res['message'];
        $success = $res['success'];
    }

    if (!empty($_POST['password'])) {

        $success = 2;
        if ($_POST['password'] == $_POST['cpassword']) {
            $res = $user->updatePassword($_POST['password'], $_SESSION['userID']);
            if ($res == 1) {
                header("location: login");
            } else {
                $message =
                    '<span style="color: brown;font-size: smaller;font-style: normal;">Please check your password !!</span>';
            }
        } else {

            $message =
                '<span style="color: brown;font-size: smaller;font-style: normal;">Please check your password !!</span>';
        }
    }
}


?>







<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <img src="asset/image/logo/jle.png" width="200px" class="img-fluid" alt="logo">
                            </div>


                            <form class="pt-3" method="post" id="forgotpassword" action="#">
                                <center><?php echo $message; ?></center> <br>


                                <?php
                                if (!empty($success == 1)) {
                                ?>
                                    <h4>Enter OTP</h4>

                                    <p style="color:#31ab00;">Check your email for the OTP</p>

                                    <div class="form-group">
                                        <input type="text" name="otp" class="form-control form-control-lg" id="otp" placeholder="One Time Password" required>

                                        <input type="hidden" name="otp_id" class="form-control form-control-lg" id="otp_id" placeholder="One Time Password" value="<?php echo $res['otp_id']; ?>">
                                    </div>


                                    <div class="mt-3">
                                        <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="forgot()">Submit</a>
                                    </div>
                                    <br>



                                <?php
                                } else if ($success == 2) {
                                ?>
                                    <h4>Forgot Password</h4>
                                    <br>

                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="cpassword" class="form-control form-control-lg" id="cpassword" placeholder="Conform Password" required>
                                    </div>
                                    <div class="mt-3">
                                        <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="forgot()">Reset Password</a>
                                    </div>
                                    <br>
                                <?php
                                } else {
                                ?>

                                    <h4>Enter your EmailID</h4>

                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your EmailID" required>
                                    </div>
                                    <div class="mt-3">
                                        <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="forgot()">Get OTP</a>
                                    </div>
                                    <br>



                                <?php
                                }
                                ?>









                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function forgot() {
            document.getElementById('forgotpassword').submit();
        }
    </script>

</body>

</html>