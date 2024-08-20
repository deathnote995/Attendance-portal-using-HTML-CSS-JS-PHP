<?php
$path = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : __DIR__;
require_once $path."/PHPATMS/database/database.php";
$dbo = new Database();

// dummy code
// $cmd = "create table tab3(id int auto_increment primary key, user_id varchar(30) not null)";
// $st = $dbo->conn->prepare($cmd);
// $st->execute();
// $c="drop table tab3";
// $s=$dbo->conn->prepare($c);
// $s->execute();

//actual code:-
//STUDENT TABLE
$cmd = "create table student_details
(
    stud_id int auto_increment primary key, 
    roll_no varchar(20) unique, 
    name varchar(30) 
)";
    //STUDuser_id varchar(20) unique, 
    //STUDpswd varchar(20) not null
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>student details created";
} 
catch (PDOException $o) {
    echo"<br>student details not created".$o->getmessage();
}

//FACULTY TABLE
$cmd = "create table faculty_details
(
    fac_id int auto_increment primary key,
    name varchar(30), 
    user_id varchar(40) unique, 
    pswd varchar(20) not null
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>faculty details created";
} 
catch (PDOException $o) {
    echo"<br>faculty details not created".$o->getmessage();
}

//SUBJECT TABLE
$cmd = "create table subject_details
(
    sub_id int auto_increment primary key, 
    code varchar(10) unique,
    title varchar(30), 
    credit int
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>subject details created";
} 
catch (PDOException $o) {
        echo"<br>subject details not created".$o->getmessage();
}

//SESSION TABLE
$cmd = "create table session_details
(
    sess_id int auto_increment primary key, 
    year int,
    term varchar(20),
    unique (year,term)
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>session details created";
} 
catch (PDOException $o) {
    echo"<br>session details not created".$o->getmessage();
}

//SUBJECT REGISTRATION TABLE
$cmd = "create table subject_registration_details
(
    student_id int, 
    subject_id int,
    session_id int, 
    primary key(student_id, subject_id, session_id)
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>subject_registration details created";
} 
catch (PDOException $o) {
    echo"<br>subject_registration details not created".$o->getmessage();
}

//FACULTY ALLOTMENT TABLE
$cmd = "create table faculty_allotment_details
(
    faculty_id int,
    session_id int,
    subject_id int, 
    primary key(faculty_id, session_id, subject_id)
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>faculty allotment details created";
} 
catch (PDOException $o) {
    echo"<br>faculty allotment details not created".$o->getmessage();
}

//ATTENDANCE TABLE
$cmd = "create table attendance_details
(
    faculty_id int,
    session_id int,
    subject_id int,
    student_id int,
    on_date date,
    status varchar(10),
    primary key(faculty_id, session_id, subject_id, student_id, on_date)
)";
$stmt = $dbo->conn->prepare($cmd);
try {
    $stmt->execute();
    echo"<br>attendance detail created";
} 
catch (PDOException $o) {
    echo"<br>attendance detail not created".$o->getmessage();
}
?>