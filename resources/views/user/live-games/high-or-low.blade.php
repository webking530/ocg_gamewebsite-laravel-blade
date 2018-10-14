@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-2.0.3.min.js',
                    'createjs-2015.11.26.min.js',
                    'howler.min.js',
                    'ctl_utils.js',
                    'sprite_lib.js',
                    'settings.js',
                    'CLang.js',
                    'CPreloader.js',
                    'CMain.js',
                    'CTextButton.js',
                    'CToggle.js',
                    'CGfxButton.js',
                    'CMenu.js',
                    'CGame.js',
                    'CInterface.js',
                    'CHelpPanel.js',
                    'CEndPanel.js',
                    'CCard.js',
                    'CGameSettings.js',
                    'CFichesController.js',
                    'CWinText.js',
                    'CGiveupPanel.js',
                    'CCreditsPanel.js',
                ]])
@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));


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

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function(evt,iScore, szMode) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iScore, mode: szMode});
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("start_level", function(evt, iLevel) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeStartLevel({level:iLevel});
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("end_level", function(evt,iLevel) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeEndLevel({level:iLevel});
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("show_interlevel_ad", function(evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShowInterlevelAD();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("share_event", function(evt, iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({   img: TEXT_SHARE_IMAGE,
                        title: TEXT_SHARE_TITLE,
                        msg: TEXT_SHARE_MSG1 + iMoney + TEXT_SHARE_MSG2,
                        msg_share: TEXT_SHARE_SHARE1 + iMoney + TEXT_SHARE_SHARE1});
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
    <canvas id="canvas" class='ani_hack' width="1600" height="768"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection