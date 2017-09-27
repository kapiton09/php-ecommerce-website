<?php add_supplier();?>


<h1 class="page-header">
    Product Suppliers

</h1>

<div class="col-md-4">
    <h3 class="text-center bg-success"><?php display_message(); ?></h3>
    <form action="" method="post">

        <div class="form-group">
            <label for="supplier-title">Supplier Name</label>
            <input name="sup_title" type="text" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="supplier-email">Supplier Email</label>
            <input name="sup_email" type="email" class="form-control" required >
        </div>
        <div class="form-group">
            <label for="supplier-phone">Supplier Phone</label>
            <input name="sup_phone" type="number" class="form-control" >
        </div>
        <div class="form-group">
            <label for="supplier-mobile">Supplier Mobile</label>
            <input name="sup_mobile" type="number" class="form-control" >
        </div>

        <div class="form-group">

            <input type="submit" name="add_supplier" class="btn btn-primary" value="Add Supplier">
        </div>


    </form>


</div>


<div class="col-md-8">

    <table class="table">
        <thead>

        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Mobile</th>
        </tr>
        </thead>


        <tbody>
        <?php show_suppliers_in_admin();?>
        </tbody>

    </table>

</div>