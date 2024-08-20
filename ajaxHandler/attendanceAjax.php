<?php
$path = $_SERVER['DOCUMENT_ROOT'];
// require_once $path."c:/xampp/htdocs/PHPATMS/database/database.php";
require_once $path."/PHPATMS/database/database.php";
require_once $path."/PHPATMS/database/sessionDetails.php";
require_once $path."/PHPATMS/database/facultyDetails.php";
require_once $path."/PHPATMS/database/studentDetails.php";
require_once $path."/PHPATMS/database/attendanceDetails.php";

function createReport($list,$filename)
{
    $error=0;
    $path=$_SERVER['DOCUMENT_ROOT'];
    $finalFileName=$path.$filename;
    try {
        $fp=fopen($finalFileName,"w");
        foreach($list as $line)
        {
            fputcsv($fp,$line);
        }
    } catch (PDOException $e) {
        $error=-1;
    }

}

if(isset($_REQUEST["action"]))
{
    $action=$_REQUEST["action"];
    if(!empty($action))
    {
        $dbo=new Database();

        if($action=="getSession")
        {
            $sdo=new session_Details();
            $rv=$sdo->getSession($dbo);
            echo json_encode($rv);
        }

        if($action=="getAllotment")
        {
            $facid=$_POST["faculty_id"];
            $sessid=$_POST["session_id"];
            // $rv=["facid"=>$facid,"sessid"=>$sessid];
            $fdo = new faculty_details();
            $rv=$fdo->getAllotment($dbo,$facid,$sessid);
            echo json_encode($rv);
        }

        if($action=="getStudents")
        {
            $sessionid=$_POST["session_id"];
            $subjectid=$_POST["subject_id"];
            $facid=$_POST["faculty_id"];
            $ondate=$_POST["on_date"];
            // $rv=["sessionid"=>$sessionid, "subjectid"=>$subjectid];
            $srdo=new student_Registration_Details();
            $allStudents=$srdo->getStudents($dbo,$sessionid,$subjectid,$facid,$ondate);

            $ado=new attendance_data();
            $presentStudents=$ado->presentStudList($dbo,$sessionid,$subjectid,$facid,$ondate);

            //iterate over all the students and select the present ones
            for($i=0;$i<count($allStudents);$i++)
            {
                $allStudents[$i]['isPresent']='no'; //by default no
                for($j=0;$j<count($presentStudents);$j++)
                {
                    if($allStudents[$i]['stud_id']==$presentStudents[$j]['student_id'])
                    {
                        // $rv=[":student_id"=>$s];
                        $allStudents[$i]['isPresent']='yes';
                        break;
                    }
                }
            }

            echo json_encode($allStudents);
        }

        if($action=="marking")
        {
            $studentid=$_POST["student_id"];
            $facultyid=$_POST["faculty_id"];
            $subjectid=$_POST["subject_id"];
            $sessionid=$_POST["session_id"];
            $ondate=$_POST["on_date"];
            $studentStatus=$_POST["status"];
            
            $marko=new attendance_data();
            $rv=$marko->marking($dbo,$studentid,$facultyid,$subjectid,$sessionid,$ondate,$studentStatus);
            echo json_encode($rv);
        }
        
        if($action=="focus")
        {
            // $sub_id=$_POST["sub_id"];
            $fac=$_POST["faculty_id"];
            $session=$_POST["session_id"];
            $checko=new faculty_details();
            $rv=$checko->checked($dbo,$session,$fac);
            echo json_encode($rv);
        }

        if($action=="download")
        {
            $facultyid=$_POST["faculty_id"];
            $subjectid=$_POST["subject_id"];
            $sessionid=$_POST["session_id"];
            $ado=new attendance_data();

            //dummy csv file
            // $list=[
            //     [1,"1/21/fet/bcs/320",86.00],
            //     [1,"1/21/fet/bcs/20",42.00],
            //     [1,"1/21/fet/bcs/230",68.00]
            // ];

            //now actual csv file
            // $rv=$ado->fetchRecord($dbo,$facultyid,$subjectid,$sessionid);
            $list=$ado->fetchRecord($dbo,$facultyid,$subjectid,$sessionid);

            $filename="/PHPATMS/report.csv";
            $rv=["filename"=>$filename];
            createReport($list,$filename);
            echo json_encode($rv);

        }
    }
}
?>