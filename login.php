<?php

require_once 'dbconfig.php';

if($user->loggedin() != '')
{
    $user->redirect('homepage.php');
}

if(isset($_POST['btn-login'])) {
    $uname = $_POST['loginText'];
    $umail = $_POST['loginText'];
    $upass = $_POST['passwordText'];

    if ($user->login($uname, $umail, $upass)) {
        $user->redirect('homepage.php');
    } else {
        $error = 'Sorry. Wrong information!';
    }
}
?>
<?php include_once 'Include/header.php'; ?>

<div class="container small">
    <div class="form-container">
        <form method="post">
            <h2>Log into your account</h2><hr />
            <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="loginText" placeholder="Username or Email" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                    <i class="glyphicon glyphicon-log-in"></i>&nbsp;Sign in
                </button>
            </div>
            <br />
            <label style="float: right;">Don't have account yet? <br /> <a href="sign-up.php">Sign Up</a></label>
        </form>
    </div>
</div>
