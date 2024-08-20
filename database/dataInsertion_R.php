<?php

//DATA INSERTED INTO THE RELATIONSHIP TABLES 

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/PHPATMS/database/database.php";
$dbo = new Database();

function clearTable($dbo,$tabName)
{
    $cmd = "delete from :tabName";
    $stmt = $dbo->conn->prepare($cmd);
    try{
        $stmt->execute([":tabName"=>$tabName]);
    }catch(PDOException $oo){}
}

//IF any data already exists then:-
clearTable($dbo, "subject_registration_details");
//DATA INSERTION INTO SUBJECT_REGISTRATION_DETAILS
$cmd = "insert into subject_registration_details
(student_id, subject_id, session_id)
values
(:ST_id, :SB_id, :SS_id)";
$stmt = $dbo->conn->prepare($cmd);
//iterate over all the 10 students
//select maximum 3 subjects out of 10 at random for each student  
for($i=1; $i<=10; $i++)
{
    for($j=0 ;$j<3; $j++)
    {
        $SBid = rand(1,5);
        //insert these selected subjects into the subject_registration table
        
        //first do for session 1 or "even" session
        try {
            $stmt->execute([":ST_id"=>$i, ":SB_id"=>$SBid, ":SS_id"=>1]);
            echo"<br>Data inserted succesfully for subject_registration";
        } catch (PDOException $pe) {echo"<br>error->".$pe->getmessage();}
        
        $SBid = rand(6,10);
        //insert these selected subjects into the subject_registration table
        
        //then repeat for session 2 or "odd" session
        try {
            $stmt->execute([":ST_id"=>$i, ":SB_id"=>$SBid, ":SS_id"=>2]);
            echo"<br>Data inserted succesfully for subject_registration";
        } catch (PDOException $pe) {echo"<br>error->".$pe->getmessage();}
    }
}

//IF any data already exists then:-
clearTable($dbo, "faculty_allotment_details");
//DATA INSERTION INTO FACULTY_ALLOTMENT_DETAILS
$cmd = "insert into faculty_allotment_details
(faculty_id,session_id,subject_id)
values
(:F_id, :SS_id, :SB_id)";
$stmt = $dbo->conn->prepare($cmd);
//iterate over all the 10 facultys
//select max of 2 subjects out of 10 at random for each faculty
for($i=1;$i<=10;$i++)
{
    for($j=0;$j<2;$j++)
    {
        //for session 1
        $SBid = rand(1,5);
        try {
            $stmt->execute([":F_id"=>$i,":SS_id"=>1,":SB_id"=>$SBid]);
            echo"<br>Data inserted succesfully for faculty_allotment";
        } catch (PDOException $pe) {echo"<br>error->".$pe->getmessage();}
        
        //for session 2
        $SBid = rand(6,10);
        try {
            $stmt->execute([":F_id"=>$i,":SS_id"=>2,":SB_id"=>$SBid]);
            echo"<br>Data inserted succesfully for faculty_allotment";
        } catch (PDOException $pe) {echo"<br>error->".$pe->getmessage();}
    }
}
?>