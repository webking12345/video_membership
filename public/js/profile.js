$(document).ready(function() {
    $("input").focusin(function() {
        $(this).addClass("focus");
    });

    //form sumbit
    $("#frm_auth").submit(function(e) {
        e.preventDefault();
        var pwd = $("#pwd").val();
        var confirm_pwd = $("#confirm_pwd").val();
        if(pwd !== confirm_pwd){
            alert("Passwords don't match")
            $("#confirm_pwd").focus();
            e.preventDefault();
            e.stopPropagation();
            return false;
        }

        let email_exist=false;

        $.ajax({
            type: "POST",
            url: base_url + "auth/checkEmail",
            data: { email: $("#email").val() },
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("This Email is already registered")
                    $("#email").focus()
                    email_exist = true;
                }
            },
            error: function() {}
        });
        
        if(email_exist)
            return false;

        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + "profile/update",
            data: {pwd:$("#pwd").val(), email:$("#email").val()},
            async: false,
            success: function(response) {
                if (response) {
                    alert('Updated Successfully!');
                }
            },
            error: function() {}
        });
        return false;
    });
});