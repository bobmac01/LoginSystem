<?php

include_once(dirname("__FILE__") . "/db/dbconfig.php");

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $user = $_POST['username'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
     
    if($crud->update($id,$user,$fname,$lname,$email,$contact))
     {
      $msg = "<div class='alert alert-info'>
        <strong>User</strong> was updated <a href='panel.php'>Panel</a>!
        </div>";
     }
     else
     {
      $msg = "<div class='alert alert-warning'>
        <strong>Oops</strong> error updating that user.
        </div>";
     }
}

if(isset($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 extract($crud->getUserInfo($id)); 
}

?>
<?php include_once 'Include/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
 echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
  
     <form method='post'>
 
    <table class='table table-bordered'>

        <tr>
            <td>Username</td>
            <td><input type='text' name='username' class='form-control' value="<?php echo $username; ?>" required></td>
        </tr>

        <tr>
            <td>First Name</td>
            <td><input type='text' name='firstname' class='form-control' value="<?php echo $firstname; ?>" required></td>
        </tr>
 
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lastname' class='form-control' value="<?php echo $lastname; ?>" required></td>
        </tr>
 
        <tr>
            <td>Your E-mail ID</td>
            <td><input type='text' name='email' class='form-control' value="<?php echo $email; ?>" required></td>
        </tr>
 
        <tr>
            <td>Contact No</td>
            <td><input type='text' name='contact' class='form-control' value="<?php echo $contact; ?>" required maxlength="10" onkeypress="return isNumberKey(event)"></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
       <span class="glyphicon glyphicon-edit"></span> Save update
    </button>
                <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>