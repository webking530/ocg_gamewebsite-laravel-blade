function CInterface(){
    var _pStartPosFullscreen;
    var _fRequestFullScreen = null;
    var _fCancelFullScreen = null;
    var _oButFullscreen;
    var _oAudioToggle;
    var _oButExit;
    var _oButSpin;
    var _oButPlus;
    var _oButMin;
 
    var _iCurAlpha;
    var _oCreditNum;
    var _oMoneyNum;
    var _oBetNum;
    var _oParent;
    var _oTextHighLight;
    
    var _pStartPosExit;
    var _pStartPosAudio;
    
    this._init = function(){
        _oParent = this;
        _iCurAlpha = 0;
        
        var oExitX;        
        
        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _pStartPosExit = {x: CANVAS_WIDTH - (oSprite.height/2)- 10, y: (oSprite.height/2) + 10};
        _oButExit = new CGfxButton(_pStartPosExit.x, _pStartPosExit.y, oSprite,true);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        oExitX = CANVAS_WIDTH - (oSprite.width/2) - 100;
        _pStartPosAudio = {x: oExitX, y: (oSprite.height/2) + 10};
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            var oSprite = s_oSpriteLibrary.getSprite('audio_icon');
            _oAudioToggle = new CToggle(_pStartPosAudio.x,_pStartPosAudio.y,oSprite,s_bAudioActive,s_oStage);
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);          
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
            _pStartPosFullscreen = {x:oSprite.width/4 + 10,y:oSprite.height/2 + 10};

            _oButFullscreen = new CToggle(_pStartPosFullscreen.x,_pStartPosFullscreen.y,oSprite,s_bFullscreen,s_oStage);
            _oButFullscreen.addEventListener(ON_MOUSE_UP, this._onFullscreenRelease, this);
        }
		
        var oSprite = s_oSpriteLibrary.getSprite('but_spin');
        _oButSpin = new CTextButton(500,CANVAS_HEIGHT - 190,oSprite,TEXT_SPIN,PRIMARY_FONT,"#ffffff",70, false, s_oStage);
        _oButSpin.enable();
        _oButSpin.addEventListener(ON_MOUSE_UP, this._onButSpinRelease, this);

        var oSprite = s_oSpriteLibrary.getSprite('but_plus');
        _oButPlus = new CTextButton(650,CANVAS_HEIGHT - 320,oSprite,TEXT_PLUS,PRIMARY_FONT,"#ffffff",70, false, s_oStage);
        _oButPlus.enable();
        _oButPlus.addEventListener(ON_MOUSE_UP, this._onButPlusRelease, this);

        var oSprite = s_oSpriteLibrary.getSprite('but_plus');
        _oButMin = new CTextButton(350,CANVAS_HEIGHT - 320,oSprite,TEXT_MIN,PRIMARY_FONT,"#ffffff",70, false, s_oStage);
        _oButMin.enable();
        _oButMin.addEventListener(ON_MOUSE_UP, this._onButMinRelease, this);
        
        var oCreditTextBack = new createjs.Text(TEXT_CREDITS,"90px "+PRIMARY_FONT, "#000000");
        oCreditTextBack.x = 304;
        oCreditTextBack.y = 204;
        oCreditTextBack.textAlign = "left";
        oCreditTextBack.textBaseline = "alphabetic";
        oCreditTextBack.lineWidth = 400;
        s_oStage.addChild(oCreditTextBack);
                
        var oCreditText = new createjs.Text(TEXT_CREDITS,"90px "+PRIMARY_FONT, "#ffffff");
        oCreditText.x = 300;
        oCreditText.y = 200;
        oCreditText.textAlign = "left";
        oCreditText.textBaseline = "alphabetic";
        oCreditText.lineWidth = 400;
        s_oStage.addChild(oCreditText);
        
        _oCreditNum = new createjs.Text(TEXT_CURRENCY + START_CREDIT.toFixed(2),"70px "+PRIMARY_FONT, "#ffffff");
        _oCreditNum.x = 320;
        _oCreditNum.y = 350;
        _oCreditNum.textAlign = "left";
        _oCreditNum.textBaseline = "alphabetic";
        _oCreditNum.lineWidth = 400;
        s_oStage.addChild(_oCreditNum);

        _oMoneyNum = new createjs.Text(TEXT_CURRENCY +"0.00","70px "+PRIMARY_FONT, "#ffffff");
        _oMoneyNum.x = 320;
        _oMoneyNum.y = 560;
        _oMoneyNum.textAlign = "left";
        _oMoneyNum.textBaseline = "alphabetic";
        _oMoneyNum.lineWidth = 400;
        s_oStage.addChild(_oMoneyNum);
        
        _oTextHighLight = new createjs.Text(TEXT_CURRENCY +"0","70px "+PRIMARY_FONT, "yellow");
        _oTextHighLight.x = 320;
        _oTextHighLight.y = 560;
        _oTextHighLight.textAlign = "left";
        _oTextHighLight.textBaseline = "alphabetic";
        _oTextHighLight.lineWidth = 400;
        _oTextHighLight.alpha = _iCurAlpha;
        s_oStage.addChild(_oTextHighLight);
        
        _oBetNum = new createjs.Text(TEXT_CURRENCY +START_BET,"40px "+PRIMARY_FONT, "#ffffff");
        _oBetNum.x = 500;
        _oBetNum.y = 775;
        _oBetNum.textAlign = "center";
        _oBetNum.textBaseline = "alphabetic";
        _oBetNum.lineWidth = 400;
        s_oStage.addChild(_oBetNum);
        
        this.refreshButtonPos(s_iOffsetX,s_iOffsetY);
    };
    
    this.unload = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }

        _oButExit.unload();
        _oButSpin.unload();
		if (_fRequestFullScreen && screenfull.enabled){
            _oButFullscreen.unload();
        }
        
        s_oInterface = null;
    };

    this.refreshCredit = function(iValue){        
        _oCreditNum.text = TEXT_CURRENCY + iValue.toFixed(2);
    };
    
    this.clearMoneyPanel = function(){
        _oTextHighLight.alpha=0;
        createjs.Tween.removeTweens(_oTextHighLight); 
    };

    this.refreshMoney = function(iValue){        
        _oMoneyNum.text = TEXT_CURRENCY + iValue.toFixed(2);
        _oTextHighLight.text = TEXT_CURRENCY + iValue.toFixed(2);
    };

    this.refreshBet = function(iValue){
        _oBetNum.text = TEXT_CURRENCY + iValue;
    };

    this.animWin = function(){
        if(_iCurAlpha === 1){
            _iCurAlpha = 0;
            createjs.Tween.get(_oTextHighLight).to({alpha:_iCurAlpha }, 150,createjs.Ease.cubicOut).call(function(){_oParent.animWin();});
        }else{
            _iCurAlpha = 1;
            createjs.Tween.get(_oTextHighLight).to({alpha:_iCurAlpha }, 150,createjs.Ease.cubicOut).call(function(){_oParent.animWin();});
        }
        
    };

    this._onButSpinRelease = function(){
        s_oGame.spinWheel();
    };
    
    this._onButPlusRelease = function(){
        s_oGame.modifyBonus("plus");
    };

    this._onButMinRelease = function(){
        s_oGame.modifyBonus("min");
    };

    this.disableSpin = function(bDisable){
        if(bDisable === true){
            _oButSpin.disable();
            _oButPlus.disable();
            _oButMin.disable();
        } else {
            _oButSpin.enable();
            _oButPlus.enable();
            _oButMin.enable();
        }        
    };
    
    this.refreshButtonPos = function(iNewX,iNewY){
        _oButExit.setPosition(_pStartPosExit.x - iNewX,iNewY + _pStartPosExit.y);
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
			_oAudioToggle.setPosition(_pStartPosAudio.x - iNewX,iNewY + _pStartPosAudio.y);
		}
		if (_fRequestFullScreen && screenfull.enabled){
            _oButFullscreen.setPosition(_pStartPosFullscreen.x + iNewX,_pStartPosFullscreen.y + iNewY);
        }
    };
    
    this._onAudioToggle = function(){
        Howler.mute(s_bAudioActive);
        s_bAudioActive = !s_bAudioActive;
    };
    
    this.resetFullscreenBut = function(){
	_oButFullscreen.setActive(s_bFullscreen);
    };

    this._onFullscreenRelease = function(){
        if(s_bFullscreen) { 
		_fCancelFullScreen.call(window.document);
	}else{
		_fRequestFullScreen.call(window.document.documentElement);
	}
	
	sizeHandler();
    };
    
    this._onExit = function(){
        $(s_oMain).trigger("end_session");
        
        s_oGame.onExit();  
    };
    
    s_oInterface = this;
    
    this._init();
    
    return this;
}

var s_oInterface = null;