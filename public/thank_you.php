<?php require_once("../resources/config.php")?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php
process_transaction();
?>

<!-- Page Content -->
    <div class="container">

        <h1 class="text-center text-success">Thank You for choosing Quality Bag!</h1>
        <h2>Your order has been processed and will be shipped shortly.</h2>



    </div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php" ) ?>