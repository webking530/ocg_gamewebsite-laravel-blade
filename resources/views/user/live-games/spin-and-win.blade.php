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
                    'CFormatText.js',
                    'CInterface.js',
                    'CHelpPanel.js',
                    'CEndPanel.js',
                    'CWheel.js',
                    'CReel.js',
                    'CLeds.js',
                    'CCircularList.js',
                    'CComplexFrame.js',
                    'CLoadingPanel.js',
                    'CCreditsPanel.js',
                    'CAreYouSurePanel.js',
                ]])
@endsection

@section('game')
    <script>
        function refreshSettings() {
            setInterval(function() {
                gameSettings = {
                    max_multiplier: MAX_MULTIPLIER,
                    money_wheel_settings: MONEY_WHEEL_SETTINGS,
                    instant_win_wheel_settings: INSTANT_WHEEL_SETTINGS
                };
            }, 1000);
        }

        $(document).ready(function(){
            var oMain = new CMain(JSON.parse('{!! $game->getDynamicSettings() !!}'));


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

            $(oMain).on("share_event", function(evt, iScore) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({   img: TEXT_SHARE_IMAGE,
                        title: TEXT_SHARE_TITLE,
                        msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
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
    <div class="check-fonts">
        <p class="check-font-1">impact</p>
        <p class="check-font-2">comfortaa-bold</p>
    </div>
    <canvas id="canvas" class='ani_hack' width="768" height="1280"> </canvas>
    <div data-orientation="portrait" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection