function CEndPanel(iScore){
    
    var _oButRestart;
    var _oButHome;
    var _oFade;
    var _oPanelContainer;
    var _oParent;
    var _oListener;
    
    var _pStartPanelPos;
    
    this._init = function(iScore){
        
        _oFade = new createjs.Shape();
        _oFade.graphics.beginFill("black").drawRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        _oFade.alpha = 0;
        _oListener = _oFade.on("mousedown",function(){});
        s_oStage.addChild(_oFade);
        
        createjs.Tween.get(_oFade).to({alpha:0.7},500);
        
        _oPanelContainer = new createjs.Container();        
        s_oStage.addChild(_oPanelContainer);
        
        var oSprite = s_oSpriteLibrary.getSprite('msg_box');
        var oPanel = createBitmap(oSprite);        
        oPanel.regX = oSprite.width/2;
        oPanel.regY = oSprite.height/2;
        _oPanelContainer.addChild(oPanel);
        
        _oPanelContainer.x = CANVAS_WIDTH/2;
        _oPanelContainer.y = CANVAS_HEIGHT + oSprite.height/2;  
        _pStartPanelPos = {x: _oPanelContainer.x, y: _oPanelContainer.y};
        createjs.Tween.get(_oPanelContainer).to({y:CANVAS_HEIGHT/2 - 40},500, createjs.Ease.quartIn);
        /*
        var oTitleStroke = new createjs.Text(TEXT_ARE_SURE," 34px "+PRIMARY_FONT, "#000000");
        oTitleStroke.y = -oSprite.height/2 + 120;
        oTitleStroke.textAlign = "center";
        oTitleStroke.textBaseline = "middle";
        oTitleStroke.lineWidth = 400;
        oTitleStroke.outline = 5;
        _oPanelContainer.addChild(oTitleStroke);
        */
        var oTitle = new createjs.Text(TEXT_GAMEOVER," 60px "+PRIMARY_FONT, "#ffffff");
        oTitle.y = -oSprite.height/2 + 160;
        oTitle.textAlign = "center";
        oTitle.textBaseline = "middle";
        oTitle.lineWidth = 400;
        _oPanelContainer.addChild(oTitle);

        _oButRestart = new CGfxButton(110, 80, s_oSpriteLibrary.getSprite('but_restart'), _oPanelContainer);
        _oButRestart.addEventListener(ON_MOUSE_UP, this._onRestart, this);
        _oButRestart.pulseAnimation();

        _oButHome = new CGfxButton(-110, 80, s_oSpriteLibrary.getSprite('but_home'), _oPanelContainer);
        _oButHome.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        $(s_oMain).trigger("save_score",iScore);        
        
        
    
        $(s_oMain).trigger("share_event",iScore);
        
    };
    
    this.unload = function(){
        _oFade.off("mousedown",_oListener);
        s_oStage.removeChild(_oFade);
        s_oStage.removeChild(_oPanelContainer);
    };

    this._onRestart = function(){
        _oParent.unload();
        s_oGame.restartGame();
        
        $(s_oMain).trigger("end_level",1);
    };
    
    this._onExit = function(){
        
        $(s_oMain).trigger("show_interlevel_ad");

        _oParent.unload();
        
        s_oGame.onExit();
    };
    
    _oParent = this;
    this._init(iScore);

    return this;
}
