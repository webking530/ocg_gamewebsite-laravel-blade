function CEndPanel(oSpriteBg){
    
    var _oBg;
    var _oGroup;
    
    var _oMsgTextBack;
    var _oMsgText;
    var _oFade;
    var _oListener;
    
    this._init = function(oSpriteBg){
        
        _oFade = new createjs.Shape();
        _oFade.alpha = 0;
        _oFade.graphics.beginFill("rgba(0,0,0,1)").drawRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        createjs.Tween.get(_oFade).to({alpha:0.7}, 500);
        
        _oBg = createBitmap(oSpriteBg);
        _oBg.regX = oSpriteBg.width/2;
        _oBg.regY = oSpriteBg.height/2;
        _oBg.x = CANVAS_WIDTH/2;
        _oBg.y = CANVAS_HEIGHT/2;
        
	_oMsgTextBack = new createjs.Text(""," 40px "+THIRD_FONT, "#000");
        _oMsgTextBack.x = CANVAS_WIDTH/2 +3;
        _oMsgTextBack.y = (CANVAS_HEIGHT/2) +3;
        _oMsgTextBack.textAlign = "center";
        _oMsgTextBack.textBaseline = "middle";
        _oMsgTextBack.lineWidth = 500;

        _oMsgText = new createjs.Text(""," 40px "+THIRD_FONT, "#ffffff");
        _oMsgText.x = CANVAS_WIDTH/2;
        _oMsgText.y = (CANVAS_HEIGHT/2);
        _oMsgText.textAlign = "center";
        _oMsgText.textBaseline = "middle";
        _oMsgText.lineWidth = 500;

        _oGroup = new createjs.Container();
        _oGroup.alpha = 0;
        _oGroup.visible=false;
        
        _oGroup.addChild(_oFade, _oBg,_oMsgTextBack,_oMsgText);

        s_oStage.addChild(_oGroup);
    };
    
    this.unload = function(){
        _oGroup.off("mousedown",_oListener);
    };
    
    this._initListener = function(){
        _oListener = _oGroup.on("mousedown",this._onExit);
    };
    
    this.show = function(){
	if(DISABLE_SOUND_MOBILE === false || s_bMobile === false ){
	        createjs.Sound.play("game_over");
	}
        
        $(s_oMain).trigger("show_interlevel_ad");
        
        _oMsgTextBack.text = TEXT_GAMEOVER;
        _oMsgText.text = TEXT_GAMEOVER;
        
        _oGroup.visible = true;
        
        var oParent = this;
        createjs.Tween.get(_oGroup).to({alpha:1 }, 500).call(function() {oParent._initListener();});

    };
    
    this._onExit = function(){
        _oGroup.off("mousedown",_oListener);
        s_oStage.removeChild(_oGroup);
        $(s_oMain).trigger("end_session");        
        s_oGame.onExit();
    };
    
    this._init(oSpriteBg);
    
    return this;
}
