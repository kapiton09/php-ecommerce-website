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
                    <h2 class="section-heading">Details</h2>
                    <h3 class="section-subheading text-muted">
                        <?php display_message(); ?>
                    </h3>
                </div>
                <div class="col-lg-12">
                    <h3>Your Personal Details</h3>
                    <hr class="dl-horizontal" />
                    <div class="col-md-12">

                        <?php get_customer_details(); ?>

                    </div>
                </div>
                <br>
            </div>

            </div>
        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>