<?php

include_once(dirname("__FILE__") . "/db/dbconfig.php");

if(isset($_POST['btn-save']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    if($crud->create($user, $pass, $fname,$lname,$email,$contact))
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
            <strong>Record inserted fine :-)</strong>
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>SORRY!</strong> ERROR while inserting record!
        </div>
    </div>
    <?php
}
?>

    <div class="clearfix"></div><br />

    <div class="container medium">
        <form method='post'>
            <table class='table table-bordered'>

                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' class='form-control' required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type='text' name='password' class='form-control' required></td>
                </tr>

                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='firstname' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='lastname' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type='text' name='email' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Contact Number</td>
                    <td><input type='text' name='contact' class='form-control' maxlength="10"  required onkeypress="return isNumberKey(event)"></td>
                </tr>
                
                <tr>
                    <td>Location</td>
                    <td>
                    	<select class="form-control">
							<option value="Scotland" title="Scotland">Scotland</option>
							<option value="Wales" title="Wales">Wales</option>
							<option value="Northern Ireland" title="Northern Ireland">Northern Ireland</option>
							<option value="Republic of Ireland" title="Republic of Ireland">Republic of Ireland</option>
							<option value="England" title="England">England</option>
						</select>
					</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a href="index.php" class="btn btn-large btn-success left">Back to index?</a>

                        <button type="submit" class="btn btn-primary right" name="btn-save">
                        	Create New Record
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>