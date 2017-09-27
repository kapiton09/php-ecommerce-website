<?php require_once("../../resources/config.php")?>

<?php include(TEMPLATE_BACK . "/header.php" ) ?>

<?php

if(!isset($_SESSION['username'])) {

    redirect("../../public/login_admin.php");

}

?>

<div id="page-wrapper">

            <div class="container-fluid">


                <?php

                if($_SERVER['REQUEST_URI'] == "/shresk03/phpAssignment/public/admin/" || $_SERVER['REQUEST_URI'] == "/shresk03/phpAssignment/public/admin/index.php") {
                    include(TEMPLATE_BACK . "/admin_content.php" );
                }

                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . "/orders.php" );
                }

                if(isset($_GET['customers'])){
                    include(TEMPLATE_BACK . "/customers.php");
                }

                if(isset($_GET['products'])){
                    include(TEMPLATE_BACK . "/products.php" );
                }

                if(isset($_GET['edit_product'])){
                    include(TEMPLATE_BACK . "/edit_product.php" );
                }

                if(isset($_GET['add_product'])){
                    include(TEMPLATE_BACK . "/add_product.php" );
                }

                if(isset($_GET['categories'])){
                    include(TEMPLATE_BACK . "/categories.php" );
                }

                if(isset($_GET['suppliers'])){
                    include(TEMPLATE_BACK . "/suppliers.php" );
                }

                if(isset($_GET['reports'])){
                    include(TEMPLATE_BACK . "/reports.php" );
                }

                if(isset($_GET['slides'])){
                    include(TEMPLATE_BACK . "/slides.php" );
                }

                ?>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include(TEMPLATE_BACK . "/footer.php" ) ?>
