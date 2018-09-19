$(document).ready(function() {
    setInterval(function() {
        $.each($('.lottery-tab'), function(k, obj) {
            let lotteryId = $(obj).data('lottery-id');

            if (parseInt(lotteryId) === 0) {
                return true;
            }

            let route = $(obj).data('route');
            let statusChanged = $(obj).data('status-changed');
            let status = $(obj).data('status');

            if (statusChanged === 'yes') {
                return true;
            }

            let data = {
                lottery_id: lotteryId,
                status: status
            };

            $.get(route, data, function (response) {
                if (response.status_updated) {
                    $(obj).data('status-changed', 'yes');
                    $(obj).data('status', response.status);

                    $(obj).html(response.html);
                }
            });
        });
    }, 1000);

    setInterval(function() {
        $.each($('.pending-container'), function (k, obj) {
            let lotteryId = $(obj).find('.countdown').data('lottery-id');
            let route = $(obj).find('.countdown').data('route');

            let data = {
                lottery_id: lotteryId
            };

            $.get(route, data, function(response) {
                if (response.started) {
                    $('.about-to-start-text').hide();
                }

                $(obj).find('.countdown').html(response.text);
            });
        });
    }, 1000);


});