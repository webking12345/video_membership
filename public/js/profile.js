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

    let angles = [288, 324, 0, 36, 72];

    // membership
    $("#indicator").propeller({
        inertia: 0,
        angle: angles[plan_id],
        speed: 1,
        step: 12,
        onRotate: function(){

            // limit right
            if((this.angle >= 60 && this.angle <= 180) || (this.angle >= -300 && this.angle <= -200))
            {
                this.angle = 72;
                plan_id=4
            }

            //limit left
            if((this.angle <= 300 && this.angle >= 200) || (this.angle <= -60 && this.angle >= -180))
            {
                this.angle = 288;                
                plan_id=0
            }
            
            if((this.angle>=24 && this.angle <= 48) || (this.angle >= -336 && this.angle <= -312))
            {
                this.angle=36;
                plan_id=3
            }
            
            if(this.angle >= 348 || (this.angle >=0 && this.angle <= 12) || (this.angle >= (-348) && this.angle <= (-12)))
            {
                this.angle = 0;
                plan_id=2
            }

            if((this.angle >= 312 && this.angle <= 336) || (this.angle <= -24 && this.angle >= -48))
            {
                this.angle=324;
                plan_id=1
            }

            if(this.angle > 360)
                this.angle = 360;
            if(this.angle < -360)
                this.angle = -360;

            $('.plan').each(function() {
                if ($(this).data("id") == plan_id) {
                    $(this).removeClass("d-none");
                    $(this).addClass("d-block");
                    $("#membership_id").val(plan_id + 1)
                    $("#membership_title").val($(this).children( ".title" ).text())
                    $("#membership_amount").val($(this).children( ".price" ).children( ".amount" ).text())
                } else {
                    $(this).addClass("d-none");
                    $(this).removeClass("d-block");
                }
            });
        }
    });

    $('.plan').each(function() {
        if ($(this).data("id") == plan_id) {
            $(this).removeClass("d-none");
            $(this).addClass("d-block");
            $("#membership_id").val(plan_id + 1)
            $("#membership_title").val($(this).children( ".title" ).text())
            $("#membership_amount").val($(this).children( ".price" ).children( ".amount" ).text())
        } else {
            $(this).addClass("d-none");
            $(this).removeClass("d-block");
        }
    });

    $("#checkout").click(function(){
        //if membership level is 0, return false
        if($("#membership_amount").val() * 1 <= 0)
        {
            alert("Please level up membership to purchase");
            e.preventDefault();
            e.stopPropagation();
            return false;
        }

        //clear TempData
        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'tempData/clearTemp',
            async: false,
        });

        // send membership data to server as temp data
        let flgSent = false;

        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'tempData/storeTempData',
            data: {membership_id : $("#membership_id").val(), table : "purchase_membership"},
            async: false,
            success: function(response) {
                if(response==1)
                {
                    flgSent = true
                } else {
                    alert('Server error. \n Please try again.')
                }
            },
            error: function() {}
        });
        /////
        if(!flgSent)
        {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }

        //checkout
        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'checkout/stripe/setSess',
            data: { description:  "Purchase " + $("#membership_title").val() + " membership", amount : $("#membership_amount").val(), redirect_url : "profile"},
            async: false,
            success: function(response) {
                if(response==1)
                {
                    location.href = base_url + 'checkout/stripe'
                } else {
                    alert('Server error. \n Please try again.')
                }
            },
            error: function() {}
        });
        /////
        return false;
    })
});