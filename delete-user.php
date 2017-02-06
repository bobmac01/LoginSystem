<?php
include_once(dirname("__FILE__") . "/db/dbconfig.php");

if(isset($_POST['btn-del']))
{
 $id = $_GET['delete_id'];
 $crud->delete($id);
 header("Location: delete-user.php?deleted"); 
}

?>

<?php include_once 'Include/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<br />


 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>User has been deleted</strong> 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     You are about to <strong>delete</strong> this user. Are you sure?
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">

  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
         <th>ID</th>
         <th>Username</th>
         <th>Password</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Contact</th>
         <th>Location</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM userdetails WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
            <tr>
            <td><?php print($row['id']); ?></td>
            <td><?php print($row['username']); ?></td>
            <td><?php print($row['hashed']); ?></td>
            <td><?php print($row['firstname']); ?></td>
            <td><?php print($row['lastname']); ?></td>
            <td><?php print($row['email']); ?></td>
            <td><?php print($row['contact']); ?></td>
            <td><?php print($row['location']); ?></td>

             </tr>
             <?php
         }
         ?>
         </table>
         <?php
  }
  ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>

   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del">Delete</button>
    <a href="panel.php" class="btn btn-large btn-success">Cancel</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="panel.php" class="btn btn-large btn-success">Back to panel/a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>