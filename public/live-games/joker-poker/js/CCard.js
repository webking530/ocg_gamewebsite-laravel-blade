function CCard(iX,iY,oSpriteSheet,oContainer,szFotogram,iRank,iSuit){
    var _bHold;
    var _szFotogram;
    var _iRank;
    var _iSuit;
    
    var _aCbCompleted;
    var _aCbOwner;
    var _aParams;
    
    var _oCardSprite;
    var _oHoldSprite;
    var _oHitArea;
    var _oSelection;
    var _oContainer;
    var _oThisCard;
                
    this._init = function(iX,iY,oSpriteSheet,oContainer,szFotogram,iRank,iSuit){
        _bHold = false;
        _oContainer = oContainer;
        _szFotogram = szFotogram;
        _iRank = iRank;
        _iSuit = iSuit;
        
        
        _oCardSprite = createSprite(oSpriteSheet,"back",CARD_WIDTH/2,CARD_HEIGHT/2,CARD_WIDTH,CARD_HEIGHT);
        _oCardSprite.x = iX;
        _oCardSprite.y = iY;
        _oCardSprite.stop();
        _oCardSprite.shadow = new createjs.Shadow("#000000", 5, 5, 5);
        _oContainer.addChild(_oCardSprite);

        var oSprite = s_oSpriteLibrary.getSprite('card_selection');
        _oSelection = createBitmap(oSprite);
        _oSelection.x = iX;
        _oSelection.y = iY;
        _oSelection.regX = oSprite.width/2;
        _oSelection.regY = oSprite.height/2;
        _oSelection.visible = false;
        _oContainer.addChild(_oSelection);
        
        oSprite = s_oSpriteLibrary.getSprite('hold');
        _oHoldSprite = createBitmap(oSprite);
        _oHoldSprite.regX = oSprite.width/2;
        _oHoldSprite.x = iX;
        _oHoldSprite.y = iY + 66;
        _oHoldSprite.visible = false;
        
        _oContainer.addChild(_oHoldSprite);
        
        _oHitArea = new createjs.Shape();
        _oHitArea.graphics.beginFill("rgba(255,255,255,0.01)").drawRect(iX - (CARD_WIDTH/2), iY - (CARD_HEIGHT/2), CARD_WIDTH, CARD_HEIGHT);
        _oHitArea.on("click",this._onSelected);
        _oHitArea.cursor = "pointer";
        _oContainer.addChild(_oHitArea);
        
        _aCbCompleted=new Array();
        _aCbOwner =new Array();
    };
    
    this.unload = function(){
        _oHitArea.off("click",this._onSelected);
        _oContainer.removeChild(_oCardSprite);
    };
    
    this.reset = function(){
        _bHold = false;
        _oSelection.visible = false;
        _oCardSprite.shadow = new createjs.Shadow("#000000", 5, 5, 5);
    };
    
    this.disable = function(){
        _oContainer.removeChild(_oHitArea);
    };
    
    this.addEventListener = function( iEvent,cbCompleted, cbOwner ){
        _aCbCompleted[iEvent]=cbCompleted;
        _aCbOwner[iEvent] = cbOwner; 
    };
    
    this.addEventListenerWithParams = function( iEvent,cbCompleted, cbOwner,aParams){
        _aCbCompleted[iEvent]=cbCompleted;
        _aCbOwner[iEvent] = cbOwner; 
        
        _aParams = aParams;
    };
    
    this.changeInfo = function(szFotogram,iRank,iSuit){
        _szFotogram = szFotogram;
        _iRank = iRank;
        _iSuit = iSuit;
    };
    
    this.setValue = function(){
        _oCardSprite.gotoAndStop(_szFotogram);
        
        var oParent = this;
        createjs.Tween.get(_oCardSprite).to({scaleX:1}, 200).call(function(){oParent.cardShown()});
    };
    
    this.setHold = function(bHold){
        _bHold = bHold;
        _oHoldSprite.visible = _bHold;
    };
    
    this.toggleHold = function(){
        _bHold = !_bHold;
        _oHoldSprite.visible = _bHold;
        
        playSound("press_hold",1,false);
    };
		
    this.showCard = function(){
        var oParent = this;
        createjs.Tween.get(_oCardSprite).to({scaleX:0.1}, 200).call(function(){oParent.setValue()});
    };
		
    this.hideCard = function(){
        var oParent = this;
        createjs.Tween.get(_oCardSprite).to({scaleX:0.1}, 200).call(function(){oParent.setBack()});
    };
    
    this.setBack = function(){
        _oCardSprite.gotoAndStop("back");
        var oParent = this;
        createjs.Tween.get(_oCardSprite).to({scaleX:1}, 200).call(function(){oParent.cardHidden()});
    };
		
    this.cardShown = function(){
        if(_aCbCompleted[ON_CARD_SHOWN]){
            _aCbCompleted[ON_CARD_SHOWN].call(_aCbOwner[ON_CARD_SHOWN]);
        }
    };
    
    this.cardHidden = function(){
        if(_aCbCompleted[ON_CARD_HIDE]){
            _aCbCompleted[ON_CARD_HIDE].call(_aCbOwner[ON_CARD_HIDE],this);
        }
    };
    
    this.highlight = function(){
        _oCardSprite.shadow = new createjs.Shadow("#fff000", 0, 0, 15);
        _oSelection.visible = true;
    };

    this._onSelected = function(){
        if(_aCbCompleted[ON_CARD_SELECTED]){
            _aCbCompleted[ON_CARD_SELECTED].call(_aCbOwner[ON_CARD_SELECTED],_oThisCard,_aParams);
        }
    };
    
    this.getRank = function(){
        return _iRank;
    };
		
    this.getSuit = function(){
        return _iSuit;
    };

    this.getFotogram = function(){
        return _szFotogram;
    };
    
    this.isHold = function(){
        return _bHold;
    };
    
    _oThisCard = this;
    
    this._init(iX,iY,oSpriteSheet,oContainer,szFotogram,iRank,iSuit);
                
}