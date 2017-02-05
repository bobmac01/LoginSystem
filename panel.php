<?php
//include_once 'dbconfig.php';
include_once(dirname("__FILE__") . "/db/dbconfig.php");

?>
<?php include_once 'Include/header.php'; ?>

    <div class="clearfix"></div>

    <div class="container">
    <br />
        <a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i>Add Records</a>
    </div>

    <div class="clearfix"></div><br />

    <div class="container panel">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th></th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM userdetails";
            $number_on_page=10;
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

