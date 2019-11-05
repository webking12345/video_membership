$(document).ready(function(){
    //details similar products carousel
    var owl = $(".owl-carousel-category");
    if (owl.length > 0) {
        owl.owlCarousel({
            loop:false,
            margin:10,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            stopOnHover: true,
            margin:10,
            responsiveClass:true,
            rewind:true,
            dots:false,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:2,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:false
                }
            },
            navText:["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
        });
    }

    $("#view").click(function(){
        if(is_member > 0 || is_purchased > 0)
        {
            return true
        } else {
            alert("Please join us or pay to play")
            return false
        }

    });

    $("#pay2play").click(function(){
        // send contents data to server as temp data
        let flgSent = false;

        $.ajax({
            type: "POST",
            method: "POST",
            dataType: "json",
            url: base_url + 'tempData/storeTempData',
            data: {content_id : content_id, table : "purchase_contents"},
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
            data: { description:  "Purchase content : " + content_title , amount : content_price, redirect_url : "media/contents_view/" + content_id},
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
    })
});
