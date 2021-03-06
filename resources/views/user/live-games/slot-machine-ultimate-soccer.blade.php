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
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    win_occurrence: WIN_OCCURRENCE,
                    min_reel_loop: MIN_REEL_LOOPS,
                    reel_delay: REEL_DELAY,
                    paytable_symbol_1: PAYTABLE_VALUES[0],
                    paytable_symbol_2: PAYTABLE_VALUES[1],
                    paytable_symbol_3: PAYTABLE_VALUES[2],
                    paytable_symbol_4: PAYTABLE_VALUES[3],
                    paytable_symbol_5: PAYTABLE_VALUES[4],
                    paytable_symbol_6: PAYTABLE_VALUES[5]
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

            $(oMain).on("share_event", function(evt, iScore) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({
                        img: TEXT_SHARE_IMAGE,
                        title: TEXT_SHARE_TITLE,
                        msg: TEXT_SHARE_MSG1 + iScore+ TEXT_SHARE_MSG2,
                        msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1});
                }
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