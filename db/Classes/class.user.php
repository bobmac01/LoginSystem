<?php
/**
 * Created by PhpStorm.
 * User: robertmcateer
 * Date: 26/01/2017
 * Time: 22:34
 */
class user
{

    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;

    }

    public function register($fname, $lname, $uname, $umail, $upass)
    {
        // Function for users to register
        // Only needs username, user email and user password
        try
        {
            // Hash the password
            // Choose a better way to hash and possible salt
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            // Basic query. Bind the parameters after
            $stmt = $this->db->prepare("INSERT INTO userdetails(user_name, user_email, user_pass)
VALUES (:uname, :umail, :upass)");

            // Bind the parameters to the values needed for the query
            $stmt->bindparam("uname",$uname);
            $stmt->bindparam("umail",$umail);
            $stmt->bindparam("upass", $new_password);
            $stmt->execute();

            return $stmt;

        } catch(PDOException $e)
        {
            echo $e->getMessage();

        }
    }

    public function login($uname, $umail, $upass)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM userdetails WHERE user_name =:uname OR user_email=:umail LIMIT 1");
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                if(password_verify($upass, $userRow['user_pass']))
                {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function loggedin()
    {
        // Checks the session for user_session
        // If user_session is not null returns true and
        // a user is logged in

        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        /*
         * To be user in scripts checking for user login
         * Example:
         * User tries to access register.php when they are logged in already.
         * redirect() will return them to a correct page
         */
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);

        return true;
    }
}
?>