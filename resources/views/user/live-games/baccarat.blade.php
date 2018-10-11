@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                win_occurrence: 40,          //WIN OCCURRENCE PERCENTAGE. VALUES BETWEEN 0-100
                bet_occurrence:[             //IF PLAYER MUST WIN CURRENT HAND AND THERE ARE MULTIPLE BETS:
                    //WARNING: DON'T SET ANY OF THESE VALUES AT 100.
                    20,          //OCCURRENCE FOR TIE BET
                    30,          //OCCURRENCE FOR BANKER BET
                    50           //OCCURRENCE FOR PLAYER BET
                ],
                min_bet: 0.1,                //MIN BET PLAYABLE BY USER. DEFAULT IS 0.1$
                max_bet: 300,                //MAX BET PLAYABLE BY USER.
                multiplier:[                 //MULTIPLIER FOR EACH BET
                    8,               //MULTIPLIER FOR TIE: PAYS 8 TO 1
                    1.95,            //MULTIPLIER FOR BANKER: PAYS 1.95 TO 1
                    2                //MULTIPLIER FOR PLAYER: PAYS 2 TO 1
                ],
                money: 100,                  //STARING CREDIT FOR THE USER
                game_cash: 1500,             //GAME CASH AVAILABLE WHEN GAME STARTS
                time_show_hand: 2500,        //TIME (IN MILLISECONDS) SHOWING LAST HAND
                fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
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