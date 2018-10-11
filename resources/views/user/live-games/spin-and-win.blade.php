@extends('user.live-games.layout.layout')

@section('head')

@endsection

@section('game')
    <script>
        $(document).ready(function(){
            var oMain = new CMain({
                start_credit: 200,      //Starting credits value
                start_bet: 10,          //Base starting bet. Will increment with multiplier in game
                max_multiplier: 5,      //Max multiplier value

                bank_cash : 4000,       //Starting credits owned by the bank. When a player win, founds will be subtract from here. When a player lose or bet, founds will be added here. If bank is 0, players always lose, in order to fill the bank.

                wheel_spin_time: 12,    //Time (in seconds) of a spin

                //MONEY_WHEEL_SETTINGS sets the values and probability of each prize in the wheel. Value*max_multiplier shouldn't exceed 9999999.
                //      -prize: THE AMOUNT WON BY THE PLAYER; IN CASE OF FREE SPIN, the "prize" MEAN NUM OF FREE SPINS.
                //      -type: POINT IF THE PRIZE IS A MULTI-FREESPINS OR A STANDARD PRIZE
                //      -background: THE BACKGROUND IMAGE NAME IN sprites/money_prize_images FOLDER
                //      -textcolor: THE COLOR OF THE PRIZE TEXT
                //      -textcolorstroke: THE COLOR STROKE OF THE PRIZE TEXT
                //      -win_occurrence: THE OCCURENCY WIN OF THAT PRIZE. THE RATIO IS CALCULATED BY THE FORMULA: (single win occurrence/sum of all occurrence). For instance, the 1000 dollars prize here, have occurrence 1/116 because the sum of all slices occurrences is 116.
                money_wheel_settings: [
                    {prize: 1000,   type: "prize", background: "bg_0", textcolor: "#ff7800",   textstrokecolor: "#FFFFFF",    win_occurrence:1},
                    {prize: 0,      type: "prize", background: "bg_1", textcolor: "#FFFFFF",   textstrokecolor: "#a20303",    win_occurrence:16},
                    {prize: 30,     type: "prize", background: "bg_2", textcolor: "#FFFFFF",   textstrokecolor: "#c203e3",    win_occurrence:4},
                    {prize: 50,     type: "prize", background: "bg_3", textcolor: "#FFFFFF",   textstrokecolor: "#6a25c9",    win_occurrence:2},
                    {prize: 0,      type: "prize", background: "bg_1", textcolor: "#FFFFFF",   textstrokecolor: "#a20303",    win_occurrence:16},
                    {prize: 5,      type: "freespin", background: "bg_0", textcolor: "#a20303",   textstrokecolor: "#FFFFFF",    win_occurrence:16},
                    {prize: 10,     type: "prize", background: "bg_4", textcolor: "#FFFFFF",   textstrokecolor: "#018ab9",    win_occurrence:12},
                    {prize: 20,     type: "prize", background: "bg_5", textcolor: "#FFFFFF",   textstrokecolor: "#0b8a02",    win_occurrence:7},
                    {prize: 0,      type: "prize", background: "bg_1", textcolor: "#FFFFFF",   textstrokecolor: "#a20303",    win_occurrence:16},
                    {prize: 15,     type: "prize", background: "bg_6", textcolor: "#FFFFFF",   textstrokecolor: "#cf6906",    win_occurrence:10},
                    {prize: 0,      type: "prize", background: "bg_1", textcolor: "#FFFFFF",   textstrokecolor: "#a20303",    win_occurrence:16}
                    /////////ADD HERE MORE SLOT IF YOU WANT
                ],
                total_money_backgrounds_in_folder: 7,  ////SET HERE THE EXACT NUMBER OF BACKGROUND IMAGES IN GAME FOLDER IF YOU WANT ADD MORE DIFFERENT IMAGES


                show_credits:false,                      //SET THIS VALUE TO FALSE IF YOU DON'T WANT TO SHOW CREDITS BUTTON
                fullscreen:true,                        //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                check_orientation:true,                 //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES

                //////////////////////////////////////////////////////////////////////////////////////////
                ad_show_counter: 5     //NUMBER OF SPIN BEFORE AD SHOWN
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