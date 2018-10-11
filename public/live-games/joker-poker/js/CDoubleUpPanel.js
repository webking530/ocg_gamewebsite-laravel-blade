function CDoubleUpPanel(oSpriteSheetCard){
    var _bDisableCards;
    var _bWin;
    var _iDealerCardIndex;
    var _aPlayerCard;
    var _aCardInfos;
    var _oDealerInfo;
    var _oCardDealer;
    var _oTextWonAmount;
    var _oTextDoubleAmount;
    var _oTextDoubleHalf;
    var _oButDouble;
    var _oButDoubleHalf;
    var _oButCollect;
    var _oChooseCardText;
    var _oContainer;
    
    var _oThis;
    
    this._init = function(oSpriteSheetCard){
        _bDisableCards = true;
        
        _oContainer = new createjs.Container();
        _oContainer.visible = false;
        s_oStage.addChild(_oContainer);
        
        var oBg = createBitmap(s_oSpriteLibrary.getSprite("bg_doubleup"));
        _oContainer.addChild(oBg);
        
        var oText = new createjs.Text(TEXT_DOUBLE_UP,"70px "+FONT1, "#ffc501");
        oText.x = CANVAS_WIDTH/2;
        oText.y = 20;
        oText.textAlign = "center";
        _oContainer.addChild(oText);
        
        var oTextWon = new createjs.Text(TEXT_YOU_WON,"30px "+FONT1, "#fff");
        oTextWon.x = CANVAS_WIDTH/2 - 200;
        oTextWon.y = 150;
        oTextWon.textAlign = "left";
        _oContainer.addChild(oTextWon);
        
        var oTextDoubleHalfTo = new createjs.Text(TEXT_DOUBLE_HALF_TO,"30px "+FONT1, "#fff");
        oTextDoubleHalfTo.x = CANVAS_WIDTH/2 - 200;
        oTextDoubleHalfTo.y = 200;
        oTextDoubleHalfTo.textAlign = "left";
        _oContainer.addChild(oTextDoubleHalfTo);
        
        var oTextDoubleUpTo = new createjs.Text(TEXT_DOUBLEUP_TO,"30px "+FONT1, "#fff");
        oTextDoubleUpTo.x = CANVAS_WIDTH/2 - 200;
        oTextDoubleUpTo.y = 250;
        oTextDoubleUpTo.textAlign = "left";
        _oContainer.addChild(oTextDoubleUpTo);
        
        _oTextWonAmount = new createjs.Text("0","30px "+FONT1, "#ffc501");
        _oTextWonAmount.x = CANVAS_WIDTH/2 + 200;
        _oTextWonAmount.y = 150;
        _oTextWonAmount.textAlign = "right";
        _oContainer.addChild(_oTextWonAmount);
        
        _oTextDoubleAmount = new createjs.Text("0","30px "+FONT1, "#ffc501");
        _oTextDoubleAmount.x = CANVAS_WIDTH/2 + 200;
        _oTextDoubleAmount.y = 250;
        _oTextDoubleAmount.textAlign = "right";
        _oContainer.addChild(_oTextDoubleAmount);
        
        _oTextDoubleHalf = new createjs.Text("0","30px "+FONT1, "#ffc501");
        _oTextDoubleHalf.x = CANVAS_WIDTH/2 + 200;
        _oTextDoubleHalf.y = 200;
        _oTextDoubleHalf.textAlign = "right";
        _oContainer.addChild(_oTextDoubleHalf);
        
        var oTextDealer = new createjs.Text(TEXT_DEALER_CARD,"20px "+FONT1, "#fff");
        oTextDealer.x = 565;
        oTextDealer.y = 335;
        oTextDealer.textAlign = "center";
        _oContainer.addChild(oTextDealer);
        
        _oButDouble = new CTextButton(CANVAS_WIDTH/2 - 300,700,s_oSpriteLibrary.getSprite("but_menu_bg"),TEXT_DOUBLE,FONT1,"#ffffff",30,_oContainer);
        _oButDouble.addEventListener(ON_MOUSE_UP, this._onButDoubleRelease, this);
        
        _oButDoubleHalf = new CTextButton(CANVAS_WIDTH/2,700,s_oSpriteLibrary.getSprite("but_menu_bg"),TEXT_DOUBLE_HALF,FONT1,"#ffffff",24,_oContainer);
        _oButDoubleHalf.addEventListener(ON_MOUSE_UP, this._onButDoubleHalfRelease, this);
        
        _oButCollect = new CTextButton(CANVAS_WIDTH/2 + 300,700,s_oSpriteLibrary.getSprite("but_menu_bg"),TEXT_COLLECT,FONT1,"#ffffff",30,_oContainer);
        _oButCollect.addEventListener(ON_MOUSE_UP, this._onButCollectRelease, this);
        
        _oChooseCardText = new createjs.Text("","60px "+FONT1, "#fff");
        _oChooseCardText.x = CANVAS_WIDTH/2;
        _oChooseCardText.y = 660;
        _oChooseCardText.textAlign = "center";
        _oContainer.addChild(_oChooseCardText);
        
        //ATTACH DELAER CARD
        _oCardDealer = new CCard(565,490,oSpriteSheetCard,_oContainer,0,0,0);
        
        //ATTACH PLAYER CARDS
        _aPlayerCard = new Array();
        var iX = 878;
        for(var i=0;i<4;i++){
            var oCard = new CCard(iX,490,oSpriteSheetCard,_oContainer,0,0,0);
            oCard.addEventListenerWithParams(ON_CARD_SELECTED,this._onCardSelected,this,i);
        
            _aPlayerCard.push(oCard);
            
            iX += CARD_WIDTH + 4;
        }
    };
    
    this.unload = function(){
        _oButDouble.unload();
        _oButDoubleHalf.unload();
        _oButCollect.unload();
        
        s_oStage.removeChild(_oContainer);   
    };
    
    this.show = function(iWon,iDouble,iDoubleHalf){
        _oButDouble.setVisible(true);
        _oButDoubleHalf.setVisible(true);
        _oButCollect.setVisible(true);
        
        _oTextDoubleAmount.text = (iDouble).toFixed(2)+TEXT_CURRENCY;
        _oTextDoubleHalf.text = (iDoubleHalf).toFixed(2)+TEXT_CURRENCY;
        _oTextWonAmount.text = (iWon).toFixed(2)+TEXT_CURRENCY;

        _oChooseCardText.text = "";
        
        //RESET CARDS
        _oCardDealer.setBack();
        for(var i=0;i<_aPlayerCard.length;i++){
            _aPlayerCard[i].setBack();
        }
        
        _oContainer.visible = true;
    };
    
    this.hide = function(){
        _oContainer.visible = false;
        s_oGame.exitFromDoublePanel();
    };
    
    this._setGuiAfterBet = function(){
        _oButDouble.setVisible(false);
        _oButDoubleHalf.setVisible(false);
        _oButCollect.setVisible(false);
        _oCardDealer.showCard();
        
        _oChooseCardText.text = TEXT_CHOOSE_CARD;

        _bDisableCards = false;
    };
    
    this._hideCards = function(){
        for(var i=0;i<_aPlayerCard.length;i++){
            _aPlayerCard[i].hideCard();
        }
        
        _oCardDealer.hideCard();
        
        _oButDouble.setVisible(true);
        _oButDoubleHalf.setVisible(true);
        _oButCollect.setVisible(true);
        
        _oChooseCardText.text = "";
        
        var iWin = s_oGame.getCurWin();
        var iDouble = iWin*2;
        var iDoubleHalf = iWin*1.5;

        _oTextDoubleAmount.text = (iDouble).toFixed(2)+TEXT_CURRENCY;
        _oTextDoubleHalf.text = (iDoubleHalf).toFixed(2)+TEXT_CURRENCY;
        _oTextWonAmount.text = (iWin).toFixed(2)+TEXT_CURRENCY;
    };
    
    this._onCardSelected = function(oCard,iIndex){
        if(_bDisableCards){
            return;
        }
        _bDisableCards = true;
        
        var iCont = 0;
        if(_bWin){
            var oPlayerCard = _aCardInfos[_iDealerCardIndex+2];
            for(var i=0;i<_aCardInfos.length;i++){

                if(i !== _iDealerCardIndex && i !== _iDealerCardIndex+2){
                    _aPlayerCard[iCont].changeInfo(_aCardInfos[i].fotogram,_aCardInfos[i].rank,_aCardInfos[i].suit);
                    iCont++;
                }
            }
            _oChooseCardText.text = TEXT_YOU_WON;
            playSound("win",1,false);
            
            setTimeout(function(){_oThis._hideCards();},3000);
        }else{
            var oPlayerCard = _aCardInfos[_iDealerCardIndex-1];
            for(var i=0;i<_aCardInfos.length;i++){
                if(i !== _iDealerCardIndex && i !== _iDealerCardIndex-1){
                    _aPlayerCard[iCont].changeInfo(_aCardInfos[i].fotogram,_aCardInfos[i].rank,_aCardInfos[i].suit);
                    iCont++;
                }
            }
            _oChooseCardText.text = TEXT_YOU_LOSE;
            playSound("lose",1,false);
            
            setTimeout(function(){_oThis.hide();},3000);
        }

        _aPlayerCard[iIndex].changeInfo(oPlayerCard.fotogram,oPlayerCard.rank,oPlayerCard.suit);
        
        _aPlayerCard[iIndex].showCard();
    };
    
    this._onButDoubleRelease = function(){
        var oResult = s_oGame.setDoubleBet();
        
        _bWin = oResult.win;
        
        _aCardInfos = oResult.cards;
        _iDealerCardIndex = oResult.dealer_index;
        _oDealerInfo = _aCardInfos[_iDealerCardIndex];

        _oCardDealer.changeInfo(_oDealerInfo.fotogram,_oDealerInfo.rank,_oDealerInfo.suit);
        
        this._setGuiAfterBet();
    };
    
    this._onButDoubleHalfRelease = function(){
        var oResult = s_oGame.setDoubleHalfBet();
        
        _bWin = oResult.win;
        
        _aCardInfos = oResult.cards;
        _iDealerCardIndex = oResult.dealer_index;
        _oDealerInfo = _aCardInfos[_iDealerCardIndex];

        _oCardDealer.changeInfo(_oDealerInfo.fotogram,_oDealerInfo.rank,_oDealerInfo.suit);
        
        this._setGuiAfterBet();
    };
    
    this._onButCollectRelease = function(){
        _oThis.hide();
        s_oGame.collect();
    };
    
    _oThis = this;
    
    this._init(oSpriteSheetCard);
}