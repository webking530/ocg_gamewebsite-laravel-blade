function CMain(oData){
    var _bUpdate;
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    
    var _oData;
    var _oPreloader;
    var _oMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function(){
        var canvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(canvas);       
        createjs.Touch.enable(s_oStage);
        
        s_bMobile = jQuery.browser.mobile;
        if(s_bMobile === false){
            s_oStage.enableMouseOver(20);  
        }
        
        
        s_iPrevTime = new Date().getTime();

        createjs.Ticker.setFPS(FPS);
	createjs.Ticker.addEventListener("tick", this._update);
		
        if(navigator.userAgent.match(/Windows Phone/i)){
                DISABLE_SOUND_MOBILE = true;
        }
		
        s_oSpriteLibrary  = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();
    };

    this.soundLoaded = function(){
         _iCurResource++;

         if(_iCurResource === RESOURCE_TO_LOAD){
            _oPreloader.unload();
            
            this.gotoMenu();
         }
    };
    
    this._initSounds = function(){
    
        var aSoundsInfo = new Array();
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'chip',loop:false,volume:1, ingamename: 'chip'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'click',loop:false,volume:1, ingamename: 'click'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'fiche_collect',loop:false,volume:1, ingamename: 'fiche_collect'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'fiche_select',loop:false,volume:1, ingamename: 'fiche_select'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'dice_rolling',loop:false,volume:1, ingamename: 'dice_rolling'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'win',loop:false,volume:1, ingamename: 'win'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'lose',loop:false,volume:1, ingamename: 'lose'});
        
        RESOURCE_TO_LOAD += aSoundsInfo.length;

        s_aSounds = new Array();
        for(var i=0; i<aSoundsInfo.length; i++){
            s_aSounds[aSoundsInfo[i].ingamename] = new Howl({ 
                                                            src: [aSoundsInfo[i].path+aSoundsInfo[i].filename+'.mp3', aSoundsInfo[i].path+aSoundsInfo[i].filename+'.ogg'],
                                                            autoplay: false,
                                                            preload: true,
                                                            loop: aSoundsInfo[i].loop, 
                                                            volume: aSoundsInfo[i].volume,
                                                            onload: s_oMain.soundLoaded()
                                                        });
        }
        
    };  
    
    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

	s_oSpriteLibrary.addSprite("bg_menu",GAME_PATH + "/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("but_exit",GAME_PATH + "/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon",GAME_PATH + "/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("msg_box",GAME_PATH + "/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("chip_box",GAME_PATH + "/sprites/chip_box.png");
        s_oSpriteLibrary.addSprite("but_bets",GAME_PATH + "/sprites/but_bets.png");
        s_oSpriteLibrary.addSprite("but_bg",GAME_PATH + "/sprites/but_bg.png");
        s_oSpriteLibrary.addSprite("but_clear_all",GAME_PATH + "/sprites/but_clear_all.png");
        s_oSpriteLibrary.addSprite("but_play",GAME_PATH + "/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("logo_credits",GAME_PATH + "/sprites/logo_credits.png");
        s_oSpriteLibrary.addSprite("but_credits",GAME_PATH + "/sprites/but_credits.png");
        s_oSpriteLibrary.addSprite("ball",GAME_PATH + "/sprites/ball.png");
        s_oSpriteLibrary.addSprite("enlight_any_craps",GAME_PATH + "/sprites/enlight_any_craps.png");
        s_oSpriteLibrary.addSprite("enlight_big_6",GAME_PATH + "/sprites/enlight_big_6.png");
        s_oSpriteLibrary.addSprite("enlight_big_8",GAME_PATH + "/sprites/enlight_big_8.png");
        s_oSpriteLibrary.addSprite("enlight_circle",GAME_PATH + "/sprites/enlight_circle.png");
        s_oSpriteLibrary.addSprite("enlight_come",GAME_PATH + "/sprites/enlight_come.png");
        s_oSpriteLibrary.addSprite("enlight_dont_come",GAME_PATH + "/sprites/enlight_dont_come.png");
        s_oSpriteLibrary.addSprite("enlight_dont_pass1",GAME_PATH + "/sprites/enlight_dont_pass1.png");
        s_oSpriteLibrary.addSprite("enlight_dont_pass2",GAME_PATH + "/sprites/enlight_dont_pass2.png");
        s_oSpriteLibrary.addSprite("enlight_field",GAME_PATH + "/sprites/enlight_field.png");
        s_oSpriteLibrary.addSprite("enlight_lay_bet",GAME_PATH + "/sprites/enlight_lay_bet.png");
        s_oSpriteLibrary.addSprite("enlight_lose_bet",GAME_PATH + "/sprites/enlight_lose_bet.png");
        s_oSpriteLibrary.addSprite("enlight_number",GAME_PATH + "/sprites/enlight_number.png");
        s_oSpriteLibrary.addSprite("enlight_pass_line",GAME_PATH + "/sprites/enlight_pass_line.png");
        s_oSpriteLibrary.addSprite("enlight_proposition1",GAME_PATH + "/sprites/enlight_proposition1.png");
        s_oSpriteLibrary.addSprite("enlight_proposition2",GAME_PATH + "/sprites/enlight_proposition2.png");
        s_oSpriteLibrary.addSprite("enlight_seven",GAME_PATH + "/sprites/enlight_seven.png");
        s_oSpriteLibrary.addSprite("enlight_any11",GAME_PATH + "/sprites/enlight_any11.png");
        
        s_oSpriteLibrary.addSprite("hit_area_any_craps",GAME_PATH + "/sprites/hit_area_any_craps.png");
        s_oSpriteLibrary.addSprite("hit_area_big_8",GAME_PATH + "/sprites/hit_area_big_8.png");
        s_oSpriteLibrary.addSprite("hit_area_big_6",GAME_PATH + "/sprites/hit_area_big_6.png");
        s_oSpriteLibrary.addSprite("hit_area_circle",GAME_PATH + "/sprites/hit_area_circle.png");
        s_oSpriteLibrary.addSprite("hit_area_come",GAME_PATH + "/sprites/hit_area_come.png");
        s_oSpriteLibrary.addSprite("hit_area_dont_come",GAME_PATH + "/sprites/hit_area_dont_come.png");
        s_oSpriteLibrary.addSprite("hit_area_dont_pass1",GAME_PATH + "/sprites/hit_area_dont_pass1.png");
        s_oSpriteLibrary.addSprite("hit_area_dont_pass2",GAME_PATH + "/sprites/hit_area_dont_pass2.png");
        s_oSpriteLibrary.addSprite("hit_area_field",GAME_PATH + "/sprites/hit_area_field.png");
        s_oSpriteLibrary.addSprite("hit_area_lay_bet",GAME_PATH + "/sprites/hit_area_lay_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_lose_bet",GAME_PATH + "/sprites/hit_area_lose_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_number",GAME_PATH + "/sprites/hit_area_number.png");
        s_oSpriteLibrary.addSprite("hit_area_pass_line",GAME_PATH + "/sprites/hit_area_pass_line.png");
        s_oSpriteLibrary.addSprite("hit_area_proposition1",GAME_PATH + "/sprites/hit_area_proposition1.png");
        s_oSpriteLibrary.addSprite("hit_area_proposition2",GAME_PATH + "/sprites/hit_area_proposition2.png");
        s_oSpriteLibrary.addSprite("hit_area_seven",GAME_PATH + "/sprites/hit_area_seven.png");
        s_oSpriteLibrary.addSprite("hit_area_any11",GAME_PATH + "/sprites/hit_area_any11.png");
        s_oSpriteLibrary.addSprite("select_fiche",GAME_PATH + "/sprites/select_fiche.png");
        s_oSpriteLibrary.addSprite("roll_but",GAME_PATH + "/sprites/roll_but.png");
        s_oSpriteLibrary.addSprite("dices_screen_bg",GAME_PATH + "/sprites/dices_screen_bg.jpg");
        s_oSpriteLibrary.addSprite("logo_game_0",GAME_PATH + "/sprites/logo_game_0.png");
        s_oSpriteLibrary.addSprite("board_table",GAME_PATH + "/sprites/board_table.jpg");
        s_oSpriteLibrary.addSprite("display_bg",GAME_PATH + "/sprites/display_bg.png");
        s_oSpriteLibrary.addSprite("puck",GAME_PATH + "/sprites/puck.png");
        s_oSpriteLibrary.addSprite("dice_topdown1",GAME_PATH + "/sprites/dice_topdown1.png");
        s_oSpriteLibrary.addSprite("dice_topdown2",GAME_PATH + "/sprites/dice_topdown2.png");
        s_oSpriteLibrary.addSprite("but_not",GAME_PATH + "/sprites/but_not.png");
        s_oSpriteLibrary.addSprite("but_yes",GAME_PATH + "/sprites/but_yes.png");
        s_oSpriteLibrary.addSprite("dice_a",GAME_PATH + "/sprites/dice_a.png");
        s_oSpriteLibrary.addSprite("dice_b",GAME_PATH + "/sprites/dice_b.png");
        s_oSpriteLibrary.addSprite("dices_box",GAME_PATH + "/sprites/dices_box.png");
        s_oSpriteLibrary.addSprite("but_fullscreen",GAME_PATH + "/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("but_credits",GAME_PATH + "/sprites/but_credits.png");
        
        for(var i=0;i<NUM_FICHES;i++){
            s_oSpriteLibrary.addSprite("fiche_"+i,GAME_PATH + "/sprites/fiche_"+i+".png");
        }
        
        for(var j=0;j<NUM_DICE_ROLLING_FRAMES;j++){
            s_oSpriteLibrary.addSprite("launch_dices_"+j,GAME_PATH + "/sprites/launch_dice_anim/launch_dices_"+j+".png");
        }

        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();

        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;

        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            _oPreloader.unload();
            
            this.gotoMenu();
        }
    };
    
    this._onAllImagesLoaded = function(){
        
    };
    
    this.onImageLoadError = function(szText){
        
    };
	
    this.preloaderReady = function(){
        this._loadImages();
		
	if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
        
        _bUpdate = true;
    };
    
    this.gotoMenu = function(){
        _oMenu = new CMenu();
        _iState = STATE_MENU;

        _oMenu._onButPlayRelease();
    };
    
    this.gotoGame = function(){
        _oGame = new CGame(_oData);   
							
        _iState = STATE_GAME;
    };
    
    this.gotoHelp = function(){
        _oHelp = new CHelp();
        _iState = STATE_HELP;
    };
    
    this.stopUpdate = function(){
        _bUpdate = false;
        createjs.Ticker.paused = true;
        $("#block_game").css("display","block");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            Howler.mute(true);
        }
        
    };

    this.startUpdate = function(){
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display","none");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            if(s_bAudioActive){
                Howler.mute(false);
            }
        }
        
    };
    
    this._update = function(event){
        if(_bUpdate === false){
                return;
        }
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;
        
        if ( s_iCntTime >= 1000 ){
            s_iCurFps = s_iCntFps;
            s_iCntTime-=1000;
            s_iCntFps = 0;
        }
                
        if(_iState === STATE_GAME){
            _oGame.update();
        }
        
        s_oStage.update(event);

    };
    
    s_oMain = this;
    _oData = oData;
    SHOW_CREDITS = oData.show_credits;
    ENABLE_FULLSCREEN = oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    
    this.initContainer();
}

var s_bMobile;
var s_bAudioActive = true;
var s_bFullscreen = false;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;

var s_oDrawLayer;
var s_oStage;
var s_oMain = null;
var s_oSpriteLibrary;
var s_aSounds;