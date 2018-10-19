@extends('user.live-games.layout.layout')

@section('head')
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-3.2.1.min.js',
                    'createjs.min.js',
                    'screenfull.js',
                    'howler.min.js',
                    'ctl_utils.js',
                    'sprite_lib.js',
                    'settings.js',
                    'CLang.js',
                    'CPreloader.js',
                    'CMain.js',
                    'CTextButton.js',
                    'CGfxButton.js',
                    'CToggle.js',
                    'CMenu.js',
                    'CGame.js',
                    'CInterface.js',
                    'CGameSettings.js',
                    'CCard.js',
                    'CGameOver.js',
                    'CPayTable.js',
                    'CPayTableSettings.js',
                    'CHandEvaluator.js',
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    bets: BET_TYPE,
                    combo_prizes: COMBO_PRIZES,
                    win_occurrence: WIN_OCCURRENCE
                };
            }, 1000);
        }

        $(document).ready(function(){
            var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));

            $(oMain).on("recharge", function(evt) {
                redirectOnRecharge();
            });

            $(oMain).on("start_session", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeStartSession();
                }

                refreshSettings();
            });

            $(oMain).on("end_session", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeEndSession();
                }

                closeGameSession();
            });

            $(oMain).on("bet_placed", function (evt, iBet) {

                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function(evt,iScore) {

                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iScore});
                }

                registerResult(iScore);
            });

            $(oMain).on("show_interlevel_ad", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShowInterlevelAD();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("share_event", function(evt,iScore) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({ img:"200x200.jpg",
                        title:TEXT_CONGRATULATIONS,
                        msg:TEXT_SHARE_1 + iScore + TEXT_SHARE_2,
                        msg_share:TEXT_SHARE_3 + iScore + TEXT_SHARE_4
                    });
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            if (isIOS()) {
                setTimeout(function () {
                    sizeHandler();
                }, 200);
            } else {
                sizeHandler();
            }


        });

    </script>

    <div class="check-fonts">
        <p class="check-font-1">test 1</p>
        <p class="check-font-2">test 2</p>
    </div>


    <canvas id="canvas" class='ani_hack' width="1920" height="768"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection