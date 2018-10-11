@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                win_occurrence:30,        //WIN PERCENTAGE.SET A VALUE FROM 0 TO 100.
                slot_cash: 100,          //THIS IS THE CURRENT SLOT CASH AMOUNT. THE GAME CHECKS IF THERE IS AVAILABLE CASH FOR WINNINGS.
                bonus_occurrence:15,      //SET BONUS OCCURRENCE PERCENTAGE IF PLAYER GET A WIN. SET A VALUE FROM 0 TO 100. (IF 100%, PLAYER GET A BONUS EVERYTIME THERE IS A WIN).
                min_reel_loop:1,          //NUMBER OF REEL LOOPS BEFORE SLOT STOPS
                reel_delay: 0,            //NUMBER OF FRAMES TO DELAY THE REELS THAT START AFTER THE FIRST ONE
                time_show_win:2000,       //DURATION IN MILLISECONDS OF THE WINNING COMBO SHOWING
                time_show_all_wins: 2000, //DURATION IN MILLISECONDS OF ALL WINNING COMBO
                money:100,               //STARING CREDIT FOR THE USER
                min_bet:0.05,             //MINIMUM COIN FOR BET
                max_bet: 0.5,             //MAXIMUM COIN FOR BET
                max_hold:3,               //MAXIMUM NUMBER OF POSSIBLE HOLD ON REELS
                bonus_prize_for_3_symbol: [5,50,100],     //LIST OF MULTIPLIER IF 3 BONUS ITEM
                bonus_prize_for_4_symbol: [10,100,200],   //LIST OF MULTIPLIER IF 4 BONUS ITEM
                bonus_prize_for_5_symbol: [50,200,500],   //LIST OF MULTIPLIER IF 5 BONUS ITEM
                perc_win_prize_1: 50,       //OCCURENCE PERCENTAGE FOR PRIZE 1 IN BONUS
                perc_win_prize_2: 35,       //OCCURENCE PERCENTAGE FOR PRIZE 2 IN BONUS
                perc_win_prize_3: 15,       //OCCURENCE PERCENTAGE FOR PRIZE 3 IN BONUS
                /***********PAYTABLE********************/
                //EACH SYMBOL PAYTABLE HAS 5 VALUES THAT INDICATES THE MULTIPLIER FOR X1,X2,X3,X4 OR X5 COMBOS
                paytable_symbol_1: [0,0,150,250,500], //PAYTABLE FOR SYMBOL 1
                paytable_symbol_2: [0,0,100,150,200], //PAYTABLE FOR SYMBOL 2
                paytable_symbol_3: [0,0,50,100,150],  //PAYTABLE FOR SYMBOL 3
                paytable_symbol_4: [0,10,25,50,100],  //PAYTABLE FOR SYMBOL 4
                paytable_symbol_5: [0,10,25,50,100],  //PAYTABLE FOR SYMBOL 5
                paytable_symbol_6: [0,5,15,25,50],    //PAYTABLE FOR SYMBOL 6
                paytable_symbol_7: [0,2,10,20,35],    //PAYTABLE FOR SYMBOL 7
                paytable_symbol_8: [0,1,5,10,15],     //PAYTABLE FOR SYMBOL 8
                /*************************************/
                fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                show_credits:false,         //ENABLE/DISABLE CREDITS BUTTON IN THE MAIN SCREEN
                num_spin_ads_showing:10     //NUMBER OF SPIN TO COMPLETE, BEFORE TRIGGERING AD SHOWING.
                //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
            });

            $(oMain).on("start_session", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeStartSession();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("end_session", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeEndSession();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("bet_placed", function (evt, oBetInfo) {
                var iBet = oBetInfo.bet;
                var iTotBet = oBetInfo.tot_bet;
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("save_score", function (evt, iMoney) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeSaveScore({score:iMoney});
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("show_interlevel_ad", function (evt) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShowInterlevelAD();
                }
                //...ADD YOUR CODE HERE EVENTUALLY
            });

            $(oMain).on("share_event", function (evt, oData) {
                if(getParamValue('ctl-arcade') === "true"){
                    parent.__ctlArcadeShareEvent(oData);
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
    <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
@endsection