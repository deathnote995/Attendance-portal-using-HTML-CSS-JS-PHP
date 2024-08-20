function tryLogin()
{
    let user=$("#username").val();
    let pwd=$("#paswd").val();
    if(user.trim()!=="" && pwd.trim()!=="")
    {
        alert("conn1");
        $.ajax({
            url:"/PHPATMS/ajaxHandler/ajax.php",
            // url:"/ajaxHandler/ajax.php",
            type:"POST",
            datatype:"json",
            data:{user_id:user, pswd:pwd, action:"verifyUser"},
            beforeSend:function(){
                alert("make call");
            },
            success:function(response){
                try {
                    // Parse the JSON string into an object
                    console.log("raw",response);
                    var rv = JSON.parse(response);
            
                    // Check the type of rv
                    console.log(typeof rv);  // Should now be 'object'
            
                    // Log the entire object
                    console.log(rv);
            
                    // Access the 'status' property
                    console.log(rv.status);  // Make sure this prints the expected status
            
                    // Now use rv.status safely
                    if (rv.status === "ALL OK") {
                        document.location.replace("/PHPATMS/database/attendance.php");
                    } else {
                        alert(rv.status);
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    alert("Error parsing server response. Please try again.");
                }
            },
            error:function(){
                alert("ERROR2");
            },
        });
    }
}


$(function(e){
    alert("form loaded successfully");
    console.log("fjh");
});

$(function(e){
    //capture keyup events
    $(document).on("keyup","input",function(e){
        let user=$("#username").val();
        let pwd=$("#paswd").val();
        if(user.trim()!=="" && pwd.trim()!=="")
        {
            $("#btnlogin").removeClass("inactiveColor");
            $("#btnlogin").addClass("activeColor");
        }
        else
        {
            $("#btnlogin").removeClass("activeColor");
            $("#btnlogin").addClass("inactiveColor");
        }
    });

    //capture login button click event
    $(document).on("click","#btnlogin",function(e){
        tryLogin();
    });
});