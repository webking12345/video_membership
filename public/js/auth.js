$(document).ready(function() {
    $("input").focusin(function() {
        $(this).addClass("focus");
    });

    //users manage
    $("#frm_auth").submit(function(e) {
        var view = $(this).data("view");
        var method=view=="login"?"verify":"register_user";
        var c_url = base_url + "auth/" + method;

        if(view !== "login")
        {
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
        }

        $.ajax({
            type: "POST",
            method: "POST",
            dataType: "json",
            url: c_url,
            data: $("#frm_auth").serializeArray(),
            async: false,
            success: function(response) {
                if(!response){
                    if(view=="login"){
                        alert('Invalid username')
                        $("#username").focus()
                    } else {
                        alert('Registration failed. \n Please try again.')
                    }
                }
                if(response==1)
                {
                    location.href = base_url + 'catalogue'
                }
                if(response==2)
                {
                    if(view=='login')
                    {
                        alert('Invalid password')
                        $("#pwd").focus()
                    }
                }
            },
            error: function() {}
        });
        return false;
    });
});