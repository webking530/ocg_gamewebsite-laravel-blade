Number.prototype.pad = function(size) {
    var s = String(this);
    while (s.length < (size || 2)) {s = "0" + s;}
    return s;
};

function showNotifier(type, content) {
    var $notifier = $('#'+type+'-notifier');

    $notifier.find('.notifier-text-content').html(content);
    $notifier.fadeIn(1500);

    setTimeout(function() {
        $notifier.fadeOut(1500);
    }, 3000);
}

$(document).ready(function() {
    if ($('.custom-scroll').length > 0) {
        const ps = new PerfectScrollbar('.custom-scroll');
    }

    $('[data-toggle="tooltip"]').tooltip({html:true});

    $('#flash-notifier, #validation-errors').fadeIn(1500);

    $('.confirm-submit').on('submit', function(ev) {
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

    $('.confirm-click').on('click', function(ev) {
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
});