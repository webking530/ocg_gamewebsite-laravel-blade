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
            s_oStage.enableMouseOver(10);  
        }
        
        
        s_iPrevTime = new Date().getTime();

        createjs.Ticker.setFPS(30);
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
            
            s_oMain.gotoMenu();
         }
    };
    
    this._initSounds = function(){
        var aSoundsInfo = new Array();
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'chip',loop:false,volume:1, ingamename: 'chip'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'click',loop:false,volume:1, ingamename: 'click'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'fiche_collect',loop:false,volume:1, ingamename: 'fiche_collect'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'fiche_select',loop:false,volume:1, ingamename: 'fiche_select'});
        aSoundsInfo.push({path: GAME_PATH + '/sounds/',filename:'wheel_sound',loop:false,volume:1, ingamename: 'wheel_sound'});
        
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

        s_oSpriteLibrary.addSprite("bg_menu",GAME_PATH + "/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("but_bg",GAME_PATH + "/sprites/but_play_bg.png");
        s_oSpriteLibrary.addSprite("but_exit",GAME_PATH + "/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("bg_game",GAME_PATH + "/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("audio_icon",GAME_PATH + "/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("block",GAME_PATH + "/sprites/block.png");
        s_oSpriteLibrary.addSprite("msg_box",GAME_PATH + "/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("display_bg",GAME_PATH + "/sprites/display_bg.png");
        s_oSpriteLibrary.addSprite("hit_area_bet0",GAME_PATH + "/sprites/hit_area_bet0.png");
        s_oSpriteLibrary.addSprite("hit_area_simple_bet",GAME_PATH + "/sprites/hit_area_simple_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_couple_bet",GAME_PATH + "/sprites/hit_area_couple_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_small_circle",GAME_PATH + "/sprites/hit_area_small_circle.png");
        s_oSpriteLibrary.addSprite("hit_area_triple_bet",GAME_PATH + "/sprites/hit_area_triple_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_col_bet",GAME_PATH + "/sprites/hit_area_col_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_twelve_bet",GAME_PATH + "/sprites/hit_area_twelve_bet.png");
        s_oSpriteLibrary.addSprite("hit_area_other_bet",GAME_PATH + "/sprites/hit_area_other_bet.png");
        s_oSpriteLibrary.addSprite("enlight_bet0",GAME_PATH + "/sprites/enlight_bet0.png");
        s_oSpriteLibrary.addSprite("enlight_black",GAME_PATH + "/sprites/enlight_black.png");
        s_oSpriteLibrary.addSprite("enlight_first18",GAME_PATH + "/sprites/enlight_first18.png");
        s_oSpriteLibrary.addSprite("enlight_first_twelve",GAME_PATH + "/sprites/enlight_first_twelve.png");
        s_oSpriteLibrary.addSprite("enlight_second_twelve",GAME_PATH + "/sprites/enlight_second_twelve.png");
        s_oSpriteLibrary.addSprite("enlight_third_twelve",GAME_PATH + "/sprites/enlight_third_twelve.png");
        s_oSpriteLibrary.addSprite("enlight_second18",GAME_PATH + "/sprites/enlight_second18.png");
        s_oSpriteLibrary.addSprite("enlight_number1",GAME_PATH + "/sprites/enlight_number1.png");
        s_oSpriteLibrary.addSprite("enlight_number3",GAME_PATH + "/sprites/enlight_number3.png");
        s_oSpriteLibrary.addSprite("enlight_number4",GAME_PATH + "/sprites/enlight_number4.png");
        s_oSpriteLibrary.addSprite("enlight_number12",GAME_PATH + "/sprites/enlight_number12.png");
        s_oSpriteLibrary.addSprite("enlight_number16",GAME_PATH + "/sprites/enlight_number16.png");
        s_oSpriteLibrary.addSprite("enlight_number25",GAME_PATH + "/sprites/enlight_number25.png");
        s_oSpriteLibrary.addSprite("enlight_number30",GAME_PATH + "/sprites/enlight_number30.png");
        s_oSpriteLibrary.addSprite("enlight_odd",GAME_PATH + "/sprites/enlight_odd.png");
        s_oSpriteLibrary.addSprite("enlight_red",GAME_PATH + "/sprites/enlight_red.png");
        s_oSpriteLibrary.addSprite("enlight_col",GAME_PATH + "/sprites/enlight_col.png");
        s_oSpriteLibrary.addSprite("select_fiche",GAME_PATH + "/sprites/select_fiche.png");
        s_oSpriteLibrary.addSprite("roulette_anim_bg",GAME_PATH + "/sprites/roulette_anim_bg.png");
        s_oSpriteLibrary.addSprite("ball_spin",GAME_PATH + "/sprites/ball_spin.png");
        s_oSpriteLibrary.addSprite("spin_but",GAME_PATH + "/sprites/spin_but.png");
        s_oSpriteLibrary.addSprite("placeholder",GAME_PATH + "/sprites/placeholder.png");
        s_oSpriteLibrary.addSprite("but_game_bg",GAME_PATH + "/sprites/but_game_bg.png");
        s_oSpriteLibrary.addSprite("circle_red",GAME_PATH + "/sprites/circle_red.png");
        s_oSpriteLibrary.addSprite("circle_green",GAME_PATH + "/sprites/circle_green.png");
        s_oSpriteLibrary.addSprite("circle_black",GAME_PATH + "/sprites/circle_black.png");
        s_oSpriteLibrary.addSprite("final_bet_bg",GAME_PATH + "/sprites/final_bet_bg.png");
        s_oSpriteLibrary.addSprite("neighbor_bg",GAME_PATH + "/sprites/neighbor_bg.jpg");
        s_oSpriteLibrary.addSprite("neighbor_enlight",GAME_PATH + "/sprites/neighbor_enlight.png");
        s_oSpriteLibrary.addSprite("hitarea_neighbor",GAME_PATH + "/sprites/hitarea_neighbor.png");
        s_oSpriteLibrary.addSprite("game_over_bg",GAME_PATH + "/sprites/game_over_bg.jpg");
        s_oSpriteLibrary.addSprite("but_game_small",GAME_PATH + "/sprites/but_game_small.png");
        s_oSpriteLibrary.addSprite("but_fullscreen",GAME_PATH + "/sprites/but_fullscreen.png");
		s_oSpriteLibrary.addSprite("but_credits",GAME_PATH + "/sprites/but_credits.png");
		s_oSpriteLibrary.addSprite("logo_ctl",GAME_PATH + "/sprites/logo_ctl.png");
        
        for(var i=0;i<NUM_FICHES;i++){
            s_oSpriteLibrary.addSprite("fiche_"+i,GAME_PATH + "/sprites/fiche_"+i+".png");
        }
        
        for(var j=0;j<NUM_MASK_BALL_SPIN_FRAMES;j++){
            s_oSpriteLibrary.addSprite("mask_ball_spin_"+j,GAME_PATH + "/sprites/mask_ball_spin/mask_ball_spin_"+j+".png");
        }
        
        for(var t=0;t<NUM_MASK_BALL_SPIN_FRAMES;t++){
            s_oSpriteLibrary.addSprite("wheel_anim_"+t,GAME_PATH + "/sprites/wheel_anim/wheel_anim_"+t+".jpg");
        }
        
        for(var k=0;k<NUM_WHEEL_TOP_FRAMES;k++){
            s_oSpriteLibrary.addSprite("wheel_top_"+k,GAME_PATH + "/sprites/wheel_top/wheel_top_"+k+".jpg");
        }
        
        for(var q=0;q<NUM_BALL_SPIN_FRAMES;q++){
            s_oSpriteLibrary.addSprite("ball_spin1_"+q,GAME_PATH + "/sprites/ball_spin1/ball_spin1_"+q+".png");
            s_oSpriteLibrary.addSprite("ball_spin2_"+q,GAME_PATH + "/sprites/ball_spin2/ball_spin2_"+q+".png");
            s_oSpriteLibrary.addSprite("ball_spin3_"+q,GAME_PATH + "/sprites/ball_spin3/ball_spin3_"+q+".png");
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
    
    this.onAllPreloaderImagesLoaded = function(){
        this._loadImages();
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
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    ENABLE_FULLSCREEN = oData.fullscreen;
	SHOW_CREDITS = oData.show_credits;
    
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
var s_bFullscreen = false;