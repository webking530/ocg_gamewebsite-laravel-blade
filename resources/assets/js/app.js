$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({html:true});

    $('#flash-notifier').fadeIn(1500);

    $('.confirm-click').on('click', function(ev) {
        ev.preventDefault();
        var route = $(this).attr('href');

        $.confirm({
            title: confirmTitle,
            content: confirmContent,
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