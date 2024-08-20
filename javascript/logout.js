$(
    function(e)
    {
        $(document).on("click","#logoutbtn",function(e)
        {
            $.ajax
            (
                {

            
            url:"/PHPATMS/ajaxHandler/ajax2.php",
            type:"POST",
            dataType:"json",
            data:{id:1},
            beforSend:function(e){
                //empty
            },
            success:function(e){
                document.location.replace("/PHPATMS/database/login.php");
            },
            error:function(e){
                alert("something wrong");
            },
        }
    )
        }
    )
    }
)