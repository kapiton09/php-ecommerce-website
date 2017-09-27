<?php require_once("../../config.php");

    if(isset($_GET['id'])) {

        $query = query("DELETE FROM slides WHERE slide_id = " . escape_string($_GET['id']) . " ");
        confirm($query);
        set_message("Slide has been Deleted!");

        redirect("../../../public/admin/index.php?slides");
    } else {


        redirect("../../../public/admin/index.php?slides");

    }

?>