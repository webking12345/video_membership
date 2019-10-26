let plan_id=1;

$(document).ready(function() {
    //currency converter
    $("#currency").change(function() {
        var sign = $(this).val();
        $(".plan").find(".currency").each(function() {
            $(this).html("");
            $(this).html(sign);
        });
    });

    $("#indicator").propeller({
        inertia: 0,
        angle:324,
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
                } else {
                    $(this).addClass("d-none");
                    $(this).removeClass("d-block");
                }
            });
        }
    });

    $('.plan').each(function() {
        if ($(this).data("id") == 1) {
            $(this).removeClass("d-none");
            $(this).addClass("d-block");
        } else {
            $(this).addClass("d-none");
            $(this).removeClass("d-block");
        }
    });

    $("#checkout").click(function(){
        if(plan_id > 0)
        {
            alert("Comming soon!!!")
        } else {
            alert("Please level up membership to purchase");
        }
    })
});