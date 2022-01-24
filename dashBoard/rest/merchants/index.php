<?php

include '../../core/support/session.php';
include '../../service/shop/shopService.php';
include '../../service/user/Helpher.php';
include "../../core/config/dataBase/connection.php";

use core\support\session as session;
use shopService\Shop as shopService;


$session = new session();
$Service = new shopService();


$session->start();
$session->notSet('login');

$response = $Service->getShopDetails($_SESSION['user']['UserId']);


include "../inc/header.php";

?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <br><br>
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Shop Registration</h4>

                        <form method="post" action="dashBoard/rest/merchants/update.php" class="form-sample">

                            <p class="card-description">
                                Shop info
                            </p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Shop Name</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="shopID" value="<?php echo $response['shop_id']; ?>" />
                                            <input type="text" name="sName" required autocomplete="off" class="form-control" value="<?php echo $response['shop_name']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Owner Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="oName" required autocomplete="off" class="form-control" value="<?php echo $response['owner_name']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="phone" required autocomplete="off" class="form-control" value="<?php echo $response['phone']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Discount</label>
                                        <div class="col-sm-9">
                                            <input type="number" maxlength="3" name="discount" required autocomplete="off" class="form-control" value="<?php echo $response['discount']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Shop Type</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sType" required autocomplete="off" class="form-control" value="<?php echo $response['shop_type']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Shop Category</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sCategory" required autocomplete="off" class="form-control" value="<?php echo $response['shop_category']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="add" required autocomplete="off" class="form-control" value="<?php echo $response['address1']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">State</label>
                                        <div class="col-sm-9">
                                            <?php include '../signUp/state.php' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="add1" required autocomplete="off" class="form-control" value="<?php echo $response['address2']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Postcode</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="pin" required autocomplete="off" class="form-control" value="<?php echo $response['postcode']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="city" required autocomplete="off" class="form-control" value="<?php echo $response['city']; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Country</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="country">
                                                <option value="IN">IN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center><button type="submit" class="btn btn-primary mr-2">Submit</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../inc/footer.php"; ?>