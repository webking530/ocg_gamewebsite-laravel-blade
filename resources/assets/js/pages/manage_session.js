$(document).ready(function() {
    let $inputMoney = $('#inputMoney');
    let rate = parseFloat($inputMoney.data('rate'));

    $('.deposit-coins').on('keyup', function() {
        let coins = $(this).val().trim();

        if (coins.length === 0) {
            coins = 0;
        }

        let amount = parseFloat(coins) * rate;

        $inputMoney.show();
        $inputMoney.find('span').html(amount.toFixed(2));
    });
});