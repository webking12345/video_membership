$(window).on('load', function () {
    let themeImg=$("#theme-btn").find("img").attr("src");
    var fileNameIndex = themeImg.lastIndexOf("/") + 1;
    var filename = themeImg.substr(fileNameIndex);
    $("#pagenation ul li").addClass(filename=="bulb-on.png"?"brightly-btn" : "dark-purple-button")
});
$(document).ready(function(){
/*pagenation on catalog page*/
    // for mobile
    let maxvisible = 10;
    let current_page=1;
    if ($(this).width() < 768) {
        maxvisible = 1;
    } else if ($(this).width() < 1024) {
        maxvisible = 5;
    }
    $(window).resize(function() {
        if ($(this).width() < 768) {
            maxvisible = 1;
        } else if ($(this).width() < 1024) {
            maxvisible = 5;
        } else {
            maxvisible = 10;
        }
        $('#pagenation').bootpag({ maxVisible: maxvisible });

        let themeImg=$("#theme-btn").find("img").attr("src");
        var fileNameIndex = themeImg.lastIndexOf("/") + 1;
        var filename = themeImg.substr(fileNameIndex);
        $("#pagenation ul li").addClass(filename=="bulb-on.png"?"brightly-btn" : "dark-purple-button")
    });
    
    //iniitial pagenation
    $('#pagenation').bootpag({
        total: pages,
        page: 1,
        maxVisible: maxvisible,
        leaps: true,
        next: 'next',
        prev: 'prev',
        firstLastUse: true,
        first: 'first',
        last: 'last',
        wrapClass: 'pagination',
        activeClass: theme + ' pagination-active',
        disabledClass: 'disabled',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event, num) {
        current_page=num;
        $('#pagenation').bootpag({ page: current_page });
        $('#pagenation').bootpag({ activeClass: theme + ' pagination-active' });
        loadContents();
    });

    $("#content-title, #subject, #order, #price").change(function(){
        current_page=1
        $('#pagenation').bootpag({ page: current_page });
        loadContents()
    })

    $("#term").keyup(function(e){
        if(e.keyCode == 13)
        {
            current_page=1
            $('#pagenation').bootpag({ page: current_page });
            loadContents()
        }
    })

    function loadContents(){
        $.ajax({
            type: "post",
            async:false,
            dataType:'json',
            url: base_url + "catalogue/filterPage",
            data: { current_page: current_page, title:$("#content-title").val(), term:$("#term").val(), categoryId:$("#subject").val(),order:$("#order").val(), price:$("#price").val()},
            success: function(res) {
                $('#pagenation').bootpag({ total: res['pages'] });
                
                $("#pagenation ul li").addClass(theme=='brightly'?"brightly-btn" : "dark-purple-button")
                if(!res['contents'].length)
                {
                    $("#contents").html('<div class="col-lg-12 text-secondary">No Result</div>')    
                    return true;
                }

                $("#contents").html('')
                res['contents'].map(content => {
                    let list=[
                        '<div class="col-sm-6 col-lg-4 mb-4">',
                            '<div class="catalog-item" style="height:200px; background: url(', content['thumb_url'].substr(0,6)=="public" ? (base_url + content['thumb_url']) : content['thumb_url'], ') no-repeat; background-size:cover">',
                                '<div class="overlay">',
                                    '<div class="background">',
                                        '<div class="font-color-light-blue pt-5">', content['title'], '</div>',
                                        '<div class="font-color-light-blue" >', content['category_name'], '</div>',
                                        '<a href="', base_url, 'catalogue/details/', content['id'], '"><div style="background-color:rgb(0,0,0,0)" class="w-75 font-color-light-blue m-auto ', theme?"brightly-btn" : "dark-purple-button", '">view details</div></a>',
                                    '</div>',
                                '</div>',
                            '</div>'].join("\n")
                    $("#contents").append(list)
                });
            },
            error: function() {}
        });
    }
});
