@extends('user.live-games.layout.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset("live-games/{$game->slug}/css/ios_fullscreen.css") }}" type="text/css">
@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-3.1.1.min.js',
                    'createjs-2015.11.26.min.js',
                    'howler.min.js',
                    'screenfull.js',
                    'platform.js',
                    'ios_fullscreen.js',
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
                    'CTweenController.js',
                    'CSeat.js',
                    'CFichesController.js',
                    'CVector2.js',
                    'CGameSettings.js',
                    'CEasing.js',
                    'CCard.js',
                    'CGameOver.js',
                    'CMsgBox.js',
                    'CHandEvaluator.js',
                    'CAnimText.js',
                    'CPaytablePanel.js',
                    'CHelpCursor.js',
                    'CCreditsPanel.js',
                    'CAreYouSurePanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    min_bet: MIN_BET,
                    max_bet: MAX_BET,
                    multiplier: MULTIPLIERS,
                    blackjack_payout: BLACKJACK_PAYOUT,
                    win_occurrence: WIN_OCCURRENCE,
                    bet_occurrence: BET_OCCURRENCE,
                    ante_payout: PAYOUT_ANTE,
                    plus_payouts: PAYOUT_PLUS
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

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function(evt,iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iMoney});
                }

                registerResult(iMoney);
            });

            $(oMain).on("show_interlevel_ad", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShowInterlevelAD();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("share_event", function(evt, iScore) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({   img: TEXT_SHARE_IMAGE,
                        title: TEXT_SHARE_TITLE,
                        msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
                        msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1});
                }
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

    <canvas id="canvas" class='ani_hack' width="1700" height="768"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection