<?php

include '../../core/support/session.php';
include '../../service/user/UserServiceImpl.php';

$page = "PMF";

use core\support\session as session;
use service\user\UserServiceImpl as user;

$session = new session();
$user = new user();

$session->start();
$session->notSet('dashBoard/rest/login');
include "../inc/header.php";

?>


<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Payment Receipt</h4>
                            <p class="card-description"> Date : <code><?php echo Date("d F, y") ?></code> </p>
                            <div class="table-responsive">


                                <br><br>


                                <form class="form-inline" method="post" action="Pay">
                                    <label class="sr-only" for="inlineFormInputName2">PSC Count</label>

                                    <br>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php include 'pmf.php' ?>

                                    <label class="sr-only" for="inlineFormInputGroupUsername2">Amount</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₹</div>
                                        </div>
                                        <input readonly type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Amount" value="500">
                                    </div>
                                    <div class="form-check mx-sm-2">
                                        <label class="form-check-label">
                                        </label>
                                    </div>

                                    <?php
                                    if ($user->numberOfPMF($_SESSION["user"]['UserId']) < 100) {
                                        echo '<button type="submit" class="btn btn-primary mb-2">Pay</button>';
                                    }
                                    ?>


                                </form>



                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>


<script>
    var select = document.getElementById('inlineFormInputName2');
    var input = document.getElementById('inlineFormInputGroupUsername2');
    select.onchange = function() {
        input.value = select.value * 500;
    }
</script>


<?php include "../inc/footer.php"; ?>