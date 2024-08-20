<?php
    $path=$_SERVER['DOCUMENT_ROOT'];
    // require_once $path."/database/database.php";
    require_once $path."/PHPATMS/database/database.php";

    class faculty_details
    {
        public function verifyUser($dbo,$user,$pwd)
        {
            $rv=["fac_id"=>-1,"status"=>"ERROR1"];
            //  $rv=["fac_id","status"];
            
            $cmd="select fac_id,pswd from faculty_details where user_id=:user";
            $stmt=$dbo->conn->prepare($cmd);
            try {
                $stmt->execute([":user"=>$user]);
                if($stmt->rowCount()>0)
                {
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];
                    if($result['pswd']==$pwd)
                    {
                        //All OK
                        $rv=["fac_id"=>$result['fac_id'],"status"=>"ALL OK"];
                    }
                    else
                    {
                        //password does not match
                        $rv=["fac_id"=>$result['fac_id'],"status"=>"Wrong Password"];
                    }
                }
                else
                {
                    //user doesn't exist
                    $rv=["fac_id"=>-1,"status"=>"User_id doesn't exist"];
                }
            } catch (PDOException $e) {
                //throw $th;
            }
            // json_encode($rv);
            return $rv;
        }

        public function getAllotment($dbo,$facid,$sessid)
        {
            $rv=[];
            $cmd="select sd.sub_id, sd.code, sd.title from faculty_allotment_details as fad, subject_details as sd where fad.subject_id=sd.sub_id and fad.faculty_id=:facid and fad.session_id=:sessid";
            $stmt=$dbo->conn->prepare($cmd);
            try {
                $stmt->execute([":facid"=>$facid, ":sessid"=>$sessid]);
                $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                //throw $th;
            }

            return $rv;
        }

        public function checked($dbo,$session,$fac)
        {
            $rv=[];
            $cmd="select sd.sub_id from faculty_allotment_details as fad, subject_details as sd where fad.subject_id=sd.sub_id and fad.faculty_id=:fac and fad.session_id=:session";
            $stmt=$dbo->conn->prepare($cmd);
            try {
                $stmt->execute([":fac"=>$fac, ":session"=>$session]);
                $rv=$stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                //throw $th;
            }
            return $rv;
        }
    }

?>