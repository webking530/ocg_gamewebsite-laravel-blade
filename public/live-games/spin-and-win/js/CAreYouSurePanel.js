function CAreYouSurePanel() {

    var _oButYes;
    var _oButNo;
    var _oFade;
    var _oPanelContainer;
    var _oParent;
    var _oListener;
    
    var _pStartPanelPos;

    this._init = function () {
        
        
        s_oGame.stopUpdate();
        
        _oFade = new createjs.Shape();
        _oFade.graphics.beginFill("black").drawRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        _oFade.alpha = 0;
        _oListener = _oFade.on("mousedown",function(){});
        s_oStage.addChild(_oFade);
        
        new createjs.Tween.get(_oFade).to({alpha:0.7},500);
        
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
        new createjs.Tween.get(_oPanelContainer).to({y:CANVAS_HEIGHT/2 - 40},500, createjs.Ease.quartIn);
        
        var oTitleStroke = new createjs.Text(TEXT_ARE_SURE," 34px "+THIRD_FONT, "#000000");
        oTitleStroke.y = -oSprite.height/2 + 180;
        oTitleStroke.textAlign = "center";
        oTitleStroke.textBaseline = "middle";
        oTitleStroke.lineWidth = 400;
        //oTitleStroke.outline = 5;
        _oPanelContainer.addChild(oTitleStroke);

        var oTitle = new createjs.Text(TEXT_ARE_SURE," 34px "+THIRD_FONT, "#ffffff");
        oTitle.x = oTitleStroke.x - 4;
        oTitle.y = oTitleStroke.y - 4;
        oTitle.textAlign = "center";
        oTitle.textBaseline = "middle";
        oTitle.lineWidth = 400;
        _oPanelContainer.addChild(oTitle);

        _oButYes = new CGfxButton(110, 80, s_oSpriteLibrary.getSprite('but_yes'), _oPanelContainer);
        _oButYes.addEventListener(ON_MOUSE_UP, this._onButYes, this);

        _oButNo = new CGfxButton(-110, 80, s_oSpriteLibrary.getSprite('but_no'), _oPanelContainer);
        _oButNo.addEventListener(ON_MOUSE_UP, this._onButNo, this);
        _oButNo.pulseAnimation();
    };

    this._onButYes = function () {
        _oButNo.setClickable(false);
        _oButYes.setClickable(false);
        
        new createjs.Tween.get(_oFade).to({alpha:0},500);
        new createjs.Tween.get(_oPanelContainer).to({y:_pStartPanelPos.y},400, createjs.Ease.backIn).call(function(){

            _oParent.unload();
            s_oGame.onExit();
            
        }); 
    };

    this._onButNo = function () {
        s_oGame.startUpdate();
        
        _oButNo.setClickable(false);
        _oButYes.setClickable(false);
        
        new createjs.Tween.get(_oFade).to({alpha:0},500);
        new createjs.Tween.get(_oPanelContainer).to({y:_pStartPanelPos.y},400, createjs.Ease.backIn).call(function(){
            _oParent.unload();
            
        }); 
    };

    this.unload = function () {
        _oButNo.unload();
        _oButYes.unload();

        s_oStage.removeChild(_oFade);
        s_oStage.removeChild(_oPanelContainer);

        _oFade.off("mousedown",_oListener);
    };

    _oParent = this;
    this._init();
}

