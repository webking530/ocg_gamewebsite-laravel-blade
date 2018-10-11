function CInterface(iMoney,iBet){
    var _pStartPosAudio;
    var _pStartPosExit;
    var _pStartPosFullscreen;
    
    var _oButExit;
    var _oArrowLeft;
    var _oArrowRight;
    var _oBetOneBut;
    var _oBetMaxBut;
    var _oDealBut;
    var _oAudioToggle;
    var _oMoneyText;
    var _oWinText;
    var _oBetText;
    var _oTotBetText;
    var _oLosePanel;
    var _oButFullscreen;
    var _fRequestFullScreen = null;
    var _fCancelFullScreen = null;
    
    this._init = function(iMoney,iBet){
        
        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _pStartPosExit = {x:CANVAS_WIDTH - (oSprite.width/2) - 2,y:(oSprite.height/2) + 2};
        _oButExit = new CGfxButton(_pStartPosExit.x,_pStartPosExit.y,oSprite,s_oStage);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _pStartPosAudio = {x:_oButExit.getX() - oSprite.width,y:(oSprite.height/2) + 2};
            _oAudioToggle = new CToggle(_pStartPosAudio.x,_pStartPosAudio.y,s_oSpriteLibrary.getSprite('audio_icon'),s_bAudioActive);
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
            
            _pStartPosFullscreen = {x:_pStartPosAudio.x - oSprite.width - 10,y:_pStartPosAudio.y};
        }else{
            _pStartPosFullscreen = {x:_oButExit.getX() - oSprite.width - 10,y:(oSprite.height/2) + 2};
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
        
        var oDisplayWin = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayWin.x = 480;
        oDisplayWin.y = 25;
        s_oStage.addChild(oDisplayWin);
        
        var oWinTextBg = new createjs.Text(TEXT_WIN,"21px "+FONT1, "#fff");
        oWinTextBg.x = 490;
        oWinTextBg.y = 32;
        oWinTextBg.textAlign = "center";
        oWinTextBg.textBaseline = "middle";
        s_oStage.addChild(oWinTextBg);
        
        var oDisplayBet = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayBet.x = 480;
        oDisplayBet.y = 93;
        s_oStage.addChild(oDisplayBet);
        
        var oBetTextBg = new createjs.Text(TEXT_BET,"21px "+FONT1, "#fff");
        oBetTextBg.x = 490;
        oBetTextBg.y = 100;
        oBetTextBg.textAlign = "center";
        oBetTextBg.textBaseline = "middle";
        s_oStage.addChild(oBetTextBg);
        
        var oDisplayMoney = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayMoney.x = 470;
        oDisplayMoney.y = 687;
        s_oStage.addChild(oDisplayMoney);
        
        var oMoneyTextBg = new createjs.Text(TEXT_MONEY,"21px "+FONT1, "#fff");
        oMoneyTextBg.x = 490;
        oMoneyTextBg.y = 695;
        oMoneyTextBg.textAlign = "center";
        oMoneyTextBg.textBaseline = "middle";
        s_oStage.addChild(oMoneyTextBg);
	
	_oMoneyText = new createjs.Text(iMoney.toFixed(2)+TEXT_CURRENCY,"29px "+FONT2, "#ffde00");
        _oMoneyText.x = 590;
        _oMoneyText.y = CANVAS_HEIGHT - 65;
        _oMoneyText.textAlign = "center";
        s_oStage.addChild(_oMoneyText);
        
        _oBetText = new createjs.Text(iBet.toFixed(2)+TEXT_CURRENCY,"29px "+FONT2, "#ffde00");
        _oBetText.x = 590;
        _oBetText.y = 110;
        _oBetText.textAlign = "center";
        s_oStage.addChild(_oBetText);
        
        _oWinText = new createjs.Text("0"+TEXT_CURRENCY,"29px "+FONT2, "#ffde00");
        _oWinText.x = 590;
        _oWinText.y = 40;
        _oWinText.textAlign = "center";
        s_oStage.addChild(_oWinText);
        
        var oBigDisplay = createBitmap(s_oSpriteLibrary.getSprite('big_display'));
        oBigDisplay.x = 770;
        oBigDisplay.y = 686;
        s_oStage.addChild(oBigDisplay);
        
        _oTotBetText = new createjs.Text(iBet.toFixed(2)+TEXT_CURRENCY,"40px "+FONT2, "#ffde00");
        _oTotBetText.x = 840;
        _oTotBetText.y = 700;
        _oTotBetText.textAlign = "center";
        s_oStage.addChild(_oTotBetText);
        
        var oSprite = s_oSpriteLibrary.getSprite('logo_game');
        var oLogo = createBitmap(oSprite);
        oLogo.x = CANVAS_WIDTH/2;
        oLogo.y = 17;
        oLogo.regX = oSprite.width/2;
        s_oStage.addChild(oLogo);
        
        var oSprite = s_oSpriteLibrary.getSprite('but_left');
        _oArrowLeft = new CGfxButton(744,722,oSprite,s_oStage);
        _oArrowLeft.addEventListener(ON_MOUSE_UP, this._onButLeftRelease, this);

        oSprite = s_oSpriteLibrary.getSprite('but_right');
        _oArrowRight = new CGfxButton(930,722,oSprite,s_oStage);
        _oArrowRight.addEventListener(ON_MOUSE_UP, this._onButRightRelease, this);
        
        oSprite = s_oSpriteLibrary.getSprite('but_game_bg');
        _oBetOneBut = new CTextButton(1040,716,oSprite,TEXT_BET_ONE,FONT1,"#ffffff",23,s_oStage);
        _oBetOneBut.addEventListener(ON_MOUSE_UP, this._onButBetOneRelease, this);
        
        _oBetMaxBut = new CTextButton(1190,716,oSprite,TEXT_MAX_BET,FONT1,"#ffffff",23,s_oStage);
        _oBetMaxBut.addEventListener(ON_MOUSE_UP, this._onButBetMaxRelease, this);
        
        _oDealBut = new CTextButton(1340,716,oSprite,TEXT_DEAL,FONT1,"#ffffff",30,s_oStage);
        _oDealBut.addEventListener(ON_MOUSE_UP, this._onButDealRelease, this);
        
        _oLosePanel = new createjs.Container();
        _oLosePanel.visible = false;
        _oLosePanel.x = 710;
        _oLosePanel.y = 500;
        s_oStage.addChild(_oLosePanel);
        
        var oFade = new createjs.Shape();
        oFade.graphics.beginFill("rgba(0,0,0,0.7)").drawRect(0,0,500,100);
        _oLosePanel.addChild(oFade);
        
        var oText = new createjs.Text(TEXT_NO_WIN,"50px "+FONT1, "#fff");
        oText.x = 250;
        oText.y = 20;
        oText.textAlign = "center";
        _oLosePanel.addChild(oText);
        
        this.refreshButtonPos (s_iOffsetX,s_iOffsetY);
    };
    
    this.unload = function(){
        _oButExit.unload();
        _oArrowLeft.unload();
        _oArrowRight.unload();
        _oBetOneBut.unload();
        _oBetMaxBut.unload();
        _oDealBut.unload();

        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }
        
        if (_fRequestFullScreen && screenfull.enabled){
            _oButFullscreen.unload();
        }
        
        s_oInterface = null;
    };
    
    this.refreshButtonPos = function(iNewX,iNewY){
        _oButExit.setPosition(_pStartPosExit.x - iNewX,iNewY + _pStartPosExit.y);
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle.setPosition(_pStartPosAudio.x - iNewX,iNewY + _pStartPosAudio.y);
        }
        if (_fRequestFullScreen && screenfull.enabled){
            _oButFullscreen.setPosition(_pStartPosFullscreen.x - iNewX,_pStartPosFullscreen.y + iNewY);
        }
    };
    
    this.setState = function(iState){
        switch(iState){
            case STATE_GAME_CHOOSE_HOLD:{
                _oDealBut.changeText(TEXT_DRAW);
                break;
            }
			case STATE_GAME_DRAW:
            case STATE_GAME_EVALUATE:{
                _oDealBut.changeText(TEXT_DEAL);
                break;
            }
        }
    };
    
    this.resetHand = function(){
        this.refreshWin(0);
        _oLosePanel.visible = false;
    };
    
    this.refreshMoney = function(iMoney,iBet){
        _oMoneyText.text = iMoney.toFixed(2)+TEXT_CURRENCY;
        _oBetText.text = iBet.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.refreshWin = function(iWin){
        _oWinText.text = iWin.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.refreshBet = function(iBet){
        _oTotBetText.text = iBet.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.showLosePanel = function(){
        _oLosePanel.visible = true;
    };

    this._onButLeftRelease = function(){
        s_oGame._onButLeftRelease();
    };
    
    this._onButRightRelease = function(){
        s_oGame._onButRightRelease();
    };
    
    this._onButBetOneRelease = function(){
        s_oGame._onButBetOneRelease();
    };
    
    this._onButBetMaxRelease = function(){
        s_oGame._onButBetMaxRelease();
    };
    
    this._onButDealRelease = function(){
        s_oGame._onButDealRelease();
    };
    
    this._onExit = function(){
        s_oGame.onExit();  
    };
    
    this._onAudioToggle = function(){
        Howler.mute(s_bAudioActive);
        s_bAudioActive = !s_bAudioActive;
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
    
    s_oInterface = this;
    
    this._init(iMoney,iBet);
    
    return this;
}

var s_oInterface = null;