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
                    'CLang.js',
                    'CPreloader.js',
                    'CMain.js',
                    'CTextButton.js',
                    'CGfxButton.js',
                    'CGuiButton.js',
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
                    'CWinDisplay.js',
                    'CHistory.js',
                    'CHistoryRow.js',
                    'CMsgBox.js',
                ]])
@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));



            $(oMain).on("recharge", function(evt) {
                alert("recharge");
            });

            $(oMain).on("start_session", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeStartSession();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("end_session", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeEndSession();
                }

                closeGameSession();
            });


            $(oMain).on("save_score", function(evt,iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iMoney});
                }
                //...ADD YOUR CODE HERE EVENTUALLY
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
    <canvas id="canvas" class='ani_hack' width="1700" height="768"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection