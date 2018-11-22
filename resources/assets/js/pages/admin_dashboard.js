$(document).ready(function () {
    $('.nav-item').click(function () {


        $("." + $(this).parent('ul').attr('data-type') + " .nav-link").removeClass("active");
        $(this).find('.nav-link').addClass('active');


        $("." + $(this).parent('ul').attr('data-type') + " .tab-pane").removeClass('show active');
        $('#' + $(this).find('.nav-link').attr('data-id')).addClass('active');
    });
});