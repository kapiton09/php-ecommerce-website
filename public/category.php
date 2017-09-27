<?php require_once("../resources/config.php")?>

<?php include(TEMPLATE_FRONT . DS . "header.php" ) ?>

    <!-- Page Content -->
    <div class="container">

        <div class="col-md-9">
        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Browse Bag according to the category!</p>
        </header>
        </div>

        <div class="col-md-3">
            <p class="lead">Categories</p>
            <div class="list-group">

                <?php

                get_categories();

                ?>


            </div>
        </div>
        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_products_in_cat_page(); ?>

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php" ) ?>
