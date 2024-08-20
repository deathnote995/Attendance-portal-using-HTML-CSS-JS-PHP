<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/PHPATMS/database/database.php";

class attendance_data
{
    public function marking($dbo,$studentid,$facultyid,$subjectid,$sessionid,$ondate,$studentStatus)
    {
        $rv=[-1];
        $cmd="insert into attendance_details
        (faculty_id,session_id,subject_id,student_id,on_date,status)
        values
        (:facultyid, :sessionid, :subjectid, :studentid, :ondate, :studentStatus)";
        // (faculty_id=:facultyid, session_id=:sessionid, subject_id=:subjectid, student_id=:studentid, on_date=:ondate, status=:studentStatus)";
        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute([":facultyid"=>$facultyid, ":sessionid"=>$sessionid, ":subjectid"=>$subjectid, ":studentid"=>$studentid, ":ondate"=>$ondate, ":studentStatus"=>$studentStatus]);
            $rv=[1];
        } 
        catch (PDOException $e) {
            // $rv=[$e->getMessage()];
            //it can be possible for a particular record to be already present in the table
            //for ex- a record with status:"yes" can be already there but if now you want to make it no it give primary key constraint violation errpr
            //so we just have to set/reset the status of that student record
            $cmd="update attendance_details set status=:studentStatus 
            where
            faculty_id=:facultyid and session_id=:sessionid and subject_id=:subjectid and student_id=:studentid and on_date=:ondate";
            $stmt=$dbo->conn->prepare($cmd);
            try {
                $stmt->execute([":facultyid"=>$facultyid, ":sessionid"=>$sessionid, ":subjectid"=>$subjectid, ":studentid"=>$studentid, ":ondate"=>$ondate, ":studentStatus"=>$studentStatus]);
                $rv=[1];
            } 
            catch (PDOException $e) {
                //throw $th;
            }
        }
        return $rv;
    }

    public function presentStudList($dbo,$sessionid,$subjectid,$facid,$ondate)
    {
        $rv=[];
        $cmd="select student_id from attendance_details 
        where 
        session_id=:sessionid and subject_id=:subjectid and faculty_id=:facid and on_date=:ondate
        and
        status='yes'";
        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute([":sessionid"=>$sessionid, ":subjectid"=>$subjectid, ":facid"=>$facid, ":ondate"=>$ondate]);
            $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            //throw $th;
        }
        return $rv;
    }

    public function fetchRecord($dbo,$facultyid,$subjectid,$sessionid)
    {
        $rv=[];
        $total=0;
        $start='';
        $end='';
        $percentage=0;
        // $roll='';
        //first get total no. of classes by the faculty
        $cmd="select distinct ad.on_date, ssd.term, sbd.title, sbd.code, fac.name from attendance_details as ad, session_details as ssd, subject_details as sbd, faculty_details as fac where ad.faculty_id=:facultyid and ad.subject_id=:subjectid and ad.session_id=:sessionid and ssd.sess_id=ad.session_id and sbd.sub_id=ad.subject_id and fac.fac_id=ad.faculty_id order by ad.on_date";

        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute([":facultyid"=>$facultyid,":subjectid"=>$subjectid,":sessionid"=>$sessionid]);
            $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $total=count($rv);
            if($total>0)
            {
                $start=$rv[0]['on_date'];
                $end=$rv[$total-1]['on_date'];
            }
        } catch (PDOException $e) {
        }
        $report=[];
        array_push($report,["Session",$rv[0]['term']]);
        array_push($report,["Subject",$rv[0]['title'],"Subject_Code",$rv[0]['code']]);
        array_push($report,["Faculty",$rv[0]['name']]);
        array_push($report,["Total Classes Delivered",$total]);
        array_push($report,["Session Start Date",$start]);
        array_push($report,["Session End Date",$end]);

        $rv=[];
        //get classes attended by a student
        $cmd="select rd.stud_id, rd.roll_no, rd.name, count(ad.on_date) as attended from 
        (
            select sd.stud_id, sd.roll_no, sd.name, srd.subject_id, srd.session_id from student_details as sd, subject_registration_details as srd where sd.stud_id=srd.student_id and srd.session_id=:sessionid and srd.subject_id=:subjectid
        )
        as rd left join attendance_details as ad on rd.stud_id=ad.student_id and rd.session_id=ad.session_id and rd.subject_id=ad.subject_id and ad.faculty_id=:facultyid and ad.status='yes' 
        group by rd.stud_id";

        $stmt=$dbo->conn->prepare($cmd);
        try {
            $stmt->execute([":facultyid"=>$facultyid,":subjectid"=>$subjectid,":sessionid"=>$sessionid]);
            $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //throw $th;
        }

        // $report=[];
        array_push($report,["----------------------------------------------------------------------------------"]);
        array_push($report,[" SI_No "," Roll_No "," Name "," Attended "," Attendance_Percentage "]);
        for($i=0; $i<count($rv); $i++)
        {
            // $percentage=$rv[$i]['count(attended)']/$total;
            // $roll=$rv[$i]['roll_no'];
            // array_push($report,[$i+1,$rv[$i]['roll_no'],$rv[$i]['name'],$total,$rv[$i]['count(ad.on_date)'],$percentage]);
            $rv[$i]['stud_id']=$i+1;
            $rv[$i]['Attendance_percentage']=0.00;
            if($total>0)
            {
                $rv[$i]['Attendance_percentage']=round($rv[$i]['attended']/$total*100.00,2);
            }
        }
        $report=array_merge($report,$rv);

        // return $rv;
        return $report;
    }
}
?>