@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                win_occurrence: 40,          //WIN OCCURRENCE PERCENTAGE. VALUES BETWEEN 0-100
                min_bet: 1,                //MIN BET PLAYABLE BY USER. DEFAULT IS 0.1$
                max_bet: 300,                //MAX BET PLAYABLE BY USER.
                money: 100,                  //STARING CREDIT FOR THE USER
                game_cash: 100,             //GAME CASH AVAILABLE WHEN GAME STARTS
                time_show_hand: 1500,          //TIME (IN MILLISECONDS) SHOWING LAST HAND
                fullscreen:true,               //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                show_credits:true,                     //ENABLE/DISABLE CREDITS BUTTON IN THE MAIN SCREEN
                //////////////////////////////////////////////////////////////////////////////////////////
                ad_show_counter: 10           //NUMBER OF HANDS PLAYED BEFORE AD SHOWN
                //
                //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
            });



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
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
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