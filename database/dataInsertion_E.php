<?php

//DATA INSERTED INTO THE ENTITY TABLES

$path = $_SERVER['DOCUMENT_ROOT'];
// require_once $path."c:/xampp/htdocs/PHPATMS/database/database.php";
require_once $path."/PHPATMS/database/database.php";
$dbo = new Database();

//STUDENT DATA INSERTION
$cmd = "insert into student_details
(stud_id,roll_no,name)
values
(1,'1/21/FET/BCS/107','Ankit Gupta'),
(2,'1/21/FET/BCS/109','Rakshit Mittal'),
(3,'1/21/FET/BCS/110','Vinay Negi'),
(4,'1/21/FET/BCS/118','Ishaan Rana'),
(5,'1/21/FET/BCS/125','Ritesh Nair'),
(6,'1/21/FET/BCS/126','Daksh Sehgal'),
(7,'1/21/FET/BCS/138','Shivam Mathur'),
(8,'1/21/FET/BCS/318','Naman Aggarwal'),
(9,'1/21/FET/BCS/319','Manaswi Garg'),
(10,'1/21/FET/BCS/320','Rajat Chowdhury')";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>Data inserted successfully"; 
} catch (PDOException $o) {
    echo"<br>Data not inserted".$o->getmessage();
}

//FACULTY DATA INSERTION
$cmd = "insert into faculty_details
(fac_id,name,user_id,pswd)
values
(1,'Dr.Savita Sindhu','savita@mriu.set.edu.in','drsavsin123'),
(2,'Dr.Meeta Singh','meeta@mriu.set.edu.in','drmeesin123'),
(3,'Dr.Prashant Dixit','prashant@mriu.set.edu.in','drpradix123'),
(4,'Mrs.Anisha Mahato','anisha@mriu.set.edu.in','mrsanimah123'),
(5,'Mr.Sidheshwari Dutt Mishra','sdmishra@mriu.set.edu.in','mrsdm123'),
(6,'Mr.Kaushal Shakya','kaushal@mriu.set.edu.in','mrkausha123'),
(7,'Dr.Shobha Tyagi','shobha@mriu.set.edu.in','drshotya123'),
(8,'Dr.Pronika chawala','pronika@mriu.set.edu.in','drprocha123'),
(9,'Mr.Bhanu Diviwedi','bhanu@mriu.set.edu.in','mrbhadiv123'),
(10,'Dr.Brijesh Kumar','brijesh@mriu.set.edu.in','drbrikum123')";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>Data inserted successfully";
} catch (PDOException $o) {
    echo"<br>Data not inserted".$o->getmessage();
}

//SESSION DATA INSERTION
$cmd = "insert into session_details
(sess_id,year,term)
values
(1,2024,'EVEN SEM'),
(2,2024,'ODD TERM')";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>Data inserted succesfully";
} catch (PDOException $o) {
    echo"<br>Data not inserted".$o->getmessage();
}

//SUBJECT DATA INSERTION
$cmd = "insert into subject_details
(sub_id,code,title,credit)
values
(1,'BCS-DS-602','Machine Learning',4),
(2,'BCS-DS-632','Data Mining',4),
(3,'BCS-DS-653','Internet Of Things',3),
(4,'BCS-DS-624','Compiler Design',3),
(5,'HM-607','German',2),

(6,'BCS-DS-727','Data Science',3),
(7,'BCS-DS-724','Advanced Computer Networks',3),
(8,'BCS-DS-726','Distributed Operating System',3),
(9,'BCS-DS-723','Parallel & Distributed Algorithms',3),
(10,'BCS-DS-721','Simulation Modeling',3)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>Data inserted succesfully";
} catch (PDOException $o) {
    echo"<br>Data not inserted".$o->getmessage();
}

// $cmd = "insert into subject_registration_details
// (student_id, subject_id, session_id)
// values
// (:ST_id, :SB_id, :SS_id)";
// $stmt = $dbo->conn->prepare($cmd);
// //iterate over all the 10 students
// //for each student chose max 3 random courses, from 1 to 10
// for($i=1;$i<=10;$i++)
// {
//     for($j=0;$j<3;$j++)
//     {
//         $SBid = rand(1,6);
//         //insert the selected subject into the subject_registration_details table
//         //do this for "even" or session 1 first
//         try {
//             $stmt->execute([":ST_id"=>$i, ":SB_id"=>$SBid, ":SS_id"=>1]);
//         } catch (PDOException $pe) {
//             //throw $th;
//         }
//     }
// }
?>