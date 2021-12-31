<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JLE MARKETING PRIVATE LIMITED- SignUp</title>

    <link rel="stylesheet" href="http://localhost/jannSeva/asset/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="http://localhost/jannSeva/asset/image/logo/jle.svg" />
</head>


<?php

include '../../core/support/session.php';
include '../../core/support/postChecker.php';
include '../../service/user/UserServiceImpl.php';


use core\support\session as session;
use core\support\postChecker as post;
use service\user\UserServiceImpl as user;


$post = new post();
$user = new user();
$session = new session();

$session->start();
$message = null;

if (isset($_POST['submit'])) {

    if ($post->isTheseParametersAvailable(array('firstName', 'lastName', 'phoneNumber', 'email', 'password', 'cpassword', 'state', 'district', 'connect'))) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $connect = $_POST['connect'];
        $res = array();

        if ($password == $cpassword) {

            $message = $user->userSignUpSystem($firstName, $lastName, $phoneNumber, $email, $password, $state, $district, $connect, null, $res);

            if ($res['signup'] == true) {
                $_SESSION["signup"] = true;
                $_SESSION["login"] = false;
                $_SESSION["pay"] = true;
                $_SESSION["user"] = $res["user"];
                $message = $res["message"];


                header("location: payment");
            } else {
                $message = $res["message"];
            }
        } else {
            $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check Password</span>';
        }
    } else {
        $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check data</span>';
    }
}

if (isset($_GET['ReferenceID'])) {
    $uId = $_GET['ReferenceID'];
    $enStatus = 'readonly';
} else {
    $uId = '';
    $enStatus = '';
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
                                <img src="asset/image/logo/jle.png" width="200px" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

                            <?php echo $message; ?> <br><br>
                            <form class="pt-3" method="post" id="signUpSystem" action="#">


                                <div class="form-group">
                                    <input type="text" name="firstName" required minlength="4" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="First name">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="lastName" required minlength="1" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Last name">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" required minlength="4" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phoneNumber" required minlength="4" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Phone Number">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" required minlength="6" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="cpassword" required minlength="6" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <?php include 'state.php' ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="district" required minlength="3" class="form-control form-control-lg" placeholder="district">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="connect" required minlength="4" class="form-control form-control-lg" <?php echo $enStatus; ?> placeholder="connect ID" value="<?php echo $uId ?>">
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>

</html>