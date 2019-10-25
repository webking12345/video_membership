$(document).ready(function() {
    //sticky bar 
    $("#theme-btn").click(function() {
        if ($(this).data("state")) {
            $(this).data("state", 0);
            $(this).find("img").attr("src", base_url + "public/images/bulb-off.png");
            theme='darkly'
        } else {
            $(this).data("state", 1);
            $(this).find("img").attr("src", base_url + "public/images/bulb-on.png");
            theme='brightly'
        }
        $.ajax({
            type: "post",
            url: base_url + "setting/set_theme",
            data: { theme: $(this).data("state") },
            success: function() {
            },
            error: function() {}
        });

        if ($(this).data("state")) {
            $('.darkly').each(function() {
                $(this).removeClass("darkly");
                $(this).addClass("brightly");
            });
            $('.darkly-nav').each(function() {
                $(this).removeClass("darkly-nav");
                $(this).addClass("brightly-nav");
            });
            $('.dark-purple-button').each(function() {
                $(this).removeClass("dark-purple-button");
                $(this).addClass("brightly-btn");
            });
        } else {
            $('.brightly').each(function() {
                $(this).removeClass("brightly");
                $(this).addClass("darkly");
            });
            $('.brightly-nav').each(function() {
                $(this).removeClass("brightly-nav");
                $(this).addClass("darkly-nav");
            });
            $('.brightly-btn').each(function() {
                $(this).removeClass("brightly-btn");
                $(this).addClass("dark-purple-button");
            });
        }
    });

    // When the user scrolls the page, execute myFunction
    window.onscroll = function() { myFunction() };

    // Get the navbar
    var navbar = document.getElementById("sticky");

    // Get the offset position of the navbar
    var sticky = navbar.offsetTop;

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset > sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
});