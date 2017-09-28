<?php

$upload_directory = "uploads";
$logged_in_customer_id;

//helper functions

function last_id(){
    global $connection;

    return mysqli_insert_id($connection);
}

function set_message($msg){

    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message() {

    if(isset($_SESSION['message'])){

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }

}

function redirect($location) {

    header("Location: $location ");

}

function query($sql) {

    global $connection;

    return mysqli_query($connection, $sql);
}


function confirm($result) {

    global $connection;

    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function escape_string($string){
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){

    return mysqli_fetch_array($result);
}

/************** FRONT END FUNCTIONS ************/

//get products

function get_products(){

    $query = query(" SELECT * FROM products");
    confirm($query);

    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database

    if(isset($_GET['page'])){ //get page from URL if its there

        $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers

    } else{// If the page url variable is not present force it to be number 1

        $page = 1;

    }

    $perPage = 6; // Items per page here

    $lastPage = ceil($rows / $perPage); // Get the value of the last page

// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

    if($page < 1){ // If it is less than 1

        $page = 1; // force if to be 1

    }elseif($page > $lastPage){ // if it is greater than $lastpage

        $page = $lastPage; // force it to be $lastpage's value

    }

    $middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons

    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;
    if($page == 1){

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

    } elseif ($page == $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

    }elseif ($page > 2 && $page < ($lastPage -1)) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';


    } elseif($page > 1 && $page < $lastPage){

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

    }

    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


    $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

// $query2 is what we will use to to display products with out $limit variable

    $query2 = query(" SELECT * FROM products $limit ");
    confirm($query2);


    $outputPagination = ""; // Initialize the pagination output variable


// if($lastPage != 1){

//    echo "Page $page of $lastPage";


// }

    // If we are not on page one we place the back link

    if($page != 1){

        $prev  = $page - 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
    }

    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;


// If we are not on the very last page we the place the next link

    if($page != $lastPage){


        $next = $page + 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

    }


// Done with pagination


    while ($row = fetch_array($query2)){

      $image = display_image($row['product_image']);

    $products = <<<DELIMETER
    
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"> <img  id="thumb_img" class="img-responsive img_thumb" src="../resources/{$image}" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['short_desc']}</p>
                                <a class="btn btn-primary" href="../resources/cart.php?add={$row['product_id']}">Add to Cart</a>
                            </div>
                        </div>
                    </div>


DELIMETER;

echo $products;

  }

    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";


}

function get_products_in_cat_page(){

    $query =  query("SELECT * FROM products WHERE product_category_id = " .escape_string($_GET['id']) . " AND product_quantity >= 1 ");
    confirm($query);

    while ($row = fetch_array($query)){

        $image = display_image($row['product_image']);

        $products = <<<DELIMETER
        
        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img id="thumb_img" class="img-responsive img_thumb" src="../resources/{$image}" alt=""></a>
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>&#36;{$row['product_price']}</p>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
    

DELIMETER;

        echo $products;

    }


}

function get_products_in_shop_page(){

    $query = query(" SELECT * FROM products");
    confirm($query);

    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database

    if(isset($_GET['page'])){ //get page from URL if its there

        $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers

    } else{// If the page url variable is not present force it to be number 1

        $page = 1;

    }

    $perPage = 8; // Items per page here

    $lastPage = ceil($rows / $perPage); // Get the value of the last page

// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

    if($page < 1){ // If it is less than 1

        $page = 1; // force if to be 1

    }elseif($page > $lastPage){ // if it is greater than $lastpage

        $page = $lastPage; // force it to be $lastpage's value

    }

    $middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons

    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if($page == 1){

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

    } elseif ($page == $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

    }elseif ($page > 2 && $page < ($lastPage -1)) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

    } elseif($page > 1 && $page < $lastPage){

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

    }

// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query

    $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

// $query2 is what we will use to to display products with out $limit variable

    $query2 = query(" SELECT * FROM products $limit");
    confirm($query2);

    $outputPagination = ""; // Initialize the pagination output variable

    // If we are not on page one we place the back link

    if($page != 1){

        $prev  = $page - 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
    }

    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;

// If we are not on the very last page we the place the next link

    if($page != $lastPage){

        $next = $page + 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

    }

// Pagination Ends

    while($row = fetch_array($query2)) {

        $image = display_image($row['product_image']);

        $products = <<<DELIMETER
        
        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img id="thumb_img" class="img-responsive img_thumb" src="../resources/{$image}" alt=""></a>
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>&#36;{$row['product_price']}</p>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
    

DELIMETER;

        echo $products;

    }

    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";

}

function get_categories(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = fetch_array($query)){

        $categories_links = <<<DELIMETER
    
        <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

        echo $categories_links;
    }

}

function login_admin() {

    if(isset($_POST['submit'])){

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0) {

            set_message("Your Password or Username are wrong!");
            redirect("login_admin.php");
        }
        else{
            $_SESSION['username'] = $username;
            //set_message("Welcome to Admin Panel," . $username);
            redirect("admin");
        }

    }

}

function send_message() {

    if(isset($_POST['submit'])) {

        $errors = '';
        $myemail = 'your_email';//<-----Put Your email address here.
        if(empty($_POST['name'])  ||
            empty($_POST['email']) ||
            empty($_POST['subject']) ||
            empty($_POST['message']))
        {
            $errors .= "\n Error: all fields are required. Please go back and fill the form again.";
        }

        $name = $_POST['name'];
        $email_address = $_POST['email'];
        $message = $_POST['message'];
        $subject = $_POST['subject'];

        if (!preg_match(
            "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
            $email_address))
        {
            $errors .= "\n Error: Invalid email address";
        }

        if( empty($errors))
        {
            $to = $myemail;
            $email_subject = $subject;
            $email_body = "You have received a new message. ".
                " Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message";

            $headers = "From: $myemail\n";
            $headers .= "Reply-To: $email_address";

            mail($to,$email_subject,$email_body,$headers);
            //redirect to the 'thank you' page
            redirect("contact.php");
            set_message("You message has been sent successfully!");
        }


    }
}

function send_email() {

    if(isset($_POST['add_customer'])) {

        $errors = '';
        if(empty($_POST['customer_username'])  ||
            empty($_POST['customer_password']) ||
            empty($_POST['customer_email']) ||
            empty($_POST['customer_first_name']) ||
            empty($_POST['customer_last_name']) ||
            empty($_POST['customer_address']))
        {
            $errors .= "\n Error: all fields are required. Please go back and fill the form again.";
        }

        $customer_username = $_POST['customer_username'];
        $customer_password = $_POST['customer_password'];
        $customer_email = $_POST['customer_email'];
        $customer_first_name = $_POST['customer_first_name'];
        $customer_last_name = $_POST['customer_last_name'];
        $customer_address = $_POST['customer_address'];

        if (!preg_match(
            "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
            $customer_email))
        {
            $errors .= "\n Error: Invalid email address";
        }

        $username_query = query("SELECT * FROM customers WHERE customer_username = '$customer_username'");
        confirm($username_query);
        $user_count = mysqli_num_rows($username_query);

        $email_query = query("SELECT * FROM customers WHERE customer_email = '$customer_email'");
        confirm($email_query);
        $email_count = mysqli_num_rows($email_query);

        if ($user_count > 0) {
            $errors .=  "Username already exists. Please use another username!";
        }
        if ($email_count > 0) {
            $errors .=  "Email has already been registered. Please use another email!";
        }

        $email_address = "shresk03@myunitec.ac.nz";

        if( empty($errors))
        {
            $to = $customer_email;
            $email_subject = "Account Information";
            $email_body = "Below is your account information. ".
                " \n Username: $customer_username 
                \n Password: $customer_password 
                \n Email: $customer_email 
                \n First Name : $customer_first_name 
                \n Last Name: $customer_last_name 
                \n Address: $customer_address";

            $headers = "From: $email_address\n";
            $headers .= "Reply-To: $customer_email";

            mail($to,$email_subject,$email_body,$headers);
            //redirect to the 'thank you' page
            redirect("register_customer.php");
            set_message("You account information has been sent to your email!");
        } else {
            redirect("register_customer.php");
            set_message("Username/Email has already been registered.");
        }


    }
}


/************** BACK END FUNCTIONS ************/

function display_orders(){

    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {

        $orders = <<<DELIMETER

        <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_currency']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_payment']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_status']}</td>
            <td>{$row['order_date']}</td>
            <td>{$row['order_time']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}" data-toggle="tooltip" data-placement="top" title="Delete Order"><span class="glyphicon glyphicon-remove"></span></a>
            <a class="btn btn-success" href="../../resources/templates/back/ship_order.php?id={$row['order_id']}" data-toggle="tooltip" data-placement="top" title="Change Shipping Status"><span class="glyphicon glyphicon-send"></span></a> </td>
        </tr>


DELIMETER;

        echo $orders;

    }

}

/************** ADMIN GET PRODUCTS  ************/

function display_image($picture){

    global $upload_directory;

    return $upload_directory . DS . $picture;
}


function get_products_in_admin(){

    $query =  query("SELECT * FROM products");
    confirm($query);

    while ($row = fetch_array($query)){

        $category = show_product_category_title($row['product_category_id']);
        $supplier = show_product_supplier_title($row['product_supplier_id']);
        $image = display_image($row['product_image']);

        $products = <<<DELIMETER
    
        <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']} </td>
            <td> <img class="img-responsive" width="80" src="../../resources/{$image}" alt=""></td>
            <td>$category</td>
            <td>$supplier</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-success" href="index.php?edit_product&id={$row['product_id']}" data-toggle="tooltip" data-placement="top" title="Edit Product"><span class="glyphicon glyphicon-pencil"></span></a> 
            <a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}" data-toggle="tooltip" data-placement="top" title="Delete Product"><span class="glyphicon glyphicon-remove"></span></a> </td>
        </tr>


DELIMETER;

        echo $products;

    }

}

function show_product_category_title($product_category_id) {

$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
confirm($category_query);

while ($category_row = fetch_array($category_query)){
    return $category_row['cat_title'];
}

}

function show_product_supplier_title($product_supplier_id) {

    $supplier_query = query("SELECT * FROM suppliers WHERE sup_id = '{$product_supplier_id}' ");
    confirm($supplier_query);

    while ($supplier_row = fetch_array($supplier_query)){
        return $supplier_row['sup_title'];
    }

}


/************** ADMIN ADD PRODUCTS  ************/
function add_product() {

    if(isset($_POST['publish'])){

        $product_title = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_supplier_id = escape_string($_POST['product_supplier_id']);
        $product_price = escape_string($_POST['product_price']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $short_desc = escape_string($_POST['short_desc']);
        $product_description = escape_string($_POST['product_description']);
        $product_image = escape_string($_FILES['file']['name']);
        $image_temp_location = $_FILES['file']['tmp_name'];

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query = query("INSERT INTO products(product_title, product_category_id, product_supplier_id, product_price, product_quantity, short_desc, product_description, product_image) VALUES ('{$product_title}', '{$product_category_id}', '{$product_supplier_id}', '{$product_price}', '{$product_quantity}', '{$short_desc}', '{$product_description}', '{$product_image}' )");
        $last_id= last_id();
        confirm($query);
        set_message("New Product has been added with id {$last_id}!");
        redirect("index.php?products");
    }

}

/************** ADMIN UPDATE PRODUCTS  ************/
function update_product() {

    if(isset($_POST['update'])){

        $product_title = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_supplier_id = escape_string($_POST['product_supplier_id']);
        $product_price = escape_string($_POST['product_price']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $short_desc = escape_string($_POST['short_desc']);
        $product_description = escape_string($_POST['product_description']);
        $product_image = escape_string($_FILES['file']['name']);
        $image_temp_location = $_FILES['file']['tmp_name'];

        if (empty($product_image)){
            $get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)){
                $product_image = $pic['product_image'];
            }
        }

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query = "UPDATE products SET ";
        $query .= "product_title = '{$product_title }', ";
        $query .= "product_category_id = '{$product_category_id }', ";
        $query .= "product_supplier_id = '{$product_supplier_id }', ";
        $query .= "product_price = '{$product_price }', ";
        $query .= "product_quantity = '{$product_quantity }', ";
        $query .= "short_desc = '{$short_desc }', ";
        $query .= "product_description = '{$product_description }', ";
        $query .= "product_image = '{$product_image }' ";
        $query .= "WHERE product_id=" .escape_string($_GET['id']);

        $send_update_query = query($query);

        confirm($send_update_query);
        set_message("Product has been updated!");
        redirect("index.php?products");
    }

}



function show_categories_add_product_page(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = fetch_array($query)){

        $categories_options = <<<DELIMETER
    
            <option value="{$row['cat_id']}">{$row['cat_title']}</option>

DELIMETER;

        echo $categories_options;
    }

}

function show_suppliers_add_product_page(){

    $query = query("SELECT * FROM suppliers");
    confirm($query);

    while ($row = fetch_array($query)){

        $suppliers_options = <<<DELIMETER
    
            <option value="{$row['sup_id']}">{$row['sup_title']}</option>

DELIMETER;

        echo $suppliers_options;
    }

}

/************** CATEGORIES IN ADMIN  ************/
function show_categories_in_admin(){

    $query = "SELECT * FROM categories";
    $category_query = query($query);
    confirm($category_query);

    while ($row = fetch_array($category_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        $category = <<<DELIMETER

        <tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}" data-toggle="tooltip" data-placement="top" title="Delete Category"><span class="glyphicon glyphicon-remove"></span></a> </td>
</td>
        </tr>

DELIMETER;

        echo $category;

    }

}

function add_category() {

    if(isset($_POST['add_category'])) {

        $cat_title = escape_string($_POST['cat_title']);

        if(empty($_POST['cat_title']) || $cat_title == " "){
            set_message( "Please type Category Name!");
        } else {

            $insert_cat = query("INSERT INTO categories(cat_title) VALUES ('{$cat_title}') ");
            confirm($insert_cat);
            set_message("New Category has been added!");
        }
    }

}

/************** SUPPLIERS IN ADMIN  ************/
function show_suppliers_in_admin(){

    $query = "SELECT * FROM suppliers";
    $supplier_query = query($query);
    confirm($supplier_query);

    while ($row = fetch_array($supplier_query)){
        $sup_id = $row['sup_id'];
        $sup_title = $row['sup_title'];
        $sup_email = $row['sup_email'];
        $sup_phone = $row['sup_phone'];
        $sup_mobile = $row['sup_mobile'];

        $supplier = <<<DELIMETER

        <tr>
            <td>{$sup_id}</td>
            <td>{$sup_title}</td>
            <td>{$sup_email}</td>
            <td>{$sup_phone}</td>
            <td>{$sup_mobile}</td>
            
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_supplier.php?id={$row['sup_id']}" data-toggle="tooltip" data-placement="top" title="Delete Supplier"><span class="glyphicon glyphicon-remove"></span></a> </td>
</td>
        </tr>

DELIMETER;

        echo $supplier;

    }

}


function add_supplier() {

    if(isset($_POST['add_supplier'])) {

        $sup_title = escape_string($_POST['sup_title']);
        $sup_email = escape_string($_POST['sup_email']);
        $sup_phone = escape_string($_POST['sup_phone']);
        $sup_mobile = escape_string($_POST['sup_mobile']);


        if(empty($_POST['sup_title']) || $sup_title == " "){
            set_message( "Please type Supplier Name!");
        }
        elseif (empty($sup_phone) && empty($sup_mobile)){
            set_message( "Please enter at least one contact number!!");
        }
        else {

            $insert_sup = query("INSERT INTO suppliers(sup_title, sup_email, sup_phone, sup_mobile) VALUES ('{$sup_title}','{$sup_email}','{$sup_phone}','{$sup_mobile}') ");
            confirm($insert_sup);
            set_message("New Supplier has been added!");
        }
    }

}

/************** CUSTOMERS IN ADMIN  ************/
function show_customers_in_admin(){

    $query = "SELECT * FROM customers";
    $customer_query = query($query);
    confirm($customer_query);

    while ($row = fetch_array($customer_query)){
        $customer_id = $row['customer_id'];
        $customer_username = $row['customer_username'];
        $customer_email = $row['customer_email'];
        $customer_first_name = $row['customer_first_name'];
        $customer_last_name = $row['customer_last_name'];
        $customer_home_phone = $row['customer_home_phone'];
        $customer_work_phone = $row['customer_work_phone'];
        $customer_mobile_phone = $row['customer_mobile_phone'];
        $customer_enabled = $row['customer_enabled'];

        $customer = <<<DELIMETER

        <tr>
            <td>{$customer_id}</td>
            <td>{$customer_username}</td>
            <td>{$customer_email}</td>
            <td>{$customer_first_name}</td>
            <td>{$customer_last_name}</td>
            <td>{$customer_home_phone}</td>
             <td>{$customer_work_phone}</td>
             <td>{$customer_mobile_phone}</td>
            <td>{$customer_enabled}</td>
            
            <td><a class="btn btn-danger" href="../../resources/templates/back/block_customer.php?id={$row['customer_id']}" data-toggle="tooltip" data-placement="top" title="Enable/ Disable Customer"><span class="glyphicon glyphicon-eye-close"></span></a> </td>
</td>
        </tr>

DELIMETER;

        echo $customer;

    }

}

function add_customer() {

    if(isset($_POST['add_customer'])) {

        $customer_username = escape_string($_POST['customer_username']);
        $customer_password = escape_string($_POST['customer_password']);
        $customer_email = escape_string($_POST['customer_email']);
        $customer_first_name = escape_string($_POST['customer_first_name']);
        $customer_last_name = escape_string($_POST['customer_last_name']);
        $customer_home_phone = escape_string($_POST['customer_home_phone']);
        $customer_work_phone = escape_string($_POST['customer_work_phone']);
        $customer_mobile_phone = escape_string($_POST['customer_mobile_phone']);
        $customer_address = escape_string($_POST['customer_address']);
        $customer_enabled = "Yes";

        $username_query = query("SELECT * FROM customers WHERE customer_username = '$customer_username'");
        confirm($username_query);
        $user_count = mysqli_num_rows($username_query);

        $email_query = query("SELECT * FROM customers WHERE customer_email = '$customer_email'");
        confirm($email_query);
        $email_count = mysqli_num_rows($email_query);

        if(empty($customer_username)){
            set_message( "Please enter Username!");
        }
        elseif (empty($customer_home_phone) && empty($customer_work_phone) && empty($customer_mobile_phone)){
            set_message( "Please enter at least one contact number!");
        }
        elseif ($user_count > 0) {
            set_message( "Username already exists. Please use another username!");
        }
        elseif ($email_count > 0) {
            set_message( "Email has already been registered. Please use another email!");
        }
        else {

            $insert_customer = query("INSERT INTO customers(customer_username, customer_password, customer_email, customer_first_name, customer_last_name, customer_home_phone, customer_work_phone, customer_mobile_phone, customer_address, customer_enabled) VALUES ('{$customer_username}','{$customer_password}','{$customer_email}','{$customer_first_name}','{$customer_last_name}','{$customer_home_phone}','{$customer_work_phone}','{$customer_mobile_phone}','{$customer_address}','{$customer_enabled}') ");
            confirm($insert_customer);
             set_message("Your account has been registered and email regarding your account details has been sent to your registered email!");
        }


    }
}


function login_customer() {

    if(isset($_POST['submit'])){
        $customer_username = escape_string($_POST['customer_username']);
        $customer_password = escape_string($_POST['customer_password']);
        $customer_id = 1;
        $customer_status = "Enabled";

        $query = query("SELECT * FROM customers WHERE customer_username = '{$customer_username}' AND customer_password = '{$customer_password}'");
        confirm($query);

        while ($cust_id = fetch_array($query)){
            $customer_id = $cust_id['customer_id'];
            $customer_status = $cust_id['customer_enabled'];
        }

      if(mysqli_num_rows($query) == 0) {
        $message = <<<DELIMETER

            <h3 class="bg-danger glyphicon glyphicon-alert">Your Password or Username are incorrect!</h3>
DELIMETER;
        echo $message;
    }
        elseif ($customer_status == "No"){
            $message = <<<DELIMETER

            <h3 class="glyphicon glyphicon-alert">Your Account has been disabled! Please contact Administrator.</h3>
DELIMETER;
            echo $message;
        }
        else{

            //Write action to txt log file
            $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
                "Attempt: ".(mysqli_num_rows($query) != 0?'Success':'Failed').PHP_EOL.
                "User: ".$customer_username.PHP_EOL.
                "Pass: ".$customer_password.PHP_EOL.
                "-------------------------".PHP_EOL;
            //-
            file_put_contents('log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);


            $_SESSION['customer_username'] = $customer_username;
            $_SESSION['customer_session'] = $customer_id;
            //set_message("Welcome to Admin Panel," . $username);
            redirect("index.php?&id={$customer_id}");
        }

    }

}


/************** ADMIN REPORTS  ************/

function get_reports(){

    $query =  query("SELECT * FROM reports");
    confirm($query);

    while ($row = fetch_array($query)){

        $reports = <<<DELIMETER
    
        <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['customer_id']}</td>
            <td>{$row['product_title']} <br>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
        </tr>


DELIMETER;

        echo $reports;

    }

}

/************** CUSTOMER DETAILS  ************/
function get_customer_details() {

    if(isset($_SESSION['customer_session'])) {

        $c_id = $_SESSION['customer_session'];
        $query = query("SELECT * FROM customers WHERE customer_id = '{$c_id}'");
        confirm($query);

        while($row = fetch_array($query)){

            $details = <<<DELEMETER
        
                                <div class="row">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span><span> Username: </span>
                            <label> {$row['customer_username']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span><span> Full name: </span>
                            <label>{$row['customer_first_name']} {$row['customer_last_name']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><span> Email: </span>
                            <label>{$row['customer_email']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><span> Home Phone: </span>
                            <label>{$row['customer_home_phone']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><span> Work Phone: </span>
                            <label>{$row['customer_work_phone']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><span> Mobile: </span>
                            <label>{$row['customer_mobile_phone']}</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span><span> Address: </span>
                            <label>{$row['customer_address']}</label>
                        </div>


DELEMETER;

            echo $details;
        }

    }
}


function get_customer_order_details() {

    if(isset($_SESSION['customer_session'])) {

        $c_id = $_SESSION['customer_session'];
        $query = query("SELECT * FROM reports WHERE customer_id = '{$c_id}'");
        confirm($query);

        while($row = fetch_array($query)){
            //Retrieving product image related to the order
            $p_id = $row['product_id'];
            $img_query = query("SELECT product_image FROM products WHERE product_id = '{$p_id}'");
            confirm($img_query);
            $p_img = fetch_array($img_query)['product_image'];

            //Retrieving order status related to the order
            $o_id = $row['order_id'];
            $order_status_query = query("SELECT order_status FROM orders WHERE order_id = '{$o_id}'");
            confirm($order_status_query);
            $o_status = fetch_array($order_status_query)['order_status'];


            $details = <<<DELEMETER
        
        <tr>
            <td>{$row['order_id']}</td>
            <td><img class="img-responsive" width="80" src="../resources/uploads/{$p_img}" alt=""></td>
            <td>{$row['product_title']} <br>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td>{$o_status}</td>
        </tr>


DELEMETER;

            echo $details;
        }

    }
}


/************** ADMIN DASHBOARD  ************/
function count_orders() {
    $query = query("SELECT * FROM orders");
    confirm($query);
    echo mysqli_num_rows($query);
}

function count_products() {
    $query = query("SELECT * FROM products");
    confirm($query);
    echo mysqli_num_rows($query);
}

function count_categories() {
    $query = query("SELECT * FROM categories");
    confirm($query);
    echo mysqli_num_rows($query);
}

function count_suppliers() {
    $query = query("SELECT * FROM suppliers");
    confirm($query);
    echo mysqli_num_rows($query);
}

function count_customers() {
    $query = query("SELECT * FROM customers");
    confirm($query);
    echo mysqli_num_rows($query);
}

function count_slides () {
    $query = query("SELECT * FROM slides");
    confirm($query);
    echo mysqli_num_rows($query);
}



/************** SLIDES FUNCTIONS  ************/

function add_slides(){

    if(isset($_POST['add_slide'])){

        $slide_title = escape_string($_POST['slide_title']);
        $slide_image = escape_string($_FILES['file']['name']);
        $image_temp_location = $_FILES['file']['tmp_name'];


        if(empty($slide_title) || empty($slide_image)){

            echo "<p class='bg-danger'>This field cannot be empty!</p>";
        }
        else {

            move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $slide_image);

            $query = query ("INSERT INTO slides (slide_title, slide_image) VALUES ('{$slide_title}', '{$slide_image}')");
            confirm($query);
            set_message("Slide Added!");
            redirect("index.php?slides");
        }

    }

}

function get_current_slide_in_admin() {

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while ($row = fetch_array($query)){
        $slide_title = $row['slide_title'];
        $slide_image = display_image($row['slide_image']);


        $slide_active = <<<DELIMETER
        
            <img class="img-responsive" src="../../resources/{$slide_image}" alt="$slide_title">

DELIMETER;

        echo $slide_active;
    }

}

function get_active_slide() {

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while ($row = fetch_array($query)){
        $slide_title = $row['slide_title'];
        $slide_image = display_image($row['slide_image']);


        $slide_active = <<<DELIMETER
        
        <div class="item active">
            <img class="slide-image" src="../resources/{$slide_image}" alt="$slide_title">
        </div>

DELIMETER;

        echo $slide_active;
    }

}

function get_slides(){
    $count_query = query("SELECT * FROM slides");
    confirm($count_query);
    $slide_count = mysqli_num_rows($count_query) - 1;

    $query = query("SELECT * FROM slides ORDER BY slide_id ASC LIMIT $slide_count");
    confirm($query);

    while ($row = fetch_array($query)){
        $slide_title = $row['slide_title'];
        $slide_image = display_image($row['slide_image']);


        $slides = <<<DELIMETER
        
        <div class="item">
            <img class="slide-image" src="../resources/{$slide_image}" alt="$slide_title">
        </div>

DELIMETER;

echo $slides;
    }

}

function get_slides_indicator(){
    $count_query = query("SELECT * FROM slides");
    confirm($count_query);
    $slide_count = mysqli_num_rows($count_query) - 1;

    $query = query("SELECT * FROM slides ORDER BY slide_id ASC LIMIT $slide_count");
    confirm($query);
    $c = 1;
    while ($row = fetch_array($query)){

        $slides = <<<DELIMETER
        
        <li data-target="#carousel-example-generic" data-slide-to="{$c}"></li>

DELIMETER;

        echo $slides;

        $c ++;
    }

}

function get_slide_thumbnails(){

    $query = query("SELECT * FROM slides ORDER BY slide_id ASC");
    confirm($query);
    while ($row = fetch_array($query)){
        $slide_title = $row['slide_title'];
        $slide_image = display_image($row['slide_image']);


        $slide_thumb = <<<DELIMETER
        
<div class="col-xs-6 col-md-3">

    <a href="../../resources/templates/back/delete_slide.php?id={$row['slide_id']}" data-toggle="tooltip" data-placement="top" title="Click to Delete Slide">
        <img class="img-responsive slide_image" src="../../resources/{$slide_image}" alt="{$slide_title}">
    </a>

</div>

DELIMETER;

        echo $slide_thumb;
    }

}


?>
