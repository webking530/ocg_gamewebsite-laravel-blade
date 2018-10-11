@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                money: 1000,      //STARING CREDIT FOR THE USER
                min_bet: 0.1,     //MINIMUM BET
                max_bet: 1000,     //MAXIMUM BET
                time_bet: 0,  //TIME TO WAIT FOR A BET IN MILLISECONDS. SET 0 IF YOU DON'T WANT BET LIMIT
                time_winner: 3000, //TIME FOR WINNER SHOWING IN MILLISECONDS
                win_occurrence: 30, //Win occurrence percentage (100 = always win).
                                    //SET THIS VALUE TO -1 IF YOU WANT WIN OCCURRENCE STRICTLY RELATED TO PLAYER BET ( SEE DOCUMENTATION)
                casino_cash:4000,    //The starting casino cash that is recharged by the money lost by the user
                fullscreen:true,     //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true, //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                show_credits:true,           //SET THIS VALUE TO FALSE IF YOU DON'T TO SHOW CREDITS BUTTON
                num_hand_before_ads:10  //NUMBER OF HANDS TO COMPLETE, BEFORE TRIGGERING SAVE_SCORE EVENT. USEFUL FOR INTER-LEVEL AD EVENTUALLY.
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

            $(oMain).on("bet_placed", function (evt, iTotBet) {
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function(evt,iMoney,iWin) {
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

            $(oMain).on("share_event", function(evt,iMoney) {
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
        <p class="check-font-1">test 1</p>
        <p class="check-font-2">test 2</p>
    </div>

    <canvas id="canvas" class='ani_hack' width="750" height="600"> </canvas>
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection