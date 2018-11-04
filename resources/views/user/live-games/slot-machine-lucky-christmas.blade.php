@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-2.0.3.min.js',
                    'createjs-2013.12.12.min.js',
                    'ctl_utils.js',
                    'sprite_lib.js',
                    'settings.js',
                    'CSlotSettings.js',
                    'CLang.js',
                    'CPreloader.js',
                    'CMain.js',
                    'CTextButton.js',
                    'CGfxButton.js',
                    'CToggle.js',
                    'CBetBut.js',
                    'CMenu.js',
                    'CGame.js',
                    'CReelColumn.js',
                    'CInterface.js',
                    'CPayTablePanel.js',
                    'CStaticSymbolCell.js',
                    'CTweenController.js',
                    'CBonusPanel.js',
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    win_occurrence: WIN_OCCURRENCE,
                    bonus_occurrence: BONUS_OCCURRENCE,
                    min_reel_loop: MIN_REEL_LOOPS,
                    reel_delay: REEL_DELAY,
                    min_bet: MIN_BET,
                    max_bet: MAX_BET,
                    max_hold: MAX_NUM_HOLD,
                    perc_win_bonus_prize_1: PERC_WIN_BONUS_PRIZE_1,
                    perc_win_bonus_prize_2: PERC_WIN_BONUS_PRIZE_2,
                    perc_win_bonus_prize_3: PERC_WIN_BONUS_PRIZE_3,
                    paytable_symbol_1: PAYTABLE_VALUES[0],
                    paytable_symbol_2: PAYTABLE_VALUES[1],
                    paytable_symbol_3: PAYTABLE_VALUES[2],
                    paytable_symbol_4: PAYTABLE_VALUES[3],
                    paytable_symbol_5: PAYTABLE_VALUES[4],
                    paytable_symbol_6: PAYTABLE_VALUES[5],
                    paytable_symbol_7: PAYTABLE_VALUES[6]
                };
            }, 1000);
        }

        $(document).ready(function(){
            var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));

            $(oMain).on("start_session", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeStartSession();
                }

                refreshSettings();
            });

            $(oMain).on("end_session", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeEndSession();
                }

                closeGameSession();
            });

            $(oMain).on("bet_placed", function (evt, oBetInfo) {
                var iBet = oBetInfo.bet;
                var iTotBet = oBetInfo.tot_bet;
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function (evt, iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iMoney});
                }

                registerResult(iMoney);
            });

            $(oMain).on("show_interlevel_ad", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShowInterlevelAD();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("share_event", function (evt, oData) {
                trace(oData);
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent(oData);
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            if(isIOS()){
                setTimeout(function(){sizeHandler();},200);
            }else{
                sizeHandler();
            }
        });

    </script>
    <canvas id="canvas" class='ani_hack' width="1500" height="640"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection