<?php require_once("config.php");?>


<?php

    if(isset($_GET['add'])){

        $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
        confirm($query);

        while ($row = fetch_array($query)){

            if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){

                $_SESSION['product_' . $_GET['add']]+=1;
                redirect("../public/checkout.php");

            } else {

                set_message("We only have " . $row['product_quantity'] ." ". $row['product_title'] ." available!");
                redirect("../public/checkout.php");
            }

        }

        //$_SESSION['product_' . $_GET['add']] +=1 ;
        //redirect("../public/index.php");

    }

if(isset($_GET['remove'])){
    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1){
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }

}

if(isset($_GET['delete'])){

    $_SESSION['product_' . $_GET['delete']] = 0;
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("../public/checkout.php");

}

function clear_cart()
{
    foreach($_SESSION as $name => $value) {
        # Check if the key ($product) is actually a product,we don't want to unset login info or other data, just products.
        if (strpos($name, 'product_') !== false) {
            # Since it's a product, unset it.
            unset($_SESSION[$name]);
            unset($_SESSION[$value]);
            $_SESSION['item_total'] = 0;
            $_SESSION['item_quantity']= 0;
        }
    }
}


function cart()
{
    $total = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;

    foreach ($_SESSION as $name => $value){

        if($value > 0 ) {

            if(substr($name, 0, 8) == "product_"){

                $length = strlen($name);
                $id = substr($name, 8, $length);

                $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
                confirm($query);

                while ($row = fetch_array($query)) {
                    $image = display_image($row['product_image']);
                    $sub = $row['product_price'] * $value;
                    $qtn = $value;
                    $products = <<<DELIMETER
        
        <tr>
                <td><img class="img-responsive img_checkout" src="../resources/{$image}"> {$row['product_title']} </td> 
                <td>&#36;{$row['product_price']}</td>
                <td>{$value}</td>
                <td>&#36;{$sub}</td>
                <td>  <a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>  <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a> </td>
              
        </tr>
        <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
        <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
        <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
        <input type="hidden" name="quantity_{$quantity}" value="{$value}">

DELIMETER;

                    echo $products;

                    $item_name ++;
                    $item_number ++;
                    $amount ++;
                    $quantity ++;
                }

                $_SESSION['item_total'] = $total += $sub;
                $_SESSION['item_quantity']= $item_quantity += $qtn;

            }

        }

    }
    //echo '<a class="btn btn-primary" href="../resources/cart.php?clear">Clear Cart</a>';

}

function process_transaction()
{
    // Change the line below to your timezone!
    date_default_timezone_set('Pacific/Auckland'); // NST

    $current_date = date('Y-m-d');
    $current_time = date('H:i:s');

    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];
        $currency = $_GET['cc'];
        $total = 0;
        $item_quantity = 0;


        foreach ($_SESSION as $name => $value) {

            if ($value > 0) {

                if (substr($name, 0, 8) == "product_") {

                    $length = strlen($name - 8);
                    $id = substr($name, 8, $length);
                    // Completed in Paypal = Paid
                    if ($status == "Completed" || $status = "Waiting"){
                        $payment = "Paid";
                        $status = "Waiting";
                    } else
                    {
                        $payment = "Unpaid";
                    }

                    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
                    confirm($query);

                    while ($row = fetch_array($query)) {

                        $sub = $row['product_price'] * $value;
                        $item_quantity += $value;
                        $product_title = $row['product_title'];
                        $product_price = $row['product_price'];
                    }

                    $order_amount = $product_price * $value;

                    $customer_id = $_SESSION['customer_session'];

                    //Inserting Order Details into DB
                    $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_payment, order_status, order_currency, order_date, order_time) VALUES ('{$order_amount}','{$transaction}', '{$payment}' ,'{$status}', '{$currency}', '{$current_date}', '{$current_time}')");
                    // Getting Last order ID for report table
                    $last_id = last_id();
                    confirm($send_order);

                    //Inserting Order details into report table
                    $insert_report = query("INSERT INTO reports (product_id, order_id, customer_id, product_title, product_price, product_quantity) VALUES ('{$id}', '{$last_id}', '{$customer_id}', '{$product_title}' ,'{$product_price}','{$value}')");
                    confirm($insert_report);

                    $total += $sub;

                }

            }

        }
        clear_cart();
    } else {
        redirect("index.php");
    }
}


function show_paypal(){

    if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
        $paypal_button = <<<DELIMETER

    <input type="image" name="upload"
           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
           alt="PayPal - The safer, easier way to pay online">


DELIMETER;

        return $paypal_button;
    }

}


?>