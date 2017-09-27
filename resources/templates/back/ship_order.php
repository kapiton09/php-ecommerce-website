<?php require_once("../../config.php");

    if(isset($_GET['id'])) {
        $query = query("SELECT * FROM orders WHERE order_id = " . escape_string($_GET['id']) . " ");
        confirm($query);
        $status;
        while ($row = fetch_array($query)) {
            $status = $row['order_status'];
        }

        if ($status == "Waiting") {
            $update_query = query("UPDATE orders SET order_status='Shipped' WHERE order_id = " . escape_string($_GET['id']) . " ");
            confirm($update_query);
            set_message("Selected Order has been marked as Shipped!");

            redirect("../../../public/admin/index.php?orders");
        } elseif ($status == "Shipped"){
            $update_query = query("UPDATE orders SET order_status='Waiting' WHERE order_id = " . escape_string($_GET['id']) . " ");
            confirm($update_query);
            set_message("Selected Order has been marked as Waiting!");

            redirect("../../../public/admin/index.php?orders");
        }
    } else {

        redirect("../../../public/admin/index.php?orders");


    }

?>