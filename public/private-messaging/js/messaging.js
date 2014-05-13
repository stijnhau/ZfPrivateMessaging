$(function () {
    $(".messaging-star").each(function () {
        if ($(this).attr('data-type') === 'star') {
            $(this).addClass('glyphicon-star');
        } else {
            $(this).addClass('glyphicon-star-empty');
        }
    });
    $(".glyphicon-star").each(function () {
        $(this).attr('title', 'Starred');
    });
    $(".glyphicon-star-empty").each(function () {
        $(this).attr('title', 'Unstarred');
    });
    $(".messaging-star, .messaging-imp").on('click', function () {

    });
});