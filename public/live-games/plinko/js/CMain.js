function CMain(oData){
    var _bUpdate;
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    var _oData;
    
    var _oPreloader;
    var _oMenu;
    var _oModeMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function(){
        s_oCanvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(s_oCanvas);
        s_oStage.preventSelection = true;
        createjs.Touch.enable(s_oStage);
		
	s_bMobile = jQuery.browser.mobile;
        if(s_bMobile === false){
            s_oStage.enableMouseOver(FPS);  
            $('body').on('contextmenu', '#canvas', function(e){ return false; });
        }
		
        s_iPrevTime = new Date().getTime();

	createjs.Ticker.addEventListener("tick", this._update);
        createjs.Ticker.framerate = FPS;
        
        if(navigator.userAgent.match(/Windows Phone/i)){
                DISABLE_SOUND_MOBILE = true;
        }
        
        s_oSpriteLibrary  = new CSpriteLibrary();
        //ADD PRELOADER
        
        _oPreloader = new CPreloader();

    };
    
    this.preloaderReady = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
        
        this._loadImages();
        _bUpdate = true;
    };
    
    this.soundLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);
        _oPreloader.refreshLoader(iPerc);
    };
    
    this._initSounds = function(){
        
        var aSoundsInfo = new Array();
        
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'soundtrack',loop:true,volume:1, ingamename: 'soundtrack'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'press_button',loop:false,volume:1, ingamename: 'click'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'game_over',loop:false,volume:1, ingamename: 'game_over'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'ball_collision',loop:false,volume:1, ingamename: 'ball_collision'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'ball_in_basket',loop:false,volume:1, ingamename: 'ball_in_basket'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'ball_in_basket_negative',loop:false,volume:1, ingamename: 'ball_in_basket_negative'});

        RESOURCE_TO_LOAD += aSoundsInfo.length;

        s_aSounds = new Array();
        for(var i=0; i<aSoundsInfo.length; i++){
            s_aSounds[aSoundsInfo[i].ingamename] = new Howl({ 
                                                            src: [aSoundsInfo[i].path+aSoundsInfo[i].filename+'.mp3'],
                                                            autoplay: false,
                                                            preload: true,
                                                            loop: aSoundsInfo[i].loop, 
                                                            volume: aSoundsInfo[i].volume,
                                                            onload: s_oMain.soundLoaded
                                                        });
        }

    };

    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

        s_oSpriteLibrary.addSprite("logo_game",GAME_PATH + "/sprites/logo_game.png");
        s_oSpriteLibrary.addSprite("logo_menu",GAME_PATH + "/sprites/logo_menu.png");
        
        s_oSpriteLibrary.addSprite("but_play",GAME_PATH + "/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("msg_box",GAME_PATH + "/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("credits_panel",GAME_PATH + "/sprites/credits_panel.png");
        s_oSpriteLibrary.addSprite("ctl_logo",GAME_PATH + "/sprites/ctl_logo.png");
        s_oSpriteLibrary.addSprite("but_credits",GAME_PATH + "/sprites/but_credits.png");
        s_oSpriteLibrary.addSprite("but_yes",GAME_PATH + "/sprites/but_yes.png");
        s_oSpriteLibrary.addSprite("but_no",GAME_PATH + "/sprites/but_no.png");
        
        s_oSpriteLibrary.addSprite("bg_menu",GAME_PATH + "/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("bg_game",GAME_PATH + "/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("side_right",GAME_PATH + "/sprites/side_right.png");
        s_oSpriteLibrary.addSprite("side_left",GAME_PATH + "/sprites/side_left.png");
        
        s_oSpriteLibrary.addSprite("but_exit",GAME_PATH + "/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon",GAME_PATH + "/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("but_fullscreen",GAME_PATH + "/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("but_restart",GAME_PATH + "/sprites/but_restart.png");
        s_oSpriteLibrary.addSprite("but_home",GAME_PATH + "/sprites/but_home.png");
        s_oSpriteLibrary.addSprite("but_settings",GAME_PATH + "/sprites/but_settings.png");
        
        s_oSpriteLibrary.addSprite("but_plus",GAME_PATH + "/sprites/but_plus.png");
        s_oSpriteLibrary.addSprite("bet_panel",GAME_PATH + "/sprites/bet_panel.png");
        
        s_oSpriteLibrary.addSprite("ball",GAME_PATH + "/sprites/ball.png");
        s_oSpriteLibrary.addSprite("stake",GAME_PATH + "/sprites/stake.png");
        s_oSpriteLibrary.addSprite("ball_generator",GAME_PATH + "/sprites/ball_generator.png");
        
        s_oSpriteLibrary.addSprite("holes_occluder",GAME_PATH + "/sprites/holes_occluder.png");
        s_oSpriteLibrary.addSprite("hole_board_occluder",GAME_PATH + "/sprites/hole_board_occluder.png");
        
        s_oSpriteLibrary.addSprite("basket_display",GAME_PATH + "/sprites/basket_display.jpg");
        s_oSpriteLibrary.addSprite("hand_anim",GAME_PATH + "/sprites/hand_anim.png");
        
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();
        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);
        _oPreloader.refreshLoader(iPerc);

    };
    
    this._onAllImagesLoaded = function(){
        
    };
    
    this._onRemovePreloader = function(){
        _oPreloader.unload();
            
        s_oSoundtrack = playSound('soundtrack', 1, true);

        this.gotoMenu();
    };
    
    this.onAllPreloaderImagesLoaded = function(){
        this._loadImages();
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
        Howler.mute(true);
     };

    this.startUpdate = function(){
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display","none");

        if(s_bAudioActive){
                Howler.mute(false);
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
    
    ENABLE_CREDITS = oData.show_credits;
    ENABLE_FULLSCREEN = oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    
    this.initContainer();
}
var s_bMobile;
var s_bAudioActive = true;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;
var s_bFullscreen = false;
var s_aSounds = new Array();

var s_oDrawLayer;
var s_oStage;
var s_oMain;
var s_oSpriteLibrary;
var s_oSoundtrack;
var s_oCanvas;
