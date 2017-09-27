<!-- Configuration-->

<?php require_once("../resources/config.php"); ?>

<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>

<?php

if(!isset($_SESSION['customer_username'])) {

    redirect("index.php");

}

?>

         <!-- Contact Section -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">Orders</h2>
                    <h3 class="section-subheading text-muted">
                        <?php display_message(); ?>
                    </h3>
                </div>
                <div class="col-lg-12">
                    <h3>Your Order Details</h3>
                    <hr class="dl-horizontal" />

                    <table class="table table-hover">


                        <thead>

                        <tr>
                            <th>Order Id</th>
                            <th></th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Order Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php get_customer_order_details(); ?>

                        </tbody>
                    </table>

                </div>
                <br>
            </div>

            </div>
        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>