$(document).ready(function() {
    $('.btn-filter').on('click', function() {
        $('.btn-filter').removeClass('btn-filter-active');
        $(this).addClass('btn-filter-active');

        let $allGames = $('li[data-group]');
        let group = parseInt($(this).data('group'));
        let showPopulars = $(this).data('group') === 'popular';
        let $jackpotBoard = $('.jackpot-board');

        if ($(this).data('show-board') === 1) {
            $jackpotBoard.slideDown(300);
        } else {
            $jackpotBoard.slideUp(300);
        }

        if (group === -1) {
            $allGames.show();
            return;
        }

        $allGames.hide();

        if (showPopulars) {
            $('li[data-popular]').show();
        } else {
            $('li[data-group="'+group+'"]').show();
        }

    });
});