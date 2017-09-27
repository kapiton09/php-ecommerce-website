<!-- Configuration-->

<?php require_once("../resources/config.php"); ?>

<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>

<?php

if(isset($_SESSION['customer_username'])) {

    redirect("index.php");

}

?>


         <!-- Contact Section -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Register</h2>
                    <h4 class="section-subheading text-muted">
                        <?php display_message(); ?>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center bg-success"><?php display_message(); ?></h3>
                    <form method="post">
                        <?php send_email();?>

                        <?php add_customer();?>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_username">Username</label>
                                <input name="customer_username" type="text" class="form-control" required >
                            </div>
                            <div class="form-group">
                                <label for="customer_password">Password</label>
                                <input name="customer_password" type="password" class="form-control" required >
                            </div>
                        <div class="form-group">
                            <label for="customer_email-email">Email</label>
                            <input name="customer_email" type="email" class="form-control" required >
                        </div>
                        <div class="form-group">
                            <label for="customer_first_name">First Name</label>
                            <input name="customer_first_name" type="text" class="form-control" required >
                        </div>
                        <div class="form-group">
                            <label for="customer_last_name">Last Name</label>
                            <input name="customer_last_name" type="text" class="form-control" required >
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_home_phone">Home Phone</label>
                                <input name="customer_home_phone" type="number" class="form-control" >
                            </div>
                        <div class="form-group">
                            <label for="customer_work_phone">Work Phone</label>
                            <input name="customer_work_phone" type="number" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="customer_mobile_phone">Mobile</label>
                            <input name="customer_mobile_phone" type="number" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Address</label>
                            <textarea name="customer_address" id="" cols="15" rows="4" class="form-control" required></textarea>                        </div>

                        <div class="form-group">

                            <input type="submit" name="add_customer" class="btn btn-primary" value="Register">
                        </div>
                        </div>

                    </form>                </div>
            </div>
            <p>If you have already registered, <a href="login.php">Please Log in here</a> </p>
        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>