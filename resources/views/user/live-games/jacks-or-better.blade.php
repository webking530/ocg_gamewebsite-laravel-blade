@extends('user.live-games.layout.layout')

@section('head')
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                win_occurrence: 40,                    //WIN OCCURRENCE PERCENTAGE
                game_cash: 100,                        //MONEY IN GAME CASH. IF THE GAME DOESN'T HAVE ENOUGHT MONEY, THE PLAYER MUST LOSE.
                bets: [0.2,0.3,0.5,1,2,3,5],           //ALL THE AVAILABLE BETS FOR THE PLAYER
                combo_prizes: [250,50,25,9,6,4,3,2,1], //WINS FOR FIRST COLUMN
                money: 100,                            //STARING CREDIT FOR THE USER
                recharge:true,                         //RECHARGE WHEN MONEY IS ZERO. SET THIS TO FALSE TO AVOID AUTOMATIC RECHARGE
                fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                show_credits:false,                     //ENABLE/DISABLE CREDITS BUTTON IN THE MAIN SCREEN
                num_hand_before_ads:10     //NUMBER OF HANDS PLAYED BEFORE AD SHOWN
                //
                //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
            });

            $(oMain).on("recharge", function(evt) {
                //alert("recharge");
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

            $(oMain).on("bet_placed", function (evt, iBet) {

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

            $(oMain).on("share_event", function(evt,iScore) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent({ img:"200x200.jpg",
                        title:TEXT_CONGRATULATIONS,
                        msg:TEXT_SHARE_1 + iScore + TEXT_SHARE_2,
                        msg_share:TEXT_SHARE_3 + iScore + TEXT_SHARE_4
                    });
                }
                //...ADD YOUR CODE HERE EVENTUALLY
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


    <canvas id="canvas" class='ani_hack' width="1920" height="768"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection