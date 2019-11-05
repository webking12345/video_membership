$(document).ready(function(){
    $("#frm_header_footer").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/setting/saveHeaderFooter',
            data: {title:$("#title").val(), copyright:$("#copyright").val()},
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("Saved successfully!")
                }else{
                    alert("Something wrong. Please try again.")
                }
            },
            error: function() {
                alert("Something wrong. Please try again.")
            }
        });
        return false;
    })

    $("#frm_home").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/setting/saveHome',
            data: { welcome:$("#welcome").val() },
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("Saved successfully!")
                }else{
                    alert("Something wrong. Please try again.")
                }
            },
            error: function() {
                alert("Something wrong. Please try again.")
            }
        });
        return false;
    })

    $("#frm_register").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/setting/saveRegister',
            data: { register_description1 : $("#register_description1").val(), register_description2 : $("#register_description2").val() },
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("Saved successfully!")
                }else{
                    alert("Something wrong. Please try again.")
                }
            },
            error: function() {
                alert("Something wrong. Please try again.")
            }
        });
        return false;
    })

    $("#frm_login").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/setting/saveLogin',
            data: { login_description : $("#login_description").val() },
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("Saved successfully!")
                }else{
                    alert("Something wrong. Please try again.")
                }
            },
            error: function() {
                alert("Something wrong. Please try again.")
            }
        });
        return false;
    })

    $("#frm_join").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/setting/saveJoin',
            data: { join_description : $("#join_description").val() },
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    alert("Saved successfully!")
                }else{
                    alert("Something wrong. Please try again.")
                }
            },
            error: function() {
                alert("Something wrong. Please try again.")
            }
        });
        return false;
    })
})