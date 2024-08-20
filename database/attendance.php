<?php
session_start();
if(isset($_SESSION["current_user"]))
{
    $facid=$_SESSION["current_user"]; 
    // $date=new Date();  
}
else
{
    header("location:"."/PHPATMS/database/login.php");
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/PHPATMS/css/attendance.css">
</head>
<body>
    <!-- <h1>Welcome to attendance application</h1> -->
    <div class="page">
        <div class="header-area">
            <div class="logo-area"><h1 class="logo">MY ATTENDANCE APP</h1></div>
            <div class="logout-area"><button class="logoutbtn" id="logoutbtn">LOGOUT</button></div>
        </div>

        <div class="sessions-area">
            <div class="label-area"><label for="">SESSION</label></div>
            <div class="dropdown-area">
                <select name="" class="dropclass" id="dropclass">
                   <!-- <option >SELECT ONE</option>
                    <option >2024 EVEN SEM</option>
                    <option >2024 ODD SEM</option>   -->
                </select>
            </div>
        </div>

        <div class="classes-area" id="classarea">
           <!-- <div class="classcard">7CSA</div>
            <div class="classcard">7CSB</div>
            <div class="classcard">7CSC</div>
            <div class="classcard">7CSD</div>
            <div class="classcard">7CSE</div>
            <div class="classcard">7CSF</div> -->
        </div>

        <div class="subjects-area" id=subjectarea>
            <!-- <div class="subject" id="subject">
                <div class="code-area">BCS-DS-724</div>
                <div class="title-area">ADVANCED COMPUTER NETWORKS</div>
                <div class="ondate-area">
                    
                    <input type="date" name="" id="myDate">
                </div>
            </div> -->
        </div>

        <div class="students-area" id="studentarea">
        <!--    <div class="studentlist">
                <label for="">STUDENT LIST</label>
            </div>

            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div>
            <div class="student">
                <div class="SIno-area">001</div>
                <div class="roll-area">1/21/FET/BCS/320</div>
                <div class="name-area">RAJAT CHOWDHURY</div>

                <div class="check-area">
                    <input type="checkbox" name="" id="">
                </div>
            </div> -->
        </div>

        <!-- <div class="report-area" id="reportarea">
            <button class="report" id="report">GENERATE ATTENDANCE REPORT</button>
        </div> -->
    </div>

<input type="hidden" id="hiddenFacid" value="<?php echo($facid)?>">
<input type="hidden" id="hiddenSubjectid" value=-1>
<script src="/PHPATMS/javascript/jquery.js"></script>
<script src="/PHPATMS/javascript/logout.js"></script>
<script src="/PHPATMS/javascript/attendance.js"></script>
</body>
</html>