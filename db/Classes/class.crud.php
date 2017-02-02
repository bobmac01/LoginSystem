<?php

//include_once($_SERVER['DOCUMENT_ROOT'] . "/LoginSystem/dbconfig.php");

include_once("db_config.php");

class crud
{
    public $db;

    public function __construct($DB_con)
    {
    // Intialising the DB connection from db_config.php
        $this->db = $DB_con;
    }

    public function create($fname,$lname,$email,$contact)
    {
    /*
    *	Function used to create a new user in the database.
    *	Somehow it is inserting that one user twice. This is to be fixed
    */
        try
        {   
            $stmt = $this->db->prepare("INSERT INTO userdetails(firstname,lastname,email,contact) VALUES(:fname, :lname, :email, :contact)");
            $stmt->bindparam(":fname",$fname);
            $stmt->bindparam(":lname",$lname);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":contact",$contact);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    public function getUserInfo($id)
    {
    /*
    *	Function is used to display all information about a user
    *	Paremeters needed is one ID
    */
        $stmt = $this->db->prepare("SELECT * FROM userdetails WHERE id = :id");
        $stmt->execute(array(":id" =>$id));
        $editedRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $editedRow;
    }

    public function update($id, $fname, $lname, $email, $contact)
    {
    /*
    *	Used to update user details.
    */
        try
        {
            $stmt=$this->db->prepare("UPDATE userdetails SET firstname=:fname, lastname=:lname, email_id=:email, 
                contact_no=:contact WHERE id=:id ");

            $stmt->bindparam(":fname",$fname);
            $stmt->bindparam(":lname",$lname);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":contact",$contact);
            $stmt->bindparam(":id",$id);
            $stmt->execute();

            return true;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    public function delete($id)
    {
    // This deletes a user given a specified ID as parameter
        $stmt = $this->db->prepare("DELETE FROM userdetails WHERE id = :id");
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;
    }

    // Pagination functions

    public function viewAll($query)
    {
    // Shows all users in database for panel.php main page
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
	// Checking is rowCount of the above query is greater than 0.
	// If so display all
        if($stmt->rowCount() > 0)
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['firstname']); ?></td>
                        <td><?php print($row['lastname']); ?></td>
                        <td><?php print($row['email']); ?></td>
                        <td><?php print($row['contact']); ?></td>
                        <td align="center">
                            <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                        <td align="center">
                            <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>
                    </tr>
                <?php
            }
        }
        else
        {
        
            ?>
                <tr>
                    <td>Nothing is here... Check the DB entries</td>
                </tr>
            <?php
        }
    }

    public function paging($query, $number_on_page)
    {
        $startPOS = 0;
        if(isset($_GET["page_no"]))
        {
            $startPOS = ($_GET["page_no"]-1)*$number_on_page;
        }
        $query2 = $query." LIMIT $startPOS, $number_on_page";
        return $query2;
    }

    public function paginglink($query,$number_on_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $totalRecords = $stmt->rowCount();

        if($totalRecords > 0)
        {
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($totalRecords/$number_on_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
                if($i==$current_page)
                {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages)
            {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }
}