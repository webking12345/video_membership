$(document).ready(function() {
    // membership button
    $('.m-btn').hover(function() {
            if ($(this).data("active") == 1) {
                return false;
            }
            $(this).children("img").attr("src", base_url + "public/images/hover-button.png");
        },
        function() {
            if ($(this).data("active") == 1) {
                return false;
            }
            $(this).children("img").attr("src", base_url + "public/images/default-button.png");
        }
    );

    // membership description
    $('.m-btn').click(function() {
        var btn = $(this).data("btn");
        $(this).children("img").attr("src", base_url + "public/images/button" + $(this).data("btn") + ".png");
        var colors = ["#6fd133", "#efd746", "#b246ef", "#ef7546"];
        $('.priceing-card').each(function() {
            $(this).removeClass("d-block");
            $(this).find(".currency").html($("#currency").val());
            if ($(this).data("id") == btn) {
                $(this).removeClass("d-none");
                $(this).addClass("d-block");
            } else {
                $(this).addClass("d-none");
            }
        });
        $(this).data("active", 1);
        $('.m-btn').each(function() {
            if ($(this).data("btn") != btn) {
                $(this).children("img").attr("src", base_url + "public/images/default-button.png");
                $(this).data("active", 0);
            }
        });
    });

    //currency converter
    $("#currency").change(function() {
        var sign = $(this).val();
        $(".priceing-card").find(".currency").each(function() {
            $(this).html("");
            $(this).html(sign);
        });
    });
    $("input").focusin(function() {
        $(this).addClass("focus");
        $('#reg-description .messages').html('');
        $('#reg-description .messages').removeClass("text-danger");
        $('#reg-description .messages').removeClass("text-success");
        var id = $(this).attr("id");
        var str = "";
        if (id == "username") {
            str += "Please enter your username.<br> User name must be at least 2 characters long.";
        } else if (id == "pwd") {
            str += "Please enter your password.<br> Password must be at least 6 characters long.";
        } else if (id == "confirm-pwd") {
            str += "Please enter the same password as above";
        } else if (id == "email") {
            str += "Please enter a valid email address";
        }
        $('#reg-description .messages').html(str);
    });
    //input validation
    function validation(name) {
        var value = $("#" + name).val();
        var str = "";
        var flag = 1;
        if (value.length == 0) {
            str += "This field is required!";
            flag = 0;
        } else if (name == "username" && value.length < 2) {
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
        if (view !== 'login' && (name == 'username' || name == 'email')) {
            $.ajax({
                type: "POST",
                url: base_url + "auth/checkUser",
                data: { name: name, val: $("#" + name).val() },
                async: false,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $('#reg-description .messages').html("");
                        if (name == "username") {
                            str += 'Sorry, the same name is already registered.<br> Please enter another name.';
                        } else {
                            str += 'Sorry, the same Email address is already registered.<br> Please enter another Email address.';
                        }
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
        var view = $(this).data("view");
        var method=view=="login"?"verify":"register_user";
        var c_url = base_url + "auth/" + method;
        console.log(c_url);

        $.ajax({
            type: "POST",
            method: "POST",
            dataType: "json",
            url: c_url,
            data: $("#frm_auth").serializeArray(),
            async: false,
            success: function(response) {
                $('#reg-description .messages').html("");
                if (view !== "login" && response == "already") {
                    var str = 'Sorry, the same user is already registered.';
                    $('#reg-description .messages').removeClass("text-success");
                    $('#reg-description .messages').addClass("text-danger");
                    $('#reg-description .messages').html(str);
                    $('input').each(function() {
                        $(this).val('');
                    });
                }
                if (response==1) {
                    var str = '';
                    if (view == "register") {
                        str += 'Registration Successfully!';
                    } else {
                        str += 'Login Successfully!';
                    }
                    location.href = base_url + "catalogue";

                    $('#reg-description .messages').removeClass("text-danger");
                    $('#reg-description .messages').addClass("text-success");
                    $('#reg-description .messages').html(str);
                    $('input').each(function() {
                        $(this).val('');
                    });
                } else if(response==2){
                    if (view == "login") {
                        var str = "Forgot Password? Don't worry!<br> <a href='" + base_url + "auth/forgot_password'>Reset Password!. </a>";
                    }
                    $('#reg-description .messages').removeClass("text-success");
                    $('#reg-description .messages').addClass("text-danger");
                    $('#reg-description .messages').html(str);
                } else {
                    if (view == "login") {
                        var str = "Don't you have account? <br> <a href='" + base_url + "auth/register'>Please regsiter. </a>";
                    } else if (view == "regist_user") {
                        var str = "Registration Failed!";
                    }
                    $('#reg-description .messages').removeClass("text-success");
                    $('#reg-description .messages').addClass("text-danger");
                    $('#reg-description .messages').html(str);
                }
            },
            error: function() {}
        });
        return true;
    });
});