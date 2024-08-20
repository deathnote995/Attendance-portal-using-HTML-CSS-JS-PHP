/*
USED REPEATEDLY
 $.ajax({
        url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
        type:"POST",
        dataType:"json",
        data:{},
        beforeSend:function(e){
            //empty
        },
        success:function(rv){
            alert(JSON.stringify(rv));
        },
        error:function(e){
            alert("something wrong");
        },
    });
    */ 
   
   function saveInDB(studentid,facultyid,subjectid,sessionid,ondate,studentStatus)
   {
    // alert(studentStatus);
        $.ajax({
            url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
            type:"POST",
            dataType:"json",
            data:{student_id:studentid, faculty_id:facultyid, subject_id:subjectid, session_id:sessionid, on_date:ondate, status:studentStatus, action:"marking"},
            beforeSend:function(e){
                //empty
            },
            success:function(rv){
                // alert(JSON.stringify(rv));  
                // alert("success");
            },
            error:function(e){
                alert("something wrong");
            },
        });

}

function getStudentsHTML(rv)
{
    let x=`<div class="studentlist">
    <label for="">STUDENT LIST</label>
    </div>`;

    for(let i=0; i<rv.length; i++)
    {
        let slist=rv[i];
        let checkedStatus=``;
        if(slist['isPresent']=="yes")
        {
            checkedStatus=`checked`;
        }
        x=x+`<div class="student" >
        <div class="SIno-area">${(i+1)}</div>
        <div class="roll-area">${slist['roll_no']}</div>
        <div class="name-area">${slist['name']}</div>

        <div class="check-area">
            <input type="checkbox" name="" id="present" data-studentid='${slist['stud_id']}' ${checkedStatus}>
        </div>
        <!--<input type="hidden" id="hiddenstudentid" value='${slist['stud_id']}'>  -->
        </div>`;
    }

    x=x+` <div class="report-area" id="reportarea">
    <button class="report" id="report">GENERATE ATTENDANCE REPORT</button>
</div>
<div id="divreport"></div>
`;
    return x;

}

function getSubjectHTML(s)
{
    // alert(s['code']);
    let dateObj= new Date();
    let year=dateObj.getFullYear();  //return year in yyyy format
    let month=dateObj.getMonth()+1; //return 0-11 so have to add 1
    let day=dateObj.getDate();  //return 1-31
    if(month<10)
    {
        month="0"+month; //now its is a string
        // alert(month);
    }
    if(day<10)
    {
        day="0"+day;    //now its is a string
        // alert(day);
    }
    let onDate=year+"-"+month+"-"+day;
    // alert(onDate);
    let x=``;

        // let subDetail = s[i];
        x=` <div class="subject" id="subject">
        <div class="code-area">${s['code']}</div>
        <div class="title-area">${s['title']}</div>
        <div class="ondate-area">
            <input type="date" name="" id="myDate" value='${onDate}'>
        </div>
    </div> `;
    return x;
}

function getSessionHTML(rv)
{
    let x=``;
    x=`<option value=-1>SELECT ONE</option>`;
    for (let  i= 0;  i< rv.length; i++)
    {
        let cs=rv[i];
        x=x+`<option value=${cs['sess_id']}>${cs['year']+" "+cs['term']}</option>`;    
    }

    return x;
}
function getAllotmentHTML(rv)
{
    let x=``;
    for (let i = 0; i < rv.length; i++) {
        let subCard = rv[i];
        x=x+`<div class="classcard" id="classcard" data-classobject='${JSON.stringify(subCard)}'>${subCard['code']}</div>`;
        // x=x+`<div class="classcard" data-classobject='${subCard}'>${subCard['code']}</div>`;
    }
    return x;
}

function loadSession()
{
    $.ajax({
        url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
        type:"POST",
        dataType:"json",
        data:{action:"getSession"},
        beforeSend:function(e){
            //empty
        },
        success:function(rv){
            // alert(JSON.stringify(rv));
            //create html dynamically from rv
            let x=getSessionHTML(rv);
            $("#dropclass").html(x);
        },
        error:function(e){
            alert("something wrong");
        },
    });
}

function fetchFacultyAllotment(facid,sessid)
{
    $.ajax({
        url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
        type:"POST",
        dataType:"json",
        data:{faculty_id:facid, session_id:sessid, action:"getAllotment"},
        beforeSend:function(e){
            //empty
        },
        success:function(rv){
            // alert(JSON.stringify(rv));
            //showing subject card using html dynamicaly from rv
            let x=getAllotmentHTML(rv);
            $("#classarea").html(x);

        },
        error:function(e){
            alert("something wrong");
        },
    });
}

function fetchStudentList(sessionid,subjectid,facid,ondate)
{
    $.ajax({
        url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
        type:"POST",
        dataType:"json",
        data:{session_id:sessionid, subject_id:subjectid, faculty_id:facid, on_date:ondate, action:"getStudents"},
        beforeSend:function(e){
            // alert("sutta");
            //empty
        },
        success:function(rv){
            // alert(JSON.stringify(rv));
            // alert(rv['isPresent']);
            let x=getStudentsHTML(rv);
            $("#studentarea").html(x);
        },
        error:function(e){
            alert("something wrong");
        },
    });
}

function focusSubject(s,session,fac)
{
    // alert(s['sub_id']);
    // $.ajax({
    //     url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
    //     type:"POST",
    //     dataType:"json",
    //     data:{session_id:session,faculty_id:fac,action:"focus"},
    //     beforeSend:function(e){
    //         //empty
    //     },
    //     success:function(rv){
    //         rv=JSON.stringify(rv);
    //         alert(rv);
    //         for(let i=0;i<rv.length;i++)
    //         {
    //             let id=rv[i];
    //             alert(id);
    //             if(id==s['sub_id'])
    //             {
    //                 $("#classcard").addClass("after");
    //                 // alert("sutta");
    //             }
    //             else
    //             {
    //                 $("#classcard").removeClass("after");
    //                 alert("sutta");

    //             }
    //         }
    //     },
    //     error:function(e){
    //         alert("out of focus");
    //     },
    // })
    let x=``;
    x= `<div class="classcard" id="classcard"
    style="transform: scale(1.2);
    background-color: seagreen;">${s['code']}</div>`;
    return x;
}

function downloadCSV(sessionid,subjectid,facultyid)
{
    // alert("work");  
    $.ajax({
        url:"/PHPATMS/ajaxHandler/attendanceAjax.php",
        type:"POST",
        dataType:"json",
        data:{session_id:sessionid, subject_id:subjectid, faculty_id:facultyid, action:"download"},
        beforeSend:function(e){
            //empty
        },
        success:function(rv){
            alert(JSON.stringify(rv));
            let x=`
            <object data=${rv['filename']} type="text/html" target="_parent"></object>
            `;
            $("#divreport").html(x);
        },
        error:function(e){
            alert("something wrong");
        },
    });
}

function getReport()
 {
    // alert("sutta1");
    let x=``;
    x=` <div class="report-area" id="reportarea">
    <button class="report" id="report">GENERATE ATTENDANCE REPORT</button>
</div>`;
    return x;
 }



$(function(e){
    //as soon as page is loaded
    loadSession();

    //capturing change in session id
    $(document).on("change","#dropclass",function(e){
        $("#classarea").html(``);
        $("#subjectarea").html(``);
        $("#studentarea").html(``);
        let ssid=$("#dropclass").val();
        // alert(ssid);
        if(ssid!=-1)
        {
            // alert(ssid);
            // let sessid=ssid;
            let facid=$("#hiddenFacid").val();
            fetchFacultyAllotment(facid,ssid);  //for fetching the subjects taught by that faculty in that session
        }
        
    })
    
    //when any subject card is clicked
    $(document).on("click",".classcard",function(e){
        // $("#classcard").removeClass("after");
        // $("#classcard").addClass("after");
        let s=$(this).data('classobject');
        // alert(s['code']);
        let session=$("#dropclass").val();
        let fac=$("#hiddenFacid").val();
        // let y=focusSubject(s,session,fac);
        // $("#classcard").html(y);
        let x=getSubjectHTML(s);
        $("#subjectarea").html(x);
        $("#hiddenSubjectid").val(s['sub_id']);
        
        //fetch student list
        let sessionID=$("#dropclass").val();
        let subjectID=s['sub_id'];
        let facID=$("#hiddenFacid").val();
        let onDate=$("#myDate").val()
        fetchStudentList(sessionID,subjectID,facID,onDate);

        //generate attendance report
        // let X=getReport();
        // $("#reportarea").html(X);
    })
    
    //marking attendance and saving the record
    $(document).on("click","#present",function(e){
        // alert(s['sub_id']);   
        let status=this.checked;
        if(status)
        {
            status="yes";
        }
        else
        {
            status="no";
        }
        // alert(ispresent);
        // let studentid=$("#hiddenstudentid").val();
        let studentid=$(this).data('studentid');
        let facultyid=$("#hiddenFacid").val();
        // let sub= $(this).data('classobject');
        // let subjectid=sub['sub_id'];
        let subjectid= $("#hiddenSubjectid").val();
        // alert(subjectid);
        let sessionid=$("#dropclass").val();
        let ondate=$("#myDate").val();
        // alert(ondate);
        // alert(studentid+" "+facultyid+" "+subjectid+" "+sessionid+" "+ondate+" "+status);
        saveInDB(studentid,facultyid,subjectid,sessionid,ondate,status);
        
    })

    $(document).on("change","#myDate",function(e){
        let ondate=$("#myDate").val();
        // alert(ondate);
        // let studentid=$(this).data('studentid');
        let facultyid=$("#hiddenFacid").val();
        let subjectid= $("#hiddenSubjectid").val();
        // alert(subjectid);
        let sessionid=$("#dropclass").val();
        // alert(facultyid+" "+subjectid+" "+sessionid+" "+ondate+" "+status);
        // onDateChange(studentid,facultyid,subjectid,sessionid,ondate,status);
        fetchStudentList(sessionid,subjectid,facultyid,ondate);
    })

    $(document).on("click","#report",function(e){
        //send session id, faculty id, and subject id to the server
        //server will return a csv file
        alert("clicked");
        let sessionID=$("#dropclass").val();
        let subjectID=$("#hiddenSubjectid").val();
        let facID=$("#hiddenFacid").val();
        downloadCSV(sessionID,subjectID,facID);
    })

});