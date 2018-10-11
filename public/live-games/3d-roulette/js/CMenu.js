function CMenu(){
    var _oBg;
    var _oButPlay;
    var _oAudioToggle;
    var _oFade;
    var _oButFullscreen;
    var _fRequestFullScreen = null;
    var _fCancelFullScreen = null;
    
    this._init = function(){
        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_menu'));
        s_oStage.addChild(_oBg);

        var oSprite = s_oSpriteLibrary.getSprite('but_bg');
        _oButPlay = new CTextButton((CANVAS_WIDTH/2),CANVAS_HEIGHT -70,oSprite,TEXT_PLAY,FONT1,"#ffffff",40);
        _oButPlay.addEventListener(ON_MOUSE_UP, this._onButPlayRelease, this);

        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            var oSprite = s_oSpriteLibrary.getSprite('audio_icon');
            _oAudioToggle = new CToggle(CANVAS_WIDTH - (oSprite.width/2),(oSprite.height/2) + 14,oSprite);
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
        }
        
		var oSprite = s_oSpriteLibrary.getSprite('but_credits');
		if(SHOW_CREDITS){
            _pStartPosCredits = {x:10 + oSprite.width/2,y:(oSprite.height / 2) + 10};
            _oButCredits = new CGfxButton(_pStartPosCredits.x, _pStartPosCredits.y, oSprite,s_oStage);
            _oButCredits.addEventListener(ON_MOUSE_UP, this._onCredits, this);
            
            _pStartPosFullscreen = {x:_pStartPosCredits.x + oSprite.width + 10,y:_pStartPosCredits.y};
        }else{
            _pStartPosFullscreen = {x:10 + oSprite.width/2,y:(oSprite.height / 2) + 10};
        }
		
        var doc = window.document;
        var docEl = doc.documentElement;
        _fRequestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
        _fCancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;
        
        if(ENABLE_FULLSCREEN === false){
            _fRequestFullScreen = false;
        }
        
        if (_fRequestFullScreen && screenfull.enabled){
            oSprite = s_oSpriteLibrary.getSprite('but_fullscreen');
            _oButFullscreen = new CToggle(_pStartPosFullscreen.x,_pStartPosFullscreen.y,oSprite,s_bFullscreen,true);
            _oButFullscreen.addEventListener(ON_MOUSE_UP, this._onFullscreenRelease, this);
        }
        
        _oFade = new createjs.Shape();
        _oFade.graphics.beginFill("black").drawRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        
        s_oStage.addChild(_oFade);
        
        createjs.Tween.get(_oFade).to({alpha:0}, 400).call(function(){_oFade.visible = false;});  
    };
    
    this.unload = function(){
        _oButPlay.unload(); 
        _oButPlay = null;
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }
        
        if (_fRequestFullScreen && screenfull.enabled){
            _oButFullscreen.unload();
        }
        
		if(SHOW_CREDITS){
            _oButCredits.unload();
        }
		
        s_oStage.removeChild(_oBg);
        _oBg = null;
        
        s_oStage.removeChild(_oFade);
        _oFade = null;
        
        s_oMenu = null;
    };
    
    this._onButPlayRelease = function(){
        this.unload();
        s_oMain.gotoGame();
        
        $(s_oMain).trigger("start_session");
    };

    this._onAudioToggle = function(){
        Howler.mute(s_bAudioActive);
		s_bAudioActive = !s_bAudioActive;
    };
    
	this._onCredits = function(){
        _oCreditsPanel = new CCreditsPanel();
    };
	
    this.resetFullscreenBut = function(){
	if (_fRequestFullScreen && screenfull.enabled){
		_oButFullscreen.setActive(s_bFullscreen);
	}
    };

    this._onFullscreenRelease = function(){
	if(s_bFullscreen) { 
		_fCancelFullScreen.call(window.document);
	}else{
		_fRequestFullScreen.call(window.document.documentElement);
	}
	
	sizeHandler();
    };
    
    s_oMenu = this;
    this._init();
}

var s_oMenu = null;