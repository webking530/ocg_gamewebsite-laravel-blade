function CHelpPanel(){
    var _oText1;
    var _oText1Back;
    var _oText2;
    var _oText2Back;    

    var _oHelpBg;
    var _oGroup;
    var _oParent;

    this._init = function(){
        var oParent = this;
        _oHelpBg = createBitmap(s_oSpriteLibrary.getSprite('bg_help'));
  
        var oText1Pos = {x: CANVAS_WIDTH/2 + 200, y: (CANVAS_HEIGHT/2)-270};
  
        _oText1Back = new createjs.Text(TEXT_HELP1,"40px "+PRIMARY_FONT, "#000000");
        _oText1Back.x = oText1Pos.x+3;
        _oText1Back.y = oText1Pos.y+3;
        _oText1Back.textAlign = "center";
        _oText1Back.textBaseline = "alphabetic";
        _oText1Back.lineWidth = 600;
  
        _oText1 = new createjs.Text(TEXT_HELP1,"40px "+PRIMARY_FONT, "#ffffff");
        _oText1.x = oText1Pos.x;
        _oText1.y = oText1Pos.y;
        _oText1.textAlign = "center";
        _oText1.textBaseline = "alphabetic";
        _oText1.lineWidth = 600;                
  
        var oText2Pos = {x: CANVAS_WIDTH/2 -200, y: (CANVAS_HEIGHT/2)+150};
  
        _oText2Back = new createjs.Text(TEXT_HELP2,"40px "+PRIMARY_FONT, "#000000");
        _oText2Back.x = oText2Pos.x +3;
        _oText2Back.y = oText2Pos.y +3;
        _oText2Back.textAlign = "center";
        _oText2Back.textBaseline = "alphabetic";
        _oText2Back.lineWidth = 600;
  
        _oText2 = new createjs.Text(TEXT_HELP2,"40px "+PRIMARY_FONT, "#ffffff");
        _oText2.x = oText2Pos.x;
        _oText2.y = oText2Pos.y;
        _oText2.textAlign = "center";
        _oText2.textBaseline = "alphabetic";
        _oText2.lineWidth = 600;
     
        
        _oGroup = new createjs.Container();
        _oGroup.addChild(_oHelpBg, _oText1Back,  _oText1, _oText2Back, _oText2);
        _oGroup.alpha=0;
        s_oStage.addChild(_oGroup);

        createjs.Tween.get(_oGroup).to({alpha:1}, 700);        
        
        _oGroup.on("pressup",function(){oParent._onExitHelp();});
     
    };

    this.unload = function(){
        s_oStage.removeChild(_oGroup);

        var oParent = this;
        _oGroup.off("pressup",function(){oParent._onExitHelp()});
    };

    this._onExitHelp = function(){
        _oParent.unload();

    };

    _oParent=this;
    this._init();

}
