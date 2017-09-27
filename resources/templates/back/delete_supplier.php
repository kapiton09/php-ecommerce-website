<?php require_once("../../config.php");

    if(isset($_GET['id'])) {

        $query = query("DELETE FROM suppliers WHERE sup_id = " . escape_string($_GET['id']) . " ");
        confirm($query);
        set_message("Supplier has been Deleted!");

        redirect("../../../public/admin/index.php?suppliers");
    } else {


        redirect("../../../public/admin/index.php?suppliers");

    }

?>