<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/PHPATMS/database/database.php";

// $dbo=new Database();

class student_Registration_Details
{
    public function getStudents($dbo,$sessionid,$subjectid)
    {
        $rv=[];
        $cmd="select sd.stud_id, sd.roll_no, sd.name from subject_registration_details as srd, student_details as sd where srd.student_id=sd.stud_id and srd.session_id=:sessionid and srd.subject_id=:subjectid";
        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute([":sessionid"=>$sessionid,":subjectid"=>$subjectid]);
            $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);

        } 
        catch (PDOException $e) {
            //throw $th;
        }
        return $rv;
    }
}
?>