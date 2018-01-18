<?php

    // Update this area with your database connection details.
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'userdetails';

    try
    {
        $DB_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }


    include_once 'db/Classes/class.user.php';
    include_once 'db/Classes/class.crud.php';
    $user = new USER($DB_con);
    $crud = new crud($DB_con);

?>
