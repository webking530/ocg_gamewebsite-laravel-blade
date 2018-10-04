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
    var $ticketsContainer = $('.lottery-tickets-container');

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
                $this.removeClass('available');
                $this.find('input').prop('checked', true);

                totalPrice += ticketPrice;
            } else {
                $this.removeClass('active');
                $this.addClass('available');
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
            $.each($('.numbers.available'), function(k, number) {
                var ticketId = $(number).data('ticket-id');

                if (tickets.indexOf(ticketId) !== -1) {
                    $(number).addClass('reserved');
                    $(number).removeClass('available');
                } else {
                    $(number).removeClass('reserved');
                    $(number).addClass('available');
                }

                $(number).find('input').prop('checked', false);
            });
        });
    }, 1000);

    $('#pickRandom').on('click', function() {
        var $availableNumbers = $('.numbers.available');
        var totalTickets = $availableNumbers.length;
        var random = Math.floor(Math.random() * totalTickets) + 1;

        $('html, body').stop().animate({
            scrollTop: $ticketsContainer.offset().top - 120
        }, 500, function() {
            $ticketsContainer.stop().animate({scrollTop: 0}, 0, function() {
                $.each($availableNumbers, function(k, number) {
                    if (k === random) {
                        $(number).trigger('click');

                        $ticketsContainer.stop().animate({scrollTop: $(number).position().top}, function() {
                            $(number).animate({ 'zoom': 1.05 }, 400, function() {
                                $(number).animate({ 'zoom': 1 }, 400);
                            });
                        });

                        return false;
                    }
                });
            });
        });




    });
});