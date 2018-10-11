function CHelpPanel(){
    var _oText1;
    var _oText1Back;
    var _oText2;
    var _oText2Back;    

    var _oFade;
    var _oHelpBg;
    var _oGroup;
    var _oParent;
    var _oListener;

    this._init = function(){
        var oParent = this;
        
        _oFade = new createjs.Shape();
        _oFade.graphics.beginFill("rgba(0,0,0,1)").drawRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
        createjs.Tween.get(_oFade).to({alpha:0.7}, 500);
        
        var oSprite = s_oSpriteLibrary.getSprite('msg_box');
        _oHelpBg = createBitmap(oSprite);
        _oHelpBg.x = CANVAS_WIDTH/2;
        _oHelpBg.y = CANVAS_HEIGHT/2;
        _oHelpBg.regX = oSprite.width/2;
        _oHelpBg.regY = oSprite.height/2;
        
        var oText1Pos = {x: CANVAS_WIDTH/2, y: (CANVAS_HEIGHT/2)};
  
        _oText1Back = new createjs.Text(TEXT_HELP1,"bold 20px "+THIRD_FONT, "#000000");
        _oText1Back.x = oText1Pos.x+3;
        _oText1Back.y = oText1Pos.y+3;
        _oText1Back.textAlign = "center";
        _oText1Back.textBaseline = "middle";
        _oText1Back.lineWidth = 500;
  
        _oText1 = new createjs.Text(TEXT_HELP1,"bold 20px "+THIRD_FONT, "#ffffff");
        _oText1.x = oText1Pos.x;
        _oText1.y = oText1Pos.y;
        _oText1.textAlign = "center";
        _oText1.textBaseline = "middle";
        _oText1.lineWidth = _oText1Back.lineWidth;              
  
  
        //////////////////////// BET CONTROLLER /////////////////////////
        var oControllerContainer = new createjs.Container();
        oControllerContainer.x = CANVAS_WIDTH/2;
        oControllerContainer.y = 680;

        var oSprite = s_oSpriteLibrary.getSprite('bet_panel');
        var oBetBg = createBitmap(oSprite);
        oBetBg.regX = oSprite.width/2;
        oBetBg.regY = oSprite.height/2;
        oBetBg.y = -100;
        oControllerContainer.addChild(oBetBg);

        var oBetNum = new createjs.Text(TEXT_CURRENCY +START_BET.toFixed(2)," 26px "+THIRD_FONT, "#ffffff");
        oBetNum.x = oBetBg.x;
        oBetNum.y = oBetBg.y-2;
        oBetNum.textAlign = "center";
        oBetNum.textBaseline = "middle";
        oBetNum.lineWidth = 400;
        oControllerContainer.addChild(oBetNum);

        var oSprite = s_oSpriteLibrary.getSprite('but_plus');
        var oButPlus = new CTextButton(98, -100, oSprite,TEXT_PLUS,THIRD_FONT,"#ffffff",60, false, oControllerContainer);
        oButPlus.enable();
        oButPlus.setClickable(false);

        var oSprite = s_oSpriteLibrary.getSprite('but_plus');
        var oButMin = new CTextButton(-98,-100, oSprite,TEXT_MIN,THIRD_FONT,"#ffffff",60, false, oControllerContainer);
        oButMin.enable();
        oButMin.setTextPosition(-2,10);
        oButMin.setClickable(false);

        var oText2Pos = {x: CANVAS_WIDTH/2, y: (CANVAS_HEIGHT/2) +100};
  
        _oText2Back = new createjs.Text(TEXT_HELP3,"bold 20px "+THIRD_FONT, "#000000");
        _oText2Back.x = oText2Pos.x +3;
        _oText2Back.y = oText2Pos.y +3;
        _oText2Back.textAlign = "center";
        _oText2Back.textBaseline = "middle";
        _oText2Back.lineWidth = 180;
  
        _oText2 = new createjs.Text(TEXT_HELP3,"bold 20px "+THIRD_FONT, "#ffffff");
        _oText2.x = oText2Pos.x;
        _oText2.y = oText2Pos.y;
        _oText2.textAlign = "center";
        _oText2.textBaseline = "middle";
        _oText2.lineWidth = _oText2Back.lineWidth;
     
        
        var oSpinContainer = new createjs.Container();
        oSpinContainer.x = CANVAS_WIDTH/2 - 170;
        oSpinContainer.y = 760;
        oSpinContainer.scaleX = oSpinContainer.scaleY = 0.5;
        
        var oSprite = s_oSpriteLibrary.getSprite('but_spin');
        var oButSpin = new CTextButton(0,0,oSprite,TEXT_SPIN,THIRD_FONT,"#ffffff",60, false, oSpinContainer);
        oButSpin.enable();
        oButSpin.setClickable(false);
        
        var oSprite = s_oSpriteLibrary.getSprite('swipe_hand');
        var oSwipe = createBitmap(oSprite);
        oSwipe.x = CANVAS_WIDTH/2 + 170;
        var iStartingPos = 745;
        oSwipe.y = iStartingPos;
        oSwipe.regX = oSprite.width/2;
        oSwipe.regY = oSprite.height/2;
        
        createjs.Tween.get(oSwipe, {loop:true}).to({y:iStartingPos +30}, 1000, createjs.Ease.cubicOut);
        
        _oGroup = new createjs.Container();
        _oGroup.addChild(_oFade, _oHelpBg,  _oText1Back,  _oText1, _oText2Back, _oText2, oControllerContainer, oSpinContainer, oSwipe);
        s_oStage.addChild(_oGroup);
 
        
        _oListener = _oGroup.on("pressup",function(){oParent._onExitHelp();});
     
    };

    this.unload = function(){
        s_oStage.removeChild(_oGroup);

        var oParent = this;
        _oGroup.off("pressup",_oListener);
    };

    this._onExitHelp = function(){
        _oParent.unload();

    };

    _oParent=this;
    this._init();

}
