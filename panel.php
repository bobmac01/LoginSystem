<?php
include_once 'db/dbconfig.php';
?>
<?php include_once 'Include/header.php'; ?>

    <div class="clearfix"></div>

    <div class="container">
        <a href="#" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i>Add Records</a>
    </div>

    <div class="clearfix"></div><br />

    <div class="container">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM userdetails";
            $number_on_page=3;
            $newquery = $crud->paging($query,$number_on_page);
            $crud->viewAll($newquery);
            ?>
            <tr>
                <td colspan="7" align="center">
                    <div class="pagination-wrap">
                        <?php $crud->paginglink($query,$number_on_page); ?>
                    </div>
                </td>
            </tr>

        </table>


    </div>

<?php include_once 'Include/footer.php'; ?>