<?php
    // $rv=["status"=>"ok","id"=>100];
    // echo json_encode($rv);

    // retrive what is sent

    $path=$_SERVER['DOCUMENT_ROOT'];
    // require_once $path."/database/database.php";
    // require_once $path."/database/facultyDetails.php";
    require_once $path."/PHPATMS/database/database.php";
    require_once $path."/PHPATMS/database/facultyDetails.php";

    $action=$_REQUEST["action"];
    if(!empty($action))
    {
        if($action=="verifyUser")
        {
            $user=$_POST["user_id"];
            $pwd=$_POST["pswd"];
            $rv=["user"=>$user, "pwd"=>$pwd];
            // echo json_encode($rv);
            //check whether user_id exists or not
            $dbo=new Database();
            $fdo=new faculty_details();
            $rv=$fdo->verifyUser($dbo,$user,$pwd);
            // header('Content-Type: application/json');

            if($rv['status']=="ALL OK")
            {
                session_start();
                $_SESSION["current_user"]=$rv['fac_id'];
            }

            echo json_encode($rv);

        }
    }
?>