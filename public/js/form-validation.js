$(document).ready(function() {
    $("#register").validate({
        rules: {
            username: {
                required: true,
                minlength: 2
            },
            pwd: {
                required: true,
                minlength: 6
            },
            confirm_pwd: {
                required: true,
                minlength: 6,
                equalTo: "#pwd"
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            username: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 2 characters"
            },
            pwd: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            confirm_pwd: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address"
        }
    });
});