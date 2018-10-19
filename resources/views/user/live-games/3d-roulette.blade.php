@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-3.2.1.min.js',
                    'createjs-2015.11.26.min.js',
                    'howler.min.js',
                    'screenfull.js',
                    'ctl_utils.js',
                    'sprite_lib.js',
                    'settings.js',
                    'CRouletteSettings.js',
                    'CFichesController.js',
                    'CLang.js',
                    'CPreloader.js',
                    'CMain.js',
                    'CTextButton.js',
                    'CGfxButton.js',
                    'CFicheBut.js',
                    'CBetTableButton.js',
                    'CBetTextButton.js',
                    'CToggle.js',
                    'CMenu.js',
                    'CGame.js',
                    'CInterface.js',
                    'CMsgBox.js',
                    'CTweenController.js',
                    'CSeat.js',
                    'CTableController.js',
                    'CEnlight.js',
                    'CWheelTopAnim.js',
                    'CFiche.js',
                    'CHistoryRow.js',
                    'CWheelAnim.js',
                    'CFinalBetPanel.js',
                    'CNeighborsPanel.js',
                    'CGameOver.js',
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    min_bet: MIN_BET,
                    max_bet: MAX_BET,
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

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function(evt,iMoney,iWin) {
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

            $(oMain).on("share_event", function(evt,iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({ img:"200x200.jpg",
                        title:TEXT_CONGRATULATIONS,
                        msg:TEXT_SHARE_1 + iMoney + TEXT_SHARE_2,
                        msg_share:TEXT_SHARE_3 + iMoney + TEXT_SHARE_4
                    });
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

    <div class="check-fonts">
        <p class="check-font-1">test 1</p>
        <p class="check-font-2">test 2</p>
    </div>

    <canvas id="canvas" class='ani_hack' width="750" height="600"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection