<?php include "inc/header.php";

include '../dashBoard/service/shop/shopService.php';
include "../dashBoard/core/config/dataBase/connection.php";

use shopService\Shop as shopService;

$Service = new shopService();


$response = $Service->getShopDetailsByArea($_POST['country'], $_POST['state'], $_POST['city']);

?>



<section>

    <div class="container">

        <div class="text-center ">

            <h2 class="text-center main-heading"> Partners </h2>

        </div>


        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Filter your locations</h4>

                    <form class="form-inline" action="#" method="POST">
                        <center>
                            <label class="sr-only" for="inlineFormInputName2">Name</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" readonly value="IN" id="country" name="country" placeholder="IN">

                            <label class="sr-only" for="inlineFormInputName2">State</label>
                            <?php include 'inc/state.php' ?>

                            <label class="sr-only" for="inlineFormInputName2">City</label>
                            <input type="text" required class="form-control mb-2 mr-sm-2" id="city" name="city" placeholder="City">

                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </center>
                    </form>

                    <?php if (empty($response)) { ?>
                        <span> No Records Founds. </span>
                    <?php } else { ?>


                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Owner Name</th>
                                    <th scope="col">Contact no.</th>
                                    <th scope="col">Shop Type</th>
                                    <th scope="col">Shop Category</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td><?php echo $response['shop_name']; ?></td>
                                    <td><?php echo $response['owner_name']; ?></td>
                                    <td><?php echo $response['phone']; ?></td>
                                    <td><?php echo $response['shop_type']; ?></td>
                                    <td><?php echo $response['shop_category']; ?></td>
                                    <td><?php echo $response['address1'] . ', ' . $response['address2'] . ', ' . $response['city'] . ', ' . $response['state'] . ', ' . $response['country'] . '-' . $response['postcode']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>

</section>

<?php include "inc/footer.php" ?>