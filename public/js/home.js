$(document).ready(function() {
    // subcategory show
    // $('#parent-1').show(500);
    $('button').click(function() {
        //parent
        if ($(this).data('type') == 'video-cat') {
            location.href = base_url + "media/category_view/" + $(this).data('id');
        }
    });
});