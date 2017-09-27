<?php require_once("../../config.php");

    if(isset($_GET['id'])) {
        $query = query("SELECT * FROM customers WHERE customer_id = " . escape_string($_GET['id']) . " ");
        confirm($query);
        $status;
        while ($row = fetch_array($query)) {
            $status = $row['customer_enabled'];
        }

        if ($status == "No") {
            $update_query = query("UPDATE customers SET customer_enabled='Yes' WHERE customer_id = " . escape_string($_GET['id']) . " ");
            confirm($update_query);
            set_message("Selected Customer Account has been Enabled!");

            redirect("../../../public/admin/index.php?customers");
        } elseif ($status == "Yes"){
            $update_query = query("UPDATE customers SET customer_enabled='No' WHERE customer_id = " . escape_string($_GET['id']) . " ");
            confirm($update_query);
            set_message("Selected Customer Account has been Disabled!");

            redirect("../../../public/admin/index.php?customers");
        }
    } else {

        redirect("../../../public/admin/index.php?customers");


    }

?>