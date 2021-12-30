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
<style>
    table th,
    table td {
        text-align: center;
    }

    .pagination li:hover {
        cursor: pointer;
    }

    table tbody tr {
        display: none;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
</style>


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



                                    <div class="container">

                                        <div class="form-group">
                                            <!--		Show Numbers Of Rows 		-->
                                            <select class="form-control" name="state" id="maxRows">
                                                <option value="5000">Show ALL Rows</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="70">70</option>
                                                <option value="100">100</option>
                                            </select>

                                        </div>

                                        <table class="table table-striped table-class" id="table-id">

                                            <thead>
                                                <tr>
                                                    <th>Amount</th>
                                                    <th>Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php for ($x = 0; $x < 100; $x++) { ?>
                                                    <tr>
                                                        <td>

                                                            ₹

                                                            <input readonly type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Amount" value="500">
                                                        </td>
                                                        <td> <?php
                                                                if ($user->numberOfPMF($_SESSION["user"]['UserId']) < 100) {
                                                                    echo '<button type="submit" class="btn btn-primary mb-2">Pay</button>';
                                                                }
                                                                ?></td>

                                                    </tr>
                                                <?php  } ?>



                                            </tbody>

                                        </table>

                                        <!--		Start Pagination -->
                                        <div class='pagination-container'>
                                            <nav>
                                                <ul class="pagination">

                                                    <li data-page="prev">
                                                        <span>
                                                            < <span class="sr-only">(current)
                                                        </span></span>
                                                    </li>
                                                    <!--	Here the JS Function Will Add the Rows -->
                                                    <li data-page="next" id="prev">
                                                        <span> > <span class="sr-only">(current)</span></span>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>

                                    </div> <!-- 		End of Container -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="pagination.js"></script>

<script>
    var select = document.getElementById('inlineFormInputName2');
    var input = document.getElementById('inlineFormInputGroupUsername2');
    select.onchange = function() {
        input.value = select.value * 500;
    }
</script>


<?php include "../inc/footer.php"; ?>