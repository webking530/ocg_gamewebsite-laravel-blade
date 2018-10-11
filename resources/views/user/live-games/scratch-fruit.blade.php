@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({

                fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                show_credits:false,          //SET THIS VALUE TO FALSE IF YOU DON'T WANT TO SHOW CREDITS BUTTON

                bet_to_play:[1,2,3],   //BET TO PLAY A GAME
                player_credit:10, //PLAYER'S CREDIT

                cash_credit: 1000, //TOTAL CREDIT IN CASH. PLAYER BET WILL INCREASE THE CASH, AND PLAYER WIN WILL DECREASE THE CASH.
                ///A PLAYER WILL NEVER WIN MORE THEN CURRENT CASH.

                //// PRIZE WIN BY THE PLAYER. THE PRIZE IS MULTIPLIED BY THE BET PLAYED
                prize:[ 1.00,     //PRIZE FOR COMBO 1
                    2.50,     //PRIZE FOR COMBO 2
                    5.00,     //PRIZE FOR COMBO 2
                    15.00,    //PRIZE FOR COMBO 3
                    40.00,    //PRIZE FOR COMBO 4
                    90.00,   //PRIZE FOR COMBO 5
                    170.00,   //PRIZE FOR COMBO 6
                    400.00,  //PRIZE FOR COMBO 7
                    1000.00], //PRIZE FOR COMBO 8

                prizeprob:[ 30,   //OCCURENCE PERCENTAGE FOR PRIZE 1
                    22,   //OCCURENCE PERCENTAGE FOR PRIZE 2
                    17,   //OCCURENCE PERCENTAGE FOR PRIZE 3
                    10,   //OCCURENCE PERCENTAGE FOR PRIZE 4
                    8,    //OCCURENCE PERCENTAGE FOR PRIZE 5
                    6,    //OCCURENCE PERCENTAGE FOR PRIZE 6
                    4,    //OCCURENCE PERCENTAGE FOR PRIZE 7
                    2,    //OCCURENCE PERCENTAGE FOR PRIZE 8
                    1],    //OCCURENCE PERCENTAGE FOR PRIZE 9

                win_occurrence: 30,

                //winpercentage MANAGES MULTIPLE WIN OCCURENCE PERCENTAGE FOR EACH GAME
                multiple_win_percentage:
                    [
                        70,  //WIN IN 1 ROW
                        25,  //WIN IN 2 ROWS
                        5    //WIN IN 3 ROWS
                    ],

                scratch_tolerance_per_cell : 50, //AREA PERCENTAGE TO SCRATCH (FOR EACH SYMBOL) TO SHOW FINAL RESULT IN THE FRUIT ROW

                //////////////////////////////////////////////////////////////////////////////////////////
                ad_show_counter: 5     //NUMBER OF CARDS PLAYED BEFORE AD SHOWN
                //
                //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421///////////


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