function updateReservationClock(reservationTime) {
    if (reservationTime.seconds <= 0) {
        window.location.reload();
        return;
    }

    reservationTime.seconds -= 1;

    var mins = Math.floor(reservationTime.seconds / 60);
    var secs = reservationTime.seconds % 60;

    $('#clock-reservation').html(mins.pad(2) + ':' + secs.pad(2));
}

$(document).ready(function() {
    var $totalPriceElem = $('#totalPrice');
    var $buyButton = $('#buyBtn');
    var reserveRoute = $('[data-reserve-route]').data('reserve-route');
    var checkTicketsRoute = $('[data-check-route]').data('check-route');
    var ticketPrice = parseInt($('[data-ticket-price]').data('ticket-price'));

    var totalPrice = 0;

    var reservationTimeMinutes = TICKET_RESERVATION_TIME_MINUTES;
    var reservationTime = { seconds: reservationTimeMinutes * 60 };

    $('.numbers').on('click', function() {
        var $this = $(this);

        if ($this.hasClass('reserved')) {
            return;
        }

        var action = $this.find('input').prop('checked') ? 'remove_reserve' : 'add_reserve';

        var data = {
            ticket_id: $this.find('input').val(),
            action: action
        };

        $.get(reserveRoute, data, function(response) {
            if (response.status === false) {
                showNotifier('danger', response.msg);
                return;
            }

            if (action === 'add_reserve') {
                $this.addClass('active');
                $this.find('input').prop('checked', true);

                totalPrice += ticketPrice;
            } else {
                $this.removeClass('active');
                $this.find('input').prop('checked', false);

                totalPrice -= ticketPrice;
            }

            $buyButton.prop('disabled', totalPrice === 0);
            $totalPriceElem.html(totalPrice);
        });
    });

    setInterval(function() {
        updateReservationClock(reservationTime);

        $.get(checkTicketsRoute, null, function(tickets) {
            $.each($('.numbers'), function(k, number) {
                if ($(number).hasClass('active')) {
                    return true;
                }

                var ticketId = $(number).data('ticket-id');

                if (tickets.indexOf(ticketId) !== -1) {
                    $(number).addClass('reserved');
                } else {
                    $(number).removeClass('reserved');
                }

                $(number).find('input').prop('checked', false);
            });
        });
    }, 1000);
});