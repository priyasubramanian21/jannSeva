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

                <input id="st1per" value="<?php
                                            if (isset($arrayVal['level1']['percent'])) {
                                                echo $arrayVal['level1']['percent'];
                                            } else {
                                                echo intval($arrayVal['level1']['percent']);
                                            }
                                            ?>" type="hidden" />
                <input id="st2per" value="<?php if (isset($arrayVal['level2']['percent'])) {
                                                echo $arrayVal['level2']['percent'];
                                            } else {
                                                echo intval($arrayVal['level2']['percent']);
                                            }

                                            ?>" type="hidden" />
                <input id="st3per" value="<?php if (isset($arrayVal['level3']['percent'])) {
                                                echo $arrayVal['level3']['percent'];
                                            } else {
                                                echo intval($arrayVal['level3']['percent']);
                                            }

                                            ?>" type="hidden" />
                <input id="st4per" value="<?php if (isset($arrayVal['level4']['percent'])) {
                                                echo $arrayVal['level4']['percent'];
                                            } else {
                                                echo intval($arrayVal['level4']['percent']);
                                            }
                                            ?>" type="hidden" />
                <input id="st5per" value="<?php
                                            if (isset($arrayVal['level5']['percent'])) {
                                                echo $arrayVal['level5']['percent'];
                                            } else {
                                                echo intval($arrayVal['level5']['percent']);
                                            }
                                            ?>" type="hidden" />

                <?php if (empty($arrayVal['level1']['st1red'])) { ?>
                    <input id="st1red" value="2.5" type="hidden" />
                <?php } else { ?>
                    <input id="st1red" value="<?php echo $arrayVal['level1']['st1red']; ?>" type="hidden" />
                <?php  } ?>

                <?php if (empty($arrayVal['level1']['st1orange'])) { ?>
                    <input id="st1orange" value="2.5" type="hidden" />
                <?php } else { ?>
                    <input id="st1orange" value="<?php echo $arrayVal['level1']['st1orange']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level1']['st1yellow'])) { ?>
                    <input id="st1yellow" value="2.5" type="hidden" />
                <?php } else { ?>
                    <input id="st1yellow" value="<?php echo $arrayVal['level1']['st1yellow']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level1']['st1green'])) { ?>
                    <input id="st1green" value="2.5" type="hidden" />
                <?php } else { ?>
                    <input id="st1green" value="<?php echo $arrayVal['level1']['st1green'];  ?>" type="hidden" />
                <?php  } ?>


                <?php if (empty($arrayVal['level2']['st2red'])) { ?>
                    <input id="st2red" value="1.25" type="hidden" />
                <?php } else { ?>
                    <input id="st2red" value="<?php echo $arrayVal['level2']['st2red']; ?>" type="hidden" />
                <?php  } ?>

                <?php if (empty($arrayVal['level2']['st2orange'])) { ?>
                    <input id="st2orange" value="1.25" type="hidden" />
                <?php } else { ?>
                    <input id="st2orange" value="<?php echo $arrayVal['level2']['st2orange']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level2']['st2yellow'])) { ?>
                    <input id="st2yellow" value="1.25" type="hidden" />
                <?php } else { ?>
                    <input id="st2yellow" value="<?php echo $arrayVal['level2']['st2yellow']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level2']['st2green'])) { ?>
                    <input id="st2green" value="1.25" type="hidden" />
                <?php } else { ?>
                    <input id="st2green" value="<?php echo $arrayVal['level2']['st2green'];  ?>" type="hidden" />
                <?php  } ?>



                <?php if (empty($arrayVal['level3']['st3red'])) { ?>
                    <input id="st3red" value="0.46875" type="hidden" />
                <?php } else { ?>
                    <input id="st3red" value="<?php echo $arrayVal['level3']['st3red']; ?>" type="hidden" />
                <?php  } ?>

                <?php if (empty($arrayVal['level3']['st3orange'])) { ?>
                    <input id="st3orange" value="0.46875" type="hidden" />
                <?php } else { ?>
                    <input id="st3orange" value="<?php echo $arrayVal['level3']['st3orange']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level3']['st3yellow'])) { ?>
                    <input id="st3yellow" value="0.46875" type="hidden" />
                <?php } else { ?>
                    <input id="st3yellow" value="<?php echo $arrayVal['level3']['st3yellow']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level3']['st3green'])) { ?>
                    <input id="st3green" value="0.46875" type="hidden" />
                <?php } else { ?>
                    <input id="st3green" value="<?php echo $arrayVal['level3']['st3green'];  ?>" type="hidden" />
                <?php  } ?>


                <?php if (empty($arrayVal['level4']['st4red'])) { ?>
                    <input id="st4red" value="0.15625" type="hidden" />
                <?php } else { ?>
                    <input id="st4red" value="<?php echo $arrayVal['level4']['st4red']; ?>" type="hidden" />
                <?php  } ?>

                <?php if (empty($arrayVal['level4']['st4orange'])) { ?>
                    <input id="st4orange" value="0.15625" type="hidden" />
                <?php } else { ?>
                    <input id="st4orange" value="<?php echo $arrayVal['level4']['st4orange']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level4']['st4yellow'])) { ?>
                    <input id="st4yellow" value="0.15625" type="hidden" />
                <?php } else { ?>
                    <input id="st4yellow" value="<?php echo $arrayVal['level4']['st4yellow']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level4']['st4green'])) { ?>
                    <input id="st4green" value="0.15625" type="hidden" />
                <?php } else { ?>
                    <input id="st4green" value="<?php echo $arrayVal['level4']['st4green'];  ?>" type="hidden" />
                <?php  } ?>




                <?php if (empty($arrayVal['level5']['st5red'])) { ?>
                    <input id="st5red" value="0.048828125" type="hidden" />
                <?php } else { ?>
                    <input id="st5red" value="<?php echo $arrayVal['level5']['st5red']; ?>" type="hidden" />
                <?php  } ?>

                <?php if (empty($arrayVal['level5']['st5orange'])) { ?>
                    <input id="st5orange" value="0.048828125" type="hidden" />
                <?php } else { ?>
                    <input id="st5orange" value="<?php echo $arrayVal['level5']['st5orange']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level5']['st5yellow'])) { ?>
                    <input id="st5yellow" value="0.048828125" type="hidden" />
                <?php } else { ?>
                    <input id="st5yellow" value="<?php echo $arrayVal['level5']['st5yellow']; ?>" type="hidden" />
                <?php  } ?>
                <?php if (empty($arrayVal['level5']['st5green'])) { ?>
                    <input id="st5green" value="0.048828125" type="hidden" />
                <?php } else { ?>
                    <input id="st5green" value="<?php echo $arrayVal['level5']['st5green'];  ?>" type="hidden" />
                <?php  } ?>


                <div class="graph_container">
                    <canvas id="Chart1" style="width:100%;max-width:1000px;max-height:600px;"></canvas>
                </div>

            </div>

        </div>
    </div>

</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="asset/js/scriptchart.js"> </script>

<?php include "../inc/footer.php"; ?>