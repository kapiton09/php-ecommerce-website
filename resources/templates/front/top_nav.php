<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img class="logo" src="images/ImageLogo.png"></a>
        <a class="navbar-brand" href="index.php"> Quality Bags</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php">Shop</a>
            </li>
            <li>
                <a href="checkout.php">Cart</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>

        </ul>

        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <?php
            if(isset($_SESSION['customer_username'])) {
                $logged_in = <<<DELIMETER
<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {$_SESSION['customer_username']} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="customer_details.php"><i class="fa fa-fw fa-power-off"></i> View Details</a>
            </li>
            <li>
                <a href="customer_orders.php"><i class="fa fa-fw fa-power-off"></i> View Orders</a>
            </li>
            <li>
                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>

DELIMETER;

                echo $logged_in;

            } else {
                echo '<li><a href="login.php"><i class="glyphicon glyphicon-user"></i> Login / Register</a></li>';
            }
            ?>

        </ul>
    </div>
    <!-- /.navbar-collapse -->


</div>
<!-- /.container -->
