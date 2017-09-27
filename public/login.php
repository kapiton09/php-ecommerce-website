<?php require_once("../resources/config.php")?>

<?php include(TEMPLATE_FRONT . DS . "header.php" ) ?>

    <!-- Page Content -->
    <div class="container">

      <header>
        <div class="col-sm-8">
            <h1 class="">Login</h1>
            <form class="" action="" method="post" enctype="multipart/form-data">

                <?php login_customer(); ?>

                <div class="form-group"><label for="">
                    Username<input type="text" name="customer_username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="customer_password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" value="Login"> <p style="margin-top: 50px"> If you have not registered yet, register <a href="register_customer.php">here</a> </p>
                </div>
            </form>
        </div>

    </header>


        </div>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php" ) ?>