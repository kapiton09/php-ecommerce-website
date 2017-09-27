<?php require_once("../resources/config.php")?>

<?php include(TEMPLATE_FRONT . DS . "header.php" ) ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Header -->
        <header>
            <h1>Shop! Get the best bargain!</h1>
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_products_in_shop_page(); ?>

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php" ) ?>
