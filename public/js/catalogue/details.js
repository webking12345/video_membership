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
});
