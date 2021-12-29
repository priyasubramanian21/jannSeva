<?php include '../../core/config/inc.php';
$siteUrl = soPath;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $titleName; ?> - Login</title>

    <link rel="stylesheet" href="<?php echo $siteUrl; ?>asset/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="<?php echo $siteUrl; ?>asset/image/logo/jle.svg" />
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
$session->set('dashBoard/rest/home');
$message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($post->isTheseParametersAvailable(array('userName', 'password'))) {

        $username = $_POST['userName'];
        $password = $_POST['password'];
        $res = array();

        $message = $user->userLoginSystem($username, $password, null, $res);

        if ($res['login'] == true) {
            $_SESSION["login"] = true;
            $_SESSION["user"] = $res["user"];
            $message = $res["message"];
            header("location: " . $siteUrl . "dashBoard/rest/home");
        } elseif ($res['pay'] == true) {
            $_SESSION["pay"] = true;
            $_SESSION["user"] = $res["user"];
            header("location: " . $siteUrl . "dashBoard/rest/payment");
        } else {
            $message = $res["message"];
        }
    } else {
        $message = '<span style="color: brown;font-size: smaller;font-style: normal;">Please enter username and password</span>';
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
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="post" id="loginSystem" action="#">

                                <center><?php echo $message; ?></center> <br>


                                <div class="form-group">
                                    <input type="text" name="userName" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="UserId">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="Login()">SIGN IN</a>
                                </div>
                                <br>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="signUp" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function Login() {
            document.getElementById('loginSystem').submit();
        }
    </script>
</body>

</html>