@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                start_credit: 100,      //Starting credits value
                start_bet: 10,          //Base starting bet. Will increment with multiplier in game
                max_multiplier: 5,      //Max multiplier value

                bank_cash : 100,       //Starting credits owned by the bank. When a player win, founds will be subtract from here. When a player lose or bet, founds will be added here. If bank is 0, players always lose, in order to fill the bank.

                prize: [0,20,100,50,0,10],  //THE AMOUNT WON BY THE PLAYER;
                prize_probability: [10,8,1,4,10,10], //THE OCCURENCY WIN OF THAT PRIZE. THE RATIO IS CALCULATED BY THE FORMULA: (single win occurrence/sum of all occurrence). For instance, in this case, prize 100 have 1/43 chance. Prize 50 have 4/43 chance.

                show_credits:true,          //SET THIS VALUE TO FALSE IF YOU DON'T WANT TO SHOW CREDITS BUTTON
                fullscreen:true,            //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES

                //////////////////////////////////////////////////////////////////////////////////////////
                ad_show_counter: 5     //NUMBER OF BALL PLAYED BEFORE AD SHOWN
                //
                //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421?s_phrase=&s_rank=27 ///////////

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
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("restart_level", function(evt, iLevel) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeRestartLevel({level:iLevel});
                }
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
            }else{ sizeHandler(); }

        });

    </script>

    <div class="check-fonts">
        <p class="check-font-1">impact</p>
    </div>


    <canvas id="canvas" class='ani_hack' width="1280" height="1920"> </canvas>
    <div data-orientation="portrait" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection