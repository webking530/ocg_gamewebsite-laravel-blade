@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({

                win_occurrence: 40, //Win occurrence percentage (100 = always win)

                starting_money: 100, //STARING CREDIT FOR THE USER
                starting_cash:500,   //GAME CASH AVAILABLE WHEN GAME STARTS
                fiches_value: [ 1,  //Value of first fiche
                    5,  //Value of second fiche
                    10, //Value of third fiche
                    25, //Value of fourth fiche
                    100 //Value of fifth fiche
                ],

                turn_card_speed: 400, //Time speed to completely turn a card (in ms)
                showtext_timespeed: 3500, // Time speed duration of win/lose text (in ms)
                show_credits:false, //SET THIS VALUE TO FALSE IF YOU DON'T TO SHOW CREDITS BUTTON
                fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                //////////////////////////////////////////////////////////////////////////////////////////
                ad_show_counter: 10     //NUMBER OF TURNS PLAYED BEFORE AD SHOWN
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