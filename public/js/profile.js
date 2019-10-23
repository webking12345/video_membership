$(document).ready(function() {
    $("input").focusin(function() {
        $(this).addClass("focus");
        // $('#reg-description .messages').html('');
        // $('#reg-description .messages').removeClass("text-danger");
        // $('#reg-description .messages').removeClass("text-success");
        // var id = $(this).attr("id");
        // var str = "";
        // if (id == "username") {
        //     str += "You cannot change username.";
        // } else if (id == "pwd") {
        //     str += "Please enter your password.<br> Password must be at least 6 characters long.";
        // } else if (id == "confirm-pwd") {
        //     str += "Please enter the same password as above";
        // } else if (id == "email") {
        //     str += "Please enter a valid email address";
        // }
        // $('#reg-description .messages').html(str);
    });
    //input validation
    function validation(name) {
        var value = $("#" + name).val();
        var str = "";
        var flag = 1;
        if (name == "username" && value.length < 2) {
            str += "You must enter at least 2 characters long";
            flag = 0;
        } else if (name == "pwd" || name == "confirm-pwd") {
            if (value.length < 6) {
                str += "You must enter at least 6 characters long";
                flag = 0;
            } else if (name == "confirm-pwd" && ($("#pwd").val() != value)) {
                str += "You must enter the same password as above";
                flag = 0;
            }
        } else if (name == "email") {
            if (!validateEmail(value)) {
                str += "You must enter valid Email address";
                flag = 0;
            }
        }
        if (flag == 0) {
            $("#" + name).addClass("border-danger");
            $('#reg-description .messages').html("");
            $('#reg-description .messages').addClass("text-danger");
            $('#reg-description .messages').html(str);
            return false;
        } else {
            $("#" + name).removeClass("border-danger");
            $('#reg-description .messages').removeClass("text-danger");
        }
        return true;
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    // verfify username or email 
    $("input").focusout(function(event) {
        var name = event.target.id;
        var view = $("form").data('view');
        var value = $("#" + name).val();
        if (!validation(name)) {
            return false;
        }
        var str = '';
        if (name == 'email') {
            $.ajax({
                type: "POST",
                url: base_url + "auth/checkUser",
                data: { name: name, val: $("#" + name).val() },
                async: false,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $('#reg-description .messages').html("");
                        str = 'Sorry, the same Email address is already registered.<br> Please enter another Email address.';
                        
                        $('#reg-description .messages').html("");
                        $("#" + name).addClass("border-danger");
                        $("#" + name).focus();
                        $('#reg-description .messages').addClass("text-danger");
                        $('#reg-description .messages').html(str);
                        return false;
                    } else {
                        $("#" + name).removeClass("border-danger");
                        $('#reg-description .messages').removeClass("text-danger");
                    }
                },
                error: function() {}
            });
        }
        return true;
    });

    //users manage
    $("#frm_auth").submit(function(e) {
        e.preventDefault();

        if ($('#reg-description .messages').hasClass("text-success")) {
            return false;
        }
        var valid = true;
        $("#frm_auth input").each(function() {
            var id = $(this).attr('id');
            if (!validation(id)) {
                valid = false;
            }
        });
        if (!valid) {
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + "profile/update",
            data: {pwd:$("#pwd").val(), email:$("#email").val()},
            async: false,
            success: function(response) {
                $('#reg-description .messages').html("");
                if (response) {
                    str = 'Updated Successfully!';

                    $('#reg-description .messages').removeClass("text-danger");
                    $('#reg-description .messages').addClass("text-success");
                    $('#reg-description .messages').html(str);
                }
            },
            error: function() {}
        });
        return true;
    });
});