Number.prototype.pad = function (size) {
    var s = String(this);
    while (s.length < (size || 2)) {
        s = "0" + s;
    }
    return s;
};

function showNotifier(type, content) {
    var $notifier = $('#' + type + '-notifier');

    $notifier.find('.notifier-text-content').html(content);
    $notifier.fadeIn(1500);

    setTimeout(function () {
        $notifier.fadeOut(1500);
    }, 3000);
}

function googleSignOut(redirectUrl) {
    // var googleLogoutRoute = $('[data-google-logout-route]').data('google-logout-route');
    gapi.load('auth2', function () {
        gapi.auth2.init().then(function () {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                window.location.href = redirectUrl;
            });
        });
    });
}

function getNewsId() {
    let news = Array();

    $.each($('[data-news-id]'), function (key, obj) {
        news.push(parseInt($(obj).data('news-id')));
    });

    return news;
}

$(document).ready(function () {
    $('.datepicker').datetimepicker({format: 'yyyy-mm-dd', minView: 2, maxView: 4});

    if ($('.custom-scroll').length > 0) {
        const ps = new PerfectScrollbar('.custom-scroll');
    }

    $('[data-toggle="tooltip"]').tooltip({html: true});

    $('#flash-notifier, #validation-errors').fadeIn(1500);

//    $('.confirm-submit').on('submit', function (ev) {
    $(document).on('click', '.confirm-submit', function (ev) {

        ev.preventDefault();
        var $form = $(this);

        $.confirm({
            title: confirmTitle,
            content: $form.data('confirm-content') === undefined ? confirmContent : $form.data('confirm-content'),
            theme: 'material',
            type: 'blue',
            icon: 'fas fa-info-circle',
            closeIcon: true,
            closeIconClass: 'fas fa-times',
            buttons: {
                confirm: {
                    text: confirmYes,
                    action: function () {
                        $form.unbind('submit');
                        $form.submit();
                    }
                },
                cancel: {
                    text: confirmNo
                },
            }
        });
    });

    $(document).on('click', '.confirm-click', function (ev) {
        ev.preventDefault();
        var route = $(this).attr('href');
        var $button = $(this);

        $.confirm({
            title: confirmTitle,
            content: $button.data('confirm-content') === undefined ? confirmContent : $button.data('confirm-content'),
            theme: 'material',
            type: 'blue',
            icon: 'fas fa-info-circle',
            closeIcon: true,
            closeIconClass: 'fas fa-times',
            buttons: {
                confirm: {
                    text: confirmYes,
                    action: function () {
                        window.location.href = route;
                    }
                },
                cancel: {
                    text: confirmNo
                },
            }
        });
    });

    $('[data-social-login]').on('click', function (ev) {
        ev.preventDefault();

        var socialType = $(this).data('social-login');
        var redirectUrl = $(this).attr('href');

        if (socialType === 'google') {
            googleSignOut(redirectUrl);
        }
    });
    $('.filterBtn').on('click', function (ev) {
        $(".searchFilterDiv").toggleClass("hidden");
    });

    $('#news-bubble').on('click', function() {
        let newsList = $(this).find('.news-list');

        if (newsList.css('display') === 'none') {
            $.post($(this).data('set-cookie-route'), {news: getNewsId()});
            newsList.slideDown(300);
        } else {
            newsList.slideUp(300);
        }
    });

    setInterval(function() {
        let $newsNotification = $('.news-notification');

        $.get($('#news-bubble').data('count-news-route'), {news: getNewsId()}, function(unreadNewsCount) {
            if (unreadNewsCount > 0) {
                $newsNotification.html(unreadNewsCount);
                $newsNotification.show();
            } else {
                $newsNotification.html(0);
                $newsNotification.hide();
            }
        })
    }, 5000);
});