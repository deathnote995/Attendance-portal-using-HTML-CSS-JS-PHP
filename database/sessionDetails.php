<?php
$path = $_SERVER['DOCUMENT_ROOT'];
// require_once $path."c:/xampp/htdocs/PHPATMS/database/database.php";
require_once $path."/PHPATMS/database/database.php";
$dbo = new Database();

class session_Details
{
    public function getSession($dbo)
    {
        $rv=[];
        $cmd="select * from session_details";
        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute();
            $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);  //returns an associative array

        } 
        catch (PDOException $e) {
            //throw $th;
        }

        return $rv;

    }
}
?>