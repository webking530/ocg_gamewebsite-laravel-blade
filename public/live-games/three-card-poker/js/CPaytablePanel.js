function CPaytablePanel(iX,iY,oParentContainer){
    var _pStartPosPaytable;
    var _oTextBet;
    var _oTextMult;
    var _oContainer;
    var _oParentContainer;
    
    this._init = function(iX,iY){
        _pStartPosPaytable = {x:iX,y:iY};
        _oContainer = new createjs.Container();
        _oContainer.x = _pStartPosPaytable.x;
        _oContainer.y = _pStartPosPaytable.y;
        _oParentContainer.addChild(_oContainer);
        
        var oSpriteBg = s_oSpriteLibrary.getSprite("paytable_ante_bg");
        var oBg = createBitmap(oSpriteBg);
        _oContainer.addChild(oBg);
        
        var oTextTileAnte = new createjs.Text(TEXT_ANTE_BONUS,"24px "+FONT_GAME_1, "#ffde00");
        oTextTileAnte.x = 10;
        oTextTileAnte.y = 4;
        oTextTileAnte.textAlign = "left";
        oTextTileAnte.lineHeight = 20;
        _oContainer.addChild(oTextTileAnte);
        
        var szText1 = "";
        var szText2 = "";
        for(var i=0;i<PAYOUT_ANTE.length;i++){
            szText1 += TEXT_EVALUATOR[i] + "\n";
            szText2 += PAYOUT_ANTE[i] +":1"+ "\n";
        }
        
        
        _oTextBet = new createjs.Text(szText1,"20px "+FONT_GAME_1, "#ffde00");
        _oTextBet.x = 10;
        _oTextBet.y = oTextTileAnte.y+30;
        _oTextBet.textAlign = "left";
        _oTextBet.lineHeight = 20;
        _oContainer.addChild(_oTextBet);
        
        _oTextMult = new createjs.Text(szText2,"20px "+FONT_GAME_1, "#ffde00");
        _oTextMult.x = oSpriteBg.width - 10;
        _oTextMult.y = oTextTileAnte.y+30;
        _oTextMult.textAlign = "right";
        _oTextMult.lineHeight = 20;
        _oContainer.addChild(_oTextMult);
        
        //ATTACH PAIR PLUS PAYOUTS
        var oBg = createBitmap(s_oSpriteLibrary.getSprite("paytable_pair_plus_bg"));
        oBg.y = oSpriteBg.height +10;
        _oContainer.addChild(oBg);
        
        var oTextTileAnte = new createjs.Text(TEXT_PAIR_PLUS,"24px "+FONT_GAME_1, "#ffde00");
        oTextTileAnte.x = 10;
        oTextTileAnte.y = oBg.y + 4;
        oTextTileAnte.textAlign = "left";
        oTextTileAnte.lineHeight = 20;
        _oContainer.addChild(oTextTileAnte);
        
        var szText1 = "";
        var szText2 = "";
        for(var i=0;i<PAYOUT_PLUS.length;i++){
            szText1 += TEXT_EVALUATOR[i] + "\n";
            szText2 += PAYOUT_PLUS[i] +":1"+ "\n";
        }
        
        
        _oTextBet = new createjs.Text(szText1,"20px "+FONT_GAME_1, "#ffde00");
        _oTextBet.x = 10;
        _oTextBet.y = oTextTileAnte.y+30;
        _oTextBet.textAlign = "left";
        _oTextBet.lineHeight = 20;
        _oContainer.addChild(_oTextBet);
        
        _oTextMult = new createjs.Text(szText2,"20px "+FONT_GAME_1, "#ffde00");
        _oTextMult.x = oSpriteBg.width - 10;
        _oTextMult.y = oTextTileAnte.y+30;
        _oTextMult.textAlign = "right";
        _oTextMult.lineHeight = 20;
        _oContainer.addChild(_oTextMult);
    };
    
    this.refreshButtonPos = function(iNewX,iNewY){
        _oContainer.x = _pStartPosPaytable.x - iNewX;
    };
    
    _oParentContainer = oParentContainer;
    this._init(iX,iY);
}