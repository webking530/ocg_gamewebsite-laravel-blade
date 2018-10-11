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

        createjs.Ticker.framerate = 30;
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
         var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            s_oMain.removePreloader();
        }
    };

    
    this._initSounds = function(){
        var aSoundsInfo = new Array();
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'card',loop:false,volume:1, ingamename: 'card'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'press_but',loop:false,volume:1, ingamename: 'press_but'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'win',loop:false,volume:1, ingamename: 'win'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'lose',loop:false,volume:1, ingamename: 'lose'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'press_hold',loop:false,volume:1, ingamename: 'press_hold'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'soundtrack',loop:true,volume:1, ingamename: 'soundtrack'});
        
        RESOURCE_TO_LOAD += aSoundsInfo.length;

        s_aSounds = new Array();
        for(var i=0; i<aSoundsInfo.length; i++){
            s_aSounds[aSoundsInfo[i].ingamename] = new Howl({ 
                                                            src: [aSoundsInfo[i].path+aSoundsInfo[i].filename+'.mp3', aSoundsInfo[i].path+aSoundsInfo[i].filename+'.ogg'],
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
        
        s_oSpriteLibrary.addSprite("bg_menu",GAME_PATH + "/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("but_menu_bg",GAME_PATH + "/sprites/but_menu_bg.png");
        s_oSpriteLibrary.addSprite("but_game_bg",GAME_PATH + "/sprites/but_game_bg.png");
        s_oSpriteLibrary.addSprite("but_exit",GAME_PATH + "/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon",GAME_PATH + "/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("bg_game",GAME_PATH + "/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("card_spritesheet",GAME_PATH + "/sprites/card_spritesheet.png");
        s_oSpriteLibrary.addSprite("msg_box",GAME_PATH + "/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("but_left",GAME_PATH + "/sprites/but_left.png");
        s_oSpriteLibrary.addSprite("but_right",GAME_PATH + "/sprites/but_right.png");
        s_oSpriteLibrary.addSprite("hold",GAME_PATH + "/sprites/hold.png");
        s_oSpriteLibrary.addSprite("logo_game",GAME_PATH + "/sprites/logo_game.png");
        s_oSpriteLibrary.addSprite("paytable",GAME_PATH + "/sprites/paytable.png");
        s_oSpriteLibrary.addSprite("display_bg",GAME_PATH + "/sprites/display_bg.png");
        s_oSpriteLibrary.addSprite("big_display",GAME_PATH + "/sprites/big_display.png");
        s_oSpriteLibrary.addSprite("selection",GAME_PATH + "/sprites/selection.png");
        s_oSpriteLibrary.addSprite("card_selection",GAME_PATH + "/sprites/card_selection.png");
        s_oSpriteLibrary.addSprite("but_fullscreen",GAME_PATH + "/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("but_info",GAME_PATH + "/sprites/but_info.png");
        s_oSpriteLibrary.addSprite("logo_ctl",GAME_PATH + "/sprites/logo_ctl.png");
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();

        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            this.removePreloader();
        }
    };
    
    this.preloaderReady = function(){
        this._loadImages();
		
	if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
        
        _bUpdate = true;
    };
    
    this.removePreloader = function(){
        _oPreloader.unload();
        
        if (!isIOS()) {
            s_oSoundTrack = playSound("soundtrack", 1, true);
        }
        
        this.gotoMenu();
    };
    
    this._onAllImagesLoaded = function(){
        
    };


    this.gotoMenu = function(){
        _oMenu = new CMenu();
        _iState = STATE_MENU;
    };
    
    this.gotoGame = function(){
        _oGame = new CGame(_oData);   
							
        _iState = STATE_GAME;
        $(s_oMain).trigger("game_start");
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
    ENABLE_FULLSCREEN = _oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = _oData.check_orientation;
    SHOW_CREDITS = _oData.show_credits;
    
    this.initContainer();
}

var s_bMobile;
var s_bAudioActive = true;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;

var s_oDrawLayer;
var s_oStage;
var s_oMain = null;
var s_oSpriteLibrary;
var s_oSoundTrack = null;
var s_bFullscreen = false;
var s_aSounds;