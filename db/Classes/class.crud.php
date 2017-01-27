<?php


include "$_SERVER[DOCUMENT_ROOT]/LoginSystem/db/dbconfig.php";

class crud
{
    private $db;

    public function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function create($fname, $lname, $email, $contact)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO userdetails(firstname, lastame, email, contact) VALUES
(:fname, :lname, :email, :contact)");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":contact", $contact);
            $stmt->execute();
            return true;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM userdetails WHERE id = :id");
        $stmt->execute(array(":id" =>$id));
        $editedRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editedRow;
    }

    public function update($id, $fname, $lname, $email, $contact)
    {
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
        $stmt = $this->db->prepare("DELETE FROM userdetails WHERE id = :id");
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;
    }

    // Pagination functions

    public function viewAll($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['first_name']); ?></td>
                        <td><?php print($row['last_name']); ?></td>
                        <td><?php print($row['email_id']); ?></td>
                        <td><?php print($row['contact_no']); ?></td>
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