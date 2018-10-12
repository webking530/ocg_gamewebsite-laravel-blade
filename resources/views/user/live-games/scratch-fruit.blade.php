@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('scripts')
    @include('user.live-games.partials.scripts', ['scripts' => [
                    'jquery-3.2.1.min.js',
                    'createjs.min.js',
                    'howler.min.js',
                    'screenfull.js',
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
                    'CVector2.js',
                    'CInterface.js',
                    'CHelpPanel.js',
                    'CEndPanel.js',
                    'CRow.js',
                    'CShowResult.js',
                    'CTextToggle.js',
                    'CCreditsPanel.js',
                    'CAreYouSurePanel.js',
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
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
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

    <canvas id="clear-image" width="342" height="342" style="display:none;position:absolute;"></canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection