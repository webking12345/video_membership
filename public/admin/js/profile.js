$(document).ready(function(){
    $("#m_frm").validate({
        // define validation rules
        rules: {
            current_pwd: {
                required: true,
            },
            new_pwd: {
                required: true,
                minlength: 6,
            },
            confirm_pwd: {
                required: true,
                equalTo:"#new_pwd",
            },        
        },
        
        //display error alert on form submit  
        invalidHandler: function(event, validator) {     
            var alert = $('#m_frm_msg');
            alert.removeClass('m--hide').show();
            mUtil.scrollTop();
        },

        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: base_url + 'admin/profile/saveData',
                data: {current_pwd:$("#current_pwd").val(),new_pwd:$("#new_pwd").val()},
                async: false,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        alert("Change password successfully!")
                    }else{
                        alert("Wrong current password")
                    }
                },
                error: function() {}
            });

            return false;
        }
    });

    $("#save").click(function(){
        $("#m_frm").submit()
    });
})