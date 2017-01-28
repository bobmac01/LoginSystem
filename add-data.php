<?php

include_once 'db/dbconfig.php';

if(isset($_POST['btn-save']))
{
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $error = $crud->create($fname,$lname,$email,$contact);

    if($crud->create($fname,$lname,$email,$contact))
    {
        header("Location: add-data.php?inserted");
    }
    else
    {
        header("Location: add-data.php?failure");
        //var_dump($error);
    }
}
?>
<?php include_once 'Include/header.php'; ?>
    <div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>Record inserted fine :-)</strong><a href="panel.php"> Back to home</a>
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>SORRY!</strong> ERROR while inserting record !
        </div>
    </div>
    <?php
}
?>

    <div class="clearfix"></div><br />

    <div class="container">


        <form method='post'>

            <table class='table table-bordered'>

                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='firstname' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='lastname' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Your E-mail ID</td>
                    <td><input type='text' name='email' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Contact No</td>
                    <td><input type='text' name='contact' class='form-control' required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-save">
                            <span class="glyphicon glyphicon-plus"></span> Create New Record
                        </button>
                        <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Back to index?</a>
                    </td>
                </tr>

            </table>
        </form>


    </div>

<?php include_once 'Include/footer.php'; ?>