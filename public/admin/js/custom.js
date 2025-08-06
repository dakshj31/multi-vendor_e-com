$(document).ready(function(){

    // Check Admin password is correct or not
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/admin/verify-password',
            data: {current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#verifypwd").html("<font color='red'>Current Password is incorrect</font>");
                } else if(resp == "true"){
                    $("#verifypwd").html("<font color='green'>Current Password is correct</font>");
                }
            },
            error:function(){
                alert("Error");
            }
        });
    });
});