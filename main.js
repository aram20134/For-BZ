$(document).ready(function () {
    $('.first').click(function () {
        $(this).toggleClass('active-server');
        $(this).toggleClass('box-online-hover');
        $('.text-online1').toggleClass('not-active');
        $('.desc-content1').toggleClass('not-active');
    });
    $('.first').hover(function () {
        if(!$(this).hasClass('active-server')) {
            $(this).toggleClass('box-online-hover');
        }
    });

    $('.second').click(function () {
        $(this).toggleClass('active-server');
        $(this).toggleClass('box-online-hover');
        $('.text-online2').toggleClass('not-active');
        $('.desc-content2').toggleClass('not-active');
    });
    $('.second').hover(function () {
        if(!$(this).hasClass('active-server')) {
            $(this).toggleClass('box-online-hover');
        }
    });
});