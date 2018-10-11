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
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'wheel_sound',loop:true,volume:1, ingamename: 'wheel_sound'});
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
        s_oSpriteLibrary.addSprite("bg_game",GAME_PATH + "/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("audio_icon",GAME_PATH + "/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("msg_box",GAME_PATH + "/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("hit_area_0",GAME_PATH + "/sprites/hit_area_0.png");
        s_oSpriteLibrary.addSprite("hit_area_color",GAME_PATH + "/sprites/hit_area_color.png");
        s_oSpriteLibrary.addSprite("hit_area_horizontal",GAME_PATH + "/sprites/hit_area_horizontal.png");
        s_oSpriteLibrary.addSprite("hit_area_number",GAME_PATH + "/sprites/hit_area_number.png");
        s_oSpriteLibrary.addSprite("hit_area_couple_horizontal",GAME_PATH + "/sprites/hit_area_couple_horizontal.png");
        s_oSpriteLibrary.addSprite("hit_area_couple_vertical",GAME_PATH + "/sprites/hit_area_couple_vertical.png");
        s_oSpriteLibrary.addSprite("hit_area_small",GAME_PATH + "/sprites/hit_area_small.png");
        s_oSpriteLibrary.addSprite("hit_area_horizontal_half",GAME_PATH + "/sprites/hit_area_horizontal_half.png");
        s_oSpriteLibrary.addSprite("chip_box",GAME_PATH + "/sprites/chip_box.png");
        s_oSpriteLibrary.addSprite("but_bets",GAME_PATH + "/sprites/but_bets.png");
        s_oSpriteLibrary.addSprite("but_bg",GAME_PATH + "/sprites/but_bg.png");
        s_oSpriteLibrary.addSprite("but_clear_all",GAME_PATH + "/sprites/but_clear_all.png");
        s_oSpriteLibrary.addSprite("but_clear_last",GAME_PATH + "/sprites/but_clear_last.png");
        s_oSpriteLibrary.addSprite("but_rebet",GAME_PATH + "/sprites/but_rebet.png");
        s_oSpriteLibrary.addSprite("but_play",GAME_PATH + "/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("logo_credits",GAME_PATH + "/sprites/logo_credits.png");
        s_oSpriteLibrary.addSprite("but_credits",GAME_PATH + "/sprites/but_credits.png");
        s_oSpriteLibrary.addSprite("history_bg",GAME_PATH + "/sprites/history_bg.png");
        s_oSpriteLibrary.addSprite("show_number_panel",GAME_PATH + "/sprites/show_number_panel.png");
        s_oSpriteLibrary.addSprite("show_number_bg",GAME_PATH + "/sprites/show_number_bg.png");
        s_oSpriteLibrary.addSprite("ball",GAME_PATH + "/sprites/ball.png");
        s_oSpriteLibrary.addSprite("enlight_0",GAME_PATH + "/sprites/enlight_0.png");
        s_oSpriteLibrary.addSprite("enlight_color",GAME_PATH + "/sprites/enlight_color.png");
        s_oSpriteLibrary.addSprite("enlight_horizontal",GAME_PATH + "/sprites/enlight_horizontal.png");
        s_oSpriteLibrary.addSprite("enlight_number",GAME_PATH + "/sprites/enlight_number.png");
        s_oSpriteLibrary.addSprite("enlight_horizontal_half",GAME_PATH + "/sprites/enlight_horizontal_half.png");
        s_oSpriteLibrary.addSprite("select_fiche",GAME_PATH + "/sprites/select_fiche.png");
        s_oSpriteLibrary.addSprite("spin_but",GAME_PATH + "/sprites/spin_but.png");
        s_oSpriteLibrary.addSprite("placeholder",GAME_PATH + "/sprites/placeholder.png");
        s_oSpriteLibrary.addSprite("circle_red",GAME_PATH + "/sprites/circle_red.png");
        s_oSpriteLibrary.addSprite("circle_green",GAME_PATH + "/sprites/circle_green.png");
        s_oSpriteLibrary.addSprite("circle_black",GAME_PATH + "/sprites/circle_black.png");
        s_oSpriteLibrary.addSprite("final_bet_bg",GAME_PATH + "/sprites/final_bet_bg.png");
        s_oSpriteLibrary.addSprite("neighbor_bg",GAME_PATH + "/sprites/neighbor_bg.jpg");
        s_oSpriteLibrary.addSprite("neighbor_enlight",GAME_PATH + "/sprites/neighbor_enlight.png");
        s_oSpriteLibrary.addSprite("hitarea_neighbor",GAME_PATH + "/sprites/hitarea_neighbor.png");
        s_oSpriteLibrary.addSprite("bg_wheel",GAME_PATH + "/sprites/bg_wheel.jpg");
        s_oSpriteLibrary.addSprite("logo_game_0",GAME_PATH + "/sprites/logo_game_0.png");
        s_oSpriteLibrary.addSprite("but_fullscreen",GAME_PATH + "/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("logo",GAME_PATH + "/sprites/logo.png");
        s_oSpriteLibrary.addSprite("board_roulette",GAME_PATH + "/sprites/board_roulette.jpg");
        
        for(var i=0;i<NUM_FICHES;i++){
            s_oSpriteLibrary.addSprite("fiche_"+i,GAME_PATH + "/sprites/fiche_"+i+".png");
        }
        
        for(var j=0;j<NUM_MASK_BALL_SPIN_FRAMES;j++){
            s_oSpriteLibrary.addSprite("wheel_handle_"+j,GAME_PATH + "/sprites/mask_ball_spin/wheel_handle_"+j+".png");
        }
        
        for(var t=0;t<NUM_MASK_BALL_SPIN_FRAMES;t++){
            s_oSpriteLibrary.addSprite("wheel_numbers_"+t,GAME_PATH + "/sprites/wheel_anim/wheel_numbers_"+t+".png");
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
    ENABLE_FULLSCREEN = oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    SHOW_CREDITS = _oData.show_credits;

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