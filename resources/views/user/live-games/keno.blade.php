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
                    'CTextToggle.js',
                    'CToggle.js',
                    'CNumToggle.js',
                    'CGfxButton.js',
                    'CMenu.js',
                    'CGame.js',
                    'CInterface.js',
                    'CEndPanel.js',
                    'CPayouts.js',
                    'CAnimBalls.js',
                    'CCreditsPanel.js',
                    'CDisplayPanel.js',
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

            $(oMain).on("bet_placed", function (evt, oBetInfo) {
                var iTotBet = oBetInfo.tot_bet;
                var iMoney = oBetInfo.money;
                var iNumSelected = oBetInfo.num_selected;
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

            $(oMain).on("share_event", function(evt, iMoney) {
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
        <p class="check-font-1">Lora</p>
    </div>

    <canvas id="canvas" class='ani_hack' width="1920" height="1080"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection