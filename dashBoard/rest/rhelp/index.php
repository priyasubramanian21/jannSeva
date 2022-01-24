<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

use core\support\session as session;
use service\user\UserServiceImpl as user;

$session = new session();
$user = new user();

$session->start();
$session->notSet('login');
include "../inc/header.php";
$connectID = $_SESSION['user']['UserId'];
$arrayVal = $user->getPercentageConnect($connectID);

?>


    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-md-12 grid-margin">

                    <input id="st1per" value="" type="hidden"/>
                    <input id="st2per" value="" type="hidden"/>
                    <input id="st3per" value="" type="hidden"/>
                    <input id="st4per" value="" type="hidden"/>
                    <input id="st5per" value="" type="hidden"/>


                    <input id="st1red" value="100" type="hidden"/>
                    <input id="st1orange" value="0" type="hidden"/>
                    <input id="st1yellow" value="0" type="hidden"/>
                    <input id="st1green" value="0" type="hidden"/>
                    <input id="st2red" value="0" type="hidden"/>


                    <input id="st2orange" value="0" type="hidden"/>
                    <input id="st2yellow" value="100" type="hidden"/>
                    <input id="st2green" value=0" type="hidden"/>
                    <input id="st2green" value="0" type="hidden"/>

                    <input id="st3red" value="0" type="hidden"/>
                    <input id="st3orange" value="0" type="hidden"/>
                    <input id="st3yellow" value="0" type="hidden"/>
                    <input id="st3green" value="100" type="hidden"/>

                    <input id="st4red" value="0" type="hidden"/>
                    <input id="st4orange" value="0" type="hidden"/>
                    <input id="st4yellow" value="100" type="hidden"/>
                    <input id="st4green" value="0" type="hidden"/>


                    <input id="st5red" value="0" type="hidden"/>
                    <input id="st5orange" value="100" type="hidden"/>
                    <input id="st5yellow" value="0" type="hidden"/>
                    <input id="st5green" value="0" type="hidden"/>
                    
                    <input id="st6red" value="0" type="hidden"/>
                    <input id="st6orange" value="0" type="hidden"/>
                    <input id="st6yellow" value="0" type="hidden"/>
                    <input id="st6green" value="100" type="hidden"/>


                    <div class="graph_container">

                        <canvas id="Chart1" style="width:100%;max-width:1000px;max-height:600px;"></canvas>

                    </div>

                </div>

            </div>
        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="asset/js/scriptchart.js"></script>

<?php include "../inc/footer.php"; ?>
