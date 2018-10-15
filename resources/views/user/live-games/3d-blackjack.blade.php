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
                    'CHandController.js',
                    'CCard.js',
                    'CInsurancePanel.js',
                    'CGameOver.js',
                    'CMsgBox.js',
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
<script>
    $(document).ready(function(){
        var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));

        $(oMain).on("recharge", function(evt) {
            redirectOnRecharge();
        });

        $(oMain).on("bet_placed", function (evt, iTotBet) {
            //...ADD YOUR CODE HERE EVENTUALLY
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


        $(oMain).on("save_score", function(evt,iScore) {
            if(getParamValue('ctl-arcade') === "true"){
                parent.__ctlArcadeSaveScore({score:iScore});
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

<div class="check-fonts">
    <p class="check-font-1">test 1</p>
</div>

<canvas id="canvas" class='ani_hack' width="1700" height="768"> </canvas>
<div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection