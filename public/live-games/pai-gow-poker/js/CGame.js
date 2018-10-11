function CGame(oData){
    var _bUpdate = false;
    var _bPlayerWinsLowHand;
    var _iTimeElaps;
    var _iMaxBet;
    var _iState;
    var _iCurIndexDeck;
    var _iCurMinWin;
    var _iCardIndexToDeal;
    var _iGameCash;
    var _iCurDealerCardShown;
    var _iNumCardSelected;
    var _iAdsCounter;
    var _iPlayerHighValue;
    var _iDealerHighValue;
    var _iPlayerLowValue;
    var _iPairValueLowHand;
    var _iPairValueHighHand;
    var _iDealerLowValue;
    var _szHandResult;
    var _aHandList;
    var _aPlayerLowHand;
    var _aDealerLowHand;
    var _aPlayerHighHand;
    var _aDealerHighHand;
    var _oActionAfterHandReset;
    
    var _aCardsDealing;
    var _aCardsInCurHandForDealer;
    var _aCardDeck;
    var _aCardsInCurHandForPlayer;
    var _aPlayerCardsInfo;
    var _aDealerCardsInfo;
    var _pStartingPointCard;
    
    var _oStartingCardOffset;
    var _oDealerCardOffset;
    var _oReceiveWinOffset;
    var _oFichesDealerOffset;
    var _oRemoveCardsOffset;
    var _oDealerHighHandOffset;
    var _oDealerLowHandOffset;
    var _oCardContainer;
    var _oHandEvaluator;
    var _oHelpCursorAnte;
    
    var _oBg;
    var _oInterface;
    var _oSeat;
    var _oMsgBox;
    var _oGameOverPanel;
    
    this._init = function(){
        _iMaxBet = MAX_BET;
        _iState = -1;
        _iTimeElaps = 0;
        _iAdsCounter = 0;
        _iCurIndexDeck = 0;

        s_oTweenController = new CTweenController();
        
        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game'));
        s_oStage.addChild(_oBg);

        _oInterface = new CInterface(TOTAL_MONEY);
        
        _oCardContainer = new createjs.Container();
        s_oStage.addChild(_oCardContainer);
        
        _oHandEvaluator = new CHandEvaluator();
        
        _oSeat = new CSeat();
        _oSeat.setCredit(TOTAL_MONEY);
        
        _oHelpCursorAnte = new CHelpCursor(620,390,s_oSpriteLibrary.getSprite("help_cursor"),s_oStage);
        
        this.reset(false);

        _oStartingCardOffset = new CVector2();
        _oStartingCardOffset.set(1214,228);
        
        _oDealerCardOffset = new CVector2(CANVAS_WIDTH/2 - 115,250);
        
        _oDealerHighHandOffset = new CVector2(_oDealerCardOffset.getX() - 65,_oDealerCardOffset.getY());
        _oDealerLowHandOffset = new CVector2(_oDealerCardOffset.getX() + 215,_oDealerCardOffset.getY());
        
        _oReceiveWinOffset = new CVector2();
        _oReceiveWinOffset.set(418,820);
        
        _oFichesDealerOffset = new CVector2();
        _oFichesDealerOffset.set(0,-CANVAS_HEIGHT);
        
        _oRemoveCardsOffset = new CVector2(454,230);

	_oGameOverPanel = new CGameOver();
	
        if(_oSeat.getCredit()<s_oGameSettings.getFichesValueAt(0)){
            this._gameOver();
            this.changeState(-1);
        }else{
            _bUpdate = true;
        }
        
        _pStartingPointCard = new CVector2(_oStartingCardOffset.getX(),_oStartingCardOffset.getY());
        
        _oMsgBox = new CMsgBox();
        this.changeState(STATE_GAME_WAITING_FOR_BET);
    };
    
    this.unload = function(){
	_bUpdate = false;
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.stop();
        }

        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].unload();
        }
        
        _oInterface.unload();
        _oGameOverPanel.unload();
        _oMsgBox.unload();
        s_oStage.removeAllChildren();
    };
    
    this.reset = function(bRebet){
        _iTimeElaps=0;
        _iCurIndexDeck = 0;
        _iCardIndexToDeal=0;
        _iNumCardSelected = 0;
        _oSeat.reset();

        _aCardsDealing=new Array();
        _aCardsDealing.splice(0);
        
        _aCardsInCurHandForDealer = new Array();
        _aCardsInCurHandForPlayer = new Array();
        
        _oInterface.reset();

        _oInterface.enableBetFiches(bRebet);

        this.shuffleCard();
    };
    
    this.shuffleCard = function(){
        _aCardDeck=new Array();
        _aCardDeck=s_oGameSettings.getShuffledCardDeck();
    };
    
    this.changeState = function(iState){
        _iState=iState;
        
        switch(iState){
            case STATE_GAME_WAITING_FOR_BET:{
                    _oInterface.displayMsg(TEXT_DISPLAY_MSG_WAITING_BET,TEXT_MIN_BET+": "+MIN_BET + TEXT_CURRENCY + "\n" + TEXT_MAX_BET+": "+MAX_BET + TEXT_CURRENCY);
                    break;
            }
            case STATE_GAME_DEALING:{
                    _oInterface.disableButtons();
                    _oInterface.displayMsg(TEXT_DISPLAY_MSG_DEALING);
                    this._dealing();
                    break;
            }
            case STATE_GAME_SHOWDOWN:{
                    //SHOW HAND EVALUATION
                    this._showHandEvaluation();
                    break;
            }
        }
    };

    this.cardFromDealerArrived = function(oCard,bDealerCard,iCount){
        if(bDealerCard === false){
            oCard.showCard();
        }
        
        if(iCount<14){
            s_oGame._dealing();
        }
    };
    
    this._cardSplitted = function(oCard,iCount){
        if(iCount === 12){
            //PLAYER HAND SPLIT
            _iCurDealerCardShown = 0;
            _aCardsInCurHandForDealer[0].showCard();
        }else if(iCount === 13){
            //DEALER HAND SPLIT
            s_oGame.changeState(STATE_GAME_SHOWDOWN);
        }
    };
    
    this._showHandEvaluation = function(){
        _oInterface.refreshHandValueText(TEXT_EVALUATOR[_iPlayerHighValue],TEXT_EVALUATOR[_iPlayerLowValue],TEXT_EVALUATOR[_iDealerHighValue],TEXT_EVALUATOR[_iDealerLowValue]);
        this._showWin();
    };
    
    this._showWin = function(){
        var iWinningBet = 0;
        if(_szHandResult === "player"){
            playSound("win", 1, 0);
            if(_bPlayerWinsLowHand){
                //DEALER PAYS 2x BET LESS 5% COMMISSION 
                iWinningBet = (_oSeat.getBetAnte()*2) - (_oSeat.getBetAnte() * 0.05); 
                this._playerWin(iWinningBet);
            }else{
                //STAND OFF
                iWinningBet = _oSeat.getBetAnte()
                this._standOff(iWinningBet);
            }
            
        }else if(_szHandResult === "dealer"){
            playSound("lose", 1, 0);
            if(_bPlayerWinsLowHand){
                //PUSH
                iWinningBet = _oSeat.getBetAnte();
                this._standOff(iWinningBet);
            }else{
                this._playerLose(); 
            }
            
        }
        
        this.changeState(STATE_GAME_DISTRIBUTE_FICHES);
        _oInterface.refreshCredit(_oSeat.getCredit());
        
        setTimeout(function(){
                            _oSeat.resetBet();
                            s_oGame.changeState(STATE_GAME_WAITING_FOR_BET);
                            _oInterface.enableBetFiches(true);
                        },TIME_CARD_REMOVE*3);
    };
    
    this._playerWin = function(iTotWin){

        _oSeat.increaseCredit(iTotWin);
        _iGameCash -= iTotWin;
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_SHOWDOWN,TEXT_DISPLAY_MSG_PLAYER_WIN + " " + iTotWin+TEXT_CURRENCY);

        _oSeat.initMovement(0,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        _oSeat.initMovement(1,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        _oInterface.showResultText(TEXT_HAND_WON_PLAYER);
    };

    this._playerLose = function(){
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_SHOWDOWN,TEXT_DISPLAY_MSG_PLAYER_LOSE);
        _oSeat.initMovement(0,_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());

        _oSeat.initMovement(1,_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());
        
        _oInterface.showResultText(TEXT_HAND_WON_DEALER);
    };
    
    this._standOff = function(iTotWin){
        _oSeat.increaseCredit(iTotWin);
        _iGameCash -= iTotWin;
        
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_SHOWDOWN,TEXT_DISPLAY_MSG_STANDOFF);
        _oSeat.initMovement(0,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        _oSeat.initMovement(1,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        
        _oInterface.showResultText("\n"+TEXT_DISPLAY_MSG_STANDOFF);
    };
    
    this._dealing = function(){
        if(_iCardIndexToDeal<14){
                var oCard = new CCard(_oStartingCardOffset.getX(),_oStartingCardOffset.getY(),_oCardContainer);
                var pEndingPoint;

                //THIS CARD IS FOR THE DEALER
                if((_iCardIndexToDeal%2) === 1){
                    pEndingPoint=new CVector2(_oDealerCardOffset.getX()+((CARD_WIDTH/4)*_iCardIndexToDeal),_oDealerCardOffset.getY());

                    var oInfo = _aDealerCardsInfo.splice(0,1);
                    var iFotogram = oInfo[0].fotogram;
                    var iValue = oInfo[0].rank;
                    var iSuit = oInfo[0].suit;
                    oCard.setInfo(_pStartingPointCard,pEndingPoint,iFotogram,iValue,iSuit,true,_iCardIndexToDeal);
                    oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                    
                    _aCardsInCurHandForDealer.push(oCard);
                }else{
                    var oInfo = _aPlayerCardsInfo.splice(0,1);
                    var iFotogram = oInfo[0].fotogram;
                    var iValue = oInfo[0].rank;
                    var iSuit = oInfo[0].suit;
                    oCard.setInfo(_pStartingPointCard,_oSeat.getAttachCardOffset(),iFotogram,
                                                    iValue,iSuit,false,_iCardIndexToDeal);
                    
                    _oSeat.newCardDealed();
                    _aCardsInCurHandForPlayer.push(oCard);
                }

                _aCardsDealing.push(oCard);
                _iCardIndexToDeal++;

                oCard.addEventListener(ON_CARD_ANIMATION_ENDING,this.cardFromDealerArrived);
                oCard.addEventListener(SPLIT_CARD_END_ANIM,this._cardSplitted);
                playSound("card", 1, 0); 
        }else{
            setTimeout(function(){
                                    s_oGame.changeState(STATE_GAME_PLAYER_TURN);
                                    _oInterface.displayMsg(TEXT_DISPLAY_MSG_USER_TURN);
                                    _oInterface.disableDeal(true);
                                },1000);
            
        }
    };
    
    this._onEndHand = function(){       
        var pRemoveOffset=new CVector2(_oRemoveCardsOffset.getX(),_oRemoveCardsOffset.getY());
        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].initRemoving(pRemoveOffset);
            _aCardsDealing[i].hideCard();
        }

        _oInterface.clearCardValueText();
        _oInterface.clearHandValueText();
        
        _iTimeElaps=0;
        s_oGame.changeState(STATE_GAME_SHOW_WINNER);

        playSound("fiche_collect", 1, 0);
        
        _iAdsCounter++;
        if(_iAdsCounter === AD_SHOW_COUNTER){
            _iAdsCounter = 0;
            $(s_oMain).trigger("show_interlevel_ad");
        }
		
	$(s_oMain).trigger("save_score",[_oSeat.getCredit()]);
    };
    
    this._onCardShown = function(){

        if(_iCurDealerCardShown === 7){
            var iEndX = _oDealerHighHandOffset.getX();
            var iEndY = _oDealerHighHandOffset.getY();
            var iDepth = _aCardsInCurHandForDealer[0].getChildIndex();
            for(var i=0;i<_aDealerHighHand.length;i++){
                _aCardsInCurHandForDealer[_aDealerHighHand[i].index].initSplit(iEndX,iEndY,iDepth);
                iEndX += (CARD_WIDTH/2);
                iDepth++;
            }

            var iEndX = _oDealerLowHandOffset.getX();
            var iEndY = _oDealerLowHandOffset.getY();
            for(var j=0;j<_aDealerLowHand.length;j++){
                _aCardsInCurHandForDealer[_aDealerLowHand[j].index].initSplit(iEndX,iEndY,iDepth);
                iEndX += (CARD_WIDTH/2);
                iDepth++;
            }

            s_oGame.changeState(STATE_GAME_SPLIT_HAND);
        }else{
            s_oGame._showNextDealerCard();
        }
    };
    
    this.setBet = function(iFicheIndex){
        //CHECK IF THERE IS A PREVIOUS HAND TO RESET
        if(_oInterface.isResultPanelvisible()){
            _oInterface.disableBetFiches();
            _oSeat.clearBet();
            _oActionAfterHandReset = this.setBet;
            this._onEndHand();
            return;
        }

        var aFicheValues = s_oGameSettings.getFichesValues();
        var iFicheValue = aFicheValues[iFicheIndex];

        var iTotBet;
        _iTimeElaps = 0;
        _oHelpCursorAnte.hide();
        iTotBet =_oSeat.getBetAnte() + iFicheValue;

        if( iTotBet > _iMaxBet){
            _oMsgBox.show(TEXT_ERROR_MAX_BET);
            return;
        }
        
        if( iTotBet > _oSeat.getCredit()){
            _oInterface.displayMsg(TEXT_NO_MONEY);     
            return;
        }

        _oSeat.decreaseCredit(iFicheValue);
        _iGameCash += iFicheValue;
        _oSeat.betAnte(iFicheValue);
        _oInterface.enable(true,false,false);

        _oInterface.refreshCredit(_oSeat.getCredit());
    };
    
    this.cardSelected = function(bSelected){
        if(bSelected){
            _iNumCardSelected++;
        }else{
            _iNumCardSelected--;
        }
        
        if(_iNumCardSelected === 5){
            _oInterface.enableSplit(true);
        }else{
            _oInterface.enableSplit(false);
        }
    };
    
    this._gameOver = function(){
        _oGameOverPanel.show();
    };
    
    this.onRebet = function(){
        if(_oInterface.isResultPanelvisible()){
            _oActionAfterHandReset = this.rebet;
            this._onEndHand();
            _oHelpCursorAnte.hide();
        }
    };

    this.onDeal = function(){
        if(_oSeat.getBetAnte() < MIN_BET){
            _oMsgBox.show(TEXT_ERROR_MIN_BET);
            _oInterface.enableBetFiches(false);
            _oInterface.enable(false,false,false);

            return;
        }
        $(s_oMain).trigger("bet_placed",_oSeat.getBetAnte());
        
       _oCardContainer.removeAllChildren();
        
        var iRandWin;
        _iCurMinWin = _oSeat.getBetAnte() * 2;
        if(_iGameCash < _iCurMinWin){
            iRandWin = WIN_OCCURRENCE+1;
        }else{
            iRandWin = Math.floor(Math.random()*101);
        }

        if(iRandWin > WIN_OCCURRENCE){
            //LOSE
            do{
                this._generateRandomCards();
            }while(_szHandResult === "player" && _bPlayerWinsLowHand);
           
        }else{
            //WIN
            do{
                this._generateRandomCards();
            }while(_szHandResult !== "player" || !_bPlayerWinsLowHand);
        }

        _oSeat.setPrevBet();
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
        this.changeState(STATE_GAME_DEALING);

    };
    
    this._generateRandomCards = function(){
        _iPairValueLowHand = -1;
        _iPairValueHighHand = -1;

        _aPlayerCardsInfo = this._generateRandCards();
        _aHandList = new Array();
        this._findHandCombinations(_aPlayerCardsInfo,5,0,new Array());

        var oRet = this.getBestHand();
        _aPlayerHighHand = oRet.hand;
        _iPlayerHighValue = oRet.res;
        var oSplitRet = this._split7Hand(_iPlayerHighValue,_aPlayerHighHand,_aPlayerCardsInfo);
        _aPlayerLowHand = oSplitRet.low_hand;
        _aPlayerHighHand = oSplitRet.high_hand;
        
        _aDealerCardsInfo = this._generateRandCards();  
        _aHandList = new Array();
        this._findHandCombinations(_aDealerCardsInfo,5,0,new Array());

        var oRet = this.getBestHand();
        _aDealerHighHand = oRet.hand;
        _iDealerHighValue = oRet.res;
        var oSplitRet = this._split7Hand(_iDealerHighValue,_aDealerHighHand,_aDealerCardsInfo);
        _aDealerLowHand = oSplitRet.low_hand;
        _aDealerHighHand = oSplitRet.high_hand;
        _bPlayerWinsLowHand = this._compareLowHands();
        /*
        trace("****************HOUSE WAY***********************")
        trace("_aPlayerLowHand"+JSON.stringify(_aPlayerLowHand))
        trace("_aDealerLowHand"+JSON.stringify(_aDealerLowHand))
        trace("_aPlayerHighHand "+JSON.stringify(_aPlayerHighHand));
        trace("_aDealerHighHand "+JSON.stringify(_aDealerHighHand));
        trace("_bPlayerWinsLowHand "+_bPlayerWinsLowHand)
        trace("********************************************")*/
         var oRet = this.getWinnerComparingHands(_aPlayerHighHand,_aDealerHighHand);
        _szHandResult = oRet.res;
        
        _iPlayerHighValue = oRet.player_value;
        _iDealerHighValue = oRet.dealer_value;
        
    };
    
    this.getBestHand = function(){
        //FIND THE BEST HAND VALUE
        var iMaxRes = NO_HAND;
        var aBestHand = _aHandList[0];
        for(var i=0;i<_aHandList.length;i++){
            var aHand = _aHandList[i];
            var oRet = _oHandEvaluator.evaluate(aHand);
            if(oRet.ret < iMaxRes){
                iMaxRes = oRet.ret;
                aBestHand = oRet.sort_hand;
            }
        }
     
        return {res:iMaxRes,hand:aBestHand};
    };

    
    this._findHandCombinations = function(aHand, iNumCards, iStartPosition, aResult){
        if (iNumCards === 0){
            var aTmp = new Array();
            for(var k=0;k<aResult.length;k++){
                 aTmp[k] = aResult[k];
            }
            _aHandList.push(aTmp);
            return;
        }       
        for (var i = iStartPosition; i <= aHand.length-iNumCards; i++){
            var iIndex = Math.abs(iNumCards-5);
            aResult[iIndex] = aHand[i];
            this._findHandCombinations(aHand, iNumCards-1, i+1, aResult);
        }
    };
    
    this._compareLowHands = function(){
        _aPlayerLowHand = _oHandEvaluator.sortCards(_aPlayerLowHand);
        _aDealerLowHand = _oHandEvaluator.sortCards(_aDealerLowHand);

        if(_aPlayerLowHand[0].rank === _aPlayerLowHand[1].rank){
            _iPlayerLowValue = ONE_PAIR;
            _iPairValueLowHand = _aPlayerLowHand[0].rank;
            if(_aDealerLowHand[0].rank === _aDealerLowHand[1].rank){
                _iDealerLowValue = ONE_PAIR;
                return _aPlayerLowHand[0].rank>_aDealerLowHand[0].rank?true:false;
            }else{
                _iDealerLowValue = HIGH_CARD;
                return true;
            }
        }else{
            _iPlayerLowValue = HIGH_CARD;
            if(_aDealerLowHand[0].rank === _aDealerLowHand[1].rank){
                _iDealerLowValue = ONE_PAIR;
                return false;
            }else{
                _iDealerLowValue = HIGH_CARD;
                if(_aPlayerLowHand[1].rank === _aDealerLowHand[1].rank || (_aPlayerLowHand[1].rank === CARD_JOKER && _aDealerLowHand[1].rank === CARD_ACE) 
                                                                                    || (_aPlayerLowHand[1].rank === CARD_ACE && _aDealerLowHand[1].rank === CARD_JOKER) ){
                    return _aPlayerLowHand[0].rank>_aDealerLowHand[0].rank?true:false;
                }else{
                    return _aPlayerLowHand[1].rank>_aDealerLowHand[1].rank?true:false;
                }
                
            }
        }
    };
    
    this._split7Hand = function(iEvaluation,aSortedHand,aAllCards){
        var aHighHand = new Array();
        var aLowHand = new Array();

        switch(iEvaluation){
            case ROYAL_FLUSH:
            case STRAIGHT_FLUSH:
            case STRAIGHT:
            case FLUSH:{
                    for(var i=0;i<aSortedHand.length;i++){
                        aHighHand.push(aSortedHand[i]);
                    }
                    
                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    break;
            }
            case FOUR_OF_A_KIND:{
                    var iRank = aSortedHand[1].rank;
                    if(iRank < 7){
                        if(aSortedHand[1].rank === aSortedHand[0].rank){
                            aHighHand.push(aSortedHand[0]);
                            aHighHand.push(aSortedHand[1]);
                            aHighHand.push(aSortedHand[2]);
                            aHighHand.push(aSortedHand[3]);
                        }else{
                            aHighHand.push(aSortedHand[1]);
                            aHighHand.push(aSortedHand[2]);
                            aHighHand.push(aSortedHand[3]);
                            aHighHand.push(aSortedHand[4]);
                        }
                        
                        var aRemainings= this.getRemainingCards(aAllCards,aHighHand,aLowHand);
                        aRemainings = _oHandEvaluator.sortCards(aRemainings);
                        aLowHand.push(aRemainings[aRemainings.length-1]);
                    }else{
                        if(aSortedHand[1].rank === aSortedHand[0].rank){
                            aHighHand.push(aSortedHand[0]);
                            aHighHand.push(aSortedHand[1]);
                            aLowHand.push(aSortedHand[2]);
                            aLowHand.push(aSortedHand[3]);
                        }else{
                            aHighHand.push(aSortedHand[1]);
                            aHighHand.push(aSortedHand[2]);
                            aLowHand.push(aSortedHand[3]);
                            aLowHand.push(aSortedHand[4]);
                        }
                        
                        var aRemainings= this.getRemainingCards(aAllCards,aHighHand,aLowHand);
                        aRemainings = _oHandEvaluator.sortCards(aRemainings);
                        aHighHand.push(aRemainings[aRemainings.length-1]);
                    }
                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    
                    break;
            }
            case FULL_HOUSE:{
                    if(aSortedHand[2].rank > aSortedHand[1].rank){
                        aHighHand.push(aSortedHand[2]);
                        aHighHand.push(aSortedHand[3]);
                        aHighHand.push(aSortedHand[4]);
                        aLowHand.push(aSortedHand[0]);
                        aLowHand.push(aSortedHand[1]);
                    }else{
                        aHighHand.push(aSortedHand[0]);
                        aHighHand.push(aSortedHand[1]);
                        aHighHand.push(aSortedHand[2]);
                        aLowHand.push(aSortedHand[3]);
                        aLowHand.push(aSortedHand[4]);
                    }
                    
                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    break;
            }
            case THREE_OF_A_KIND:{
                   
                    var a3OfKind = new Array();
                    if(aSortedHand[2].rank === aSortedHand[1].rank && aSortedHand[0].rank === aSortedHand[1].rank){
                        a3OfKind.push(aSortedHand[0]);
                        a3OfKind.push(aSortedHand[1]);
                        a3OfKind.push(aSortedHand[2]);
                        
                    }else if(aSortedHand[2].rank === aSortedHand[1].rank && aSortedHand[2].rank === aSortedHand[3].rank){
                        a3OfKind.push(aSortedHand[1]);
                        a3OfKind.push(aSortedHand[2]);
                        a3OfKind.push(aSortedHand[3]);
                    }else{
                        a3OfKind.push(aSortedHand[2]);
                        a3OfKind.push(aSortedHand[3]);
                        a3OfKind.push(aSortedHand[4]);
                    }

                    aHighHand.push(a3OfKind[0]);
                    aHighHand.push(a3OfKind[1]);
                    aHighHand.push(a3OfKind[2]);

                    var aRemainings= this.getRemainingCards(aAllCards,aHighHand,aLowHand);
                    aRemainings = _oHandEvaluator.sortCards(aRemainings);
                    aLowHand.push(aRemainings[aRemainings.length-1]);
                    aLowHand.push(aRemainings[aRemainings.length-2]);
                        
                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    break;
            }
            case TWO_PAIR:{
                    var iSecondPairValue = 0;
                    var aLowPair = new Array();
                    var aHighPair = new Array();

                    if(aSortedHand[0].rank === aSortedHand[1].rank){
                        aLowPair.push(aSortedHand[0]);
                        aLowPair.push(aSortedHand[1]);
                    }else if(aSortedHand[1].rank === aSortedHand[2].rank){
                        aLowPair.push(aSortedHand[1]);
                        aLowPair.push(aSortedHand[2]);
                    }
                    
                    if(aSortedHand[2].rank === aSortedHand[3].rank){
                        iSecondPairValue = aSortedHand[2].rank;
                        aHighPair.push(aSortedHand[2]);
                        aHighPair.push(aSortedHand[3]);
                    }else if(aSortedHand[3].rank === aSortedHand[4].rank){
                        iSecondPairValue = aSortedHand[3].rank;

                        aHighPair.push(aSortedHand[3]);
                        aHighPair.push(aSortedHand[4]);
                    }
                    
                    var aRemainings= this.getRemainingCards(aAllCards,aHighHand,aLowHand);
                    aRemainings = _oHandEvaluator.sortCards(aRemainings);
                    if(iSecondPairValue>CARD_TEN ){
                        aLowHand.push(aLowPair[0]);
                        aLowHand.push(aLowPair[1]);
                        aHighHand.push(aHighPair[0]);
                        aHighHand.push(aHighPair[1]);
                    }else if(iSecondPairValue >CARD_SIX && iSecondPairValue <CARD_JACK){
                        if(aRemainings[aRemainings.length-1].rank === CARD_ACE || aRemainings[aRemainings.length-1].rank === CARD_JOKER){
                            aHighHand.push(aLowPair[0]);
                            aHighHand.push(aLowPair[1]);
                            aHighHand.push(aHighPair[0]);
                            aHighHand.push(aHighPair[1]);
                            aLowHand.push(aRemainings[aRemainings.length-1]);
                        }else{
                            aLowHand.push(aLowPair[0]);
                            aLowHand.push(aLowPair[1]);
                            aHighHand.push(aHighPair[0]);
                            aHighHand.push(aHighPair[1]);
                        }
                    }else{
                        if(aRemainings[aRemainings.length-1].rank > CARD_QUEEN){
                            aHighHand.push(aLowPair[0]);
                            aHighHand.push(aLowPair[1]);
                            aHighHand.push(aHighPair[0]);
                            aHighHand.push(aHighPair[1]);
                            aLowHand.push(aRemainings[aRemainings.length-1]);
                        }else{
                            aLowHand.push(aLowPair[0]);
                            aLowHand.push(aLowPair[1]);
                            aHighHand.push(aHighPair[0]);
                            aHighHand.push(aHighPair[1]);
                        }
                    }

                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    break;
            }
            case ONE_PAIR:{
                    var aPair = new Array();
                    
                    if(aSortedHand[4].rank === CARD_JOKER && aSortedHand[3].rank === CARD_ACE){
                        aPair.push(aSortedHand[3]);
                        aPair.push(aSortedHand[4]);
                    }else{
                        for(var i=0;i<aSortedHand.length-1;i++){
                            if(aSortedHand[i].rank === aSortedHand[i+1].rank){
                                aPair.push(aSortedHand[i]);
                                aPair.push(aSortedHand[i+1]);
                                break;
                            }
                        }
                    }
                    
                    
                    aHighHand.push(aPair[0]);
                    aHighHand.push(aPair[1]);
                    _iPairValueHighHand = aPair[0].rank;

                    var aRemainings= this.getRemainingCards(aAllCards,aHighHand,aLowHand);
                    aRemainings = _oHandEvaluator.sortCards(aRemainings);
                    aLowHand.push(aRemainings[aRemainings.length-1]);
                    aLowHand.push(aRemainings[aRemainings.length-2]);

                    var oRet = this._fillHandWithRemaining(aAllCards,aHighHand,aLowHand);
                    aHighHand = oRet.high;
                    aLowHand = oRet.low;
                    break;
            }
            default:{
                var aSorted7Cards = _oHandEvaluator.sortCards(aAllCards);

                aLowHand.push(aSorted7Cards[aSorted7Cards.length-2]);
                aLowHand.push(aSorted7Cards[aSorted7Cards.length-3]);

                var oRet = this._fillHandWithRemaining(aSorted7Cards,aHighHand,aLowHand);
                aHighHand = oRet.high;
                aLowHand = oRet.low;
            }
        }
        
        return {high_hand:aHighHand,low_hand:aLowHand};
    };
    
    this.getRemainingCards = function(aFullHand,aHighHand,aLowHand){
        var aRemainings = new Array();
        for(var k=0;k<aFullHand.length;k++){
            var bFound = false;
            var oCard = aFullHand[k];
            
            for(var i=0;i<aHighHand.length;i++){
                
                if(aHighHand[i].rank === oCard.rank && aHighHand[i].suit === oCard.suit){
                    bFound = true;
                    break;
                }
            }
            
            for(var i=0;i<aLowHand.length;i++){
                if(aLowHand[i].rank === oCard.rank && aLowHand[i].suit === oCard.suit){
                    bFound = true;
                    break;
                }
            }
            
            if(!bFound){
                aRemainings.push(oCard);
            }
        }
        
        return aRemainings;
    };
    
    this._fillHandWithRemaining = function(aFullHand,aHighHand,aLowHand){
        var aRemainings = this.getRemainingCards(aFullHand,aHighHand,aLowHand);

        var iIndex = 0;
        while(aHighHand.length < 5){
            aHighHand.push(aRemainings[iIndex]);
            iIndex++;
        }
        
        while(aLowHand.length < 2){
            aLowHand.push(aRemainings[iIndex]);
            iIndex++;
        }
        
        return {high:aHighHand,low:aLowHand};
    };
    
    this.onHouseWay = function(){
        _oInterface.disableButtons();
        
        var iEndX = _oSeat.getHighHandAttach().getX();
        var iEndY = _oSeat.getHighHandAttach().getY();
        var iDepth = _aCardsInCurHandForPlayer[0].getChildIndex();
        for(var i=0;i<_aPlayerHighHand.length;i++){
            _aCardsInCurHandForPlayer[_aPlayerHighHand[i].index].initSplit(iEndX,iEndY,iDepth);
            iEndX += (CARD_WIDTH/2);
            iDepth++;
        }
        
        var iEndX = _oSeat.getLowHandAttach().getX();
        var iEndY = _oSeat.getLowHandAttach().getY();
        for(var j=0;j<_aPlayerLowHand.length;j++){
            _aCardsInCurHandForPlayer[_aPlayerLowHand[j].index].initSplit(iEndX,iEndY,iDepth);
            iEndX += (CARD_WIDTH/2);
            iDepth++;
        }
        
        this.changeState(STATE_GAME_SPLIT_HAND);
    };
    
    this.onSplitHand = function(){
        _aPlayerHighHand = new Array();
        _aPlayerLowHand = new Array();
        for(var i=0;i<_aCardsInCurHandForPlayer.length;i++){
            if(_aCardsInCurHandForPlayer[i].isSelected()){
                _aPlayerHighHand.push({rank:_aCardsInCurHandForPlayer[i].getValue(),suit:_aCardsInCurHandForPlayer[i].getSuit(),index:i});
            }else{
                _aPlayerLowHand.push({rank:_aCardsInCurHandForPlayer[i].getValue(),suit:_aCardsInCurHandForPlayer[i].getSuit(),index:i});
            }
        }
        
        _bPlayerWinsLowHand = this._compareLowHands();
        
        _aPlayerHighHand = _oHandEvaluator.sortCards(_aPlayerHighHand);
        var oRet = this.getWinnerComparingHands(_aPlayerHighHand,_aDealerHighHand);
        _szHandResult = oRet.res;
        _iPlayerHighValue = oRet.player_value;
        _iDealerHighValue = oRet.dealer_value;
        /*
        trace("****************SPLIT***********************")
        trace("_aPlayerLowHand"+JSON.stringify(_aPlayerLowHand))
        trace("_aDealerLowHand"+JSON.stringify(_aDealerLowHand))
        trace("_aPlayerHighHand "+JSON.stringify(_aPlayerHighHand));
        trace("_aDealerHighHand "+JSON.stringify(_aDealerHighHand));
        trace("_bPlayerWinsLowHand "+_bPlayerWinsLowHand)
        trace("_szHandResult: "+_szHandResult)
        trace("_iPairValueLowHand: "+_iPairValueLowHand);
        trace("_iPairValueHighHand: "+_iPairValueHighHand)
       */
        if(this._checkIfHighHandBetterThanLow()){
            this.onHouseWay();
        }else{
            _oMsgBox.show(TEXT_ERROR_BIGGER_LOW_HAND);
        }
        
        
    };
    
    this._checkIfHighHandBetterThanLow = function(){
        if(_iPlayerLowValue < _iPlayerHighValue){
            return false
        }else if(_iPlayerHighValue === _iPlayerLowValue){
            if(_iPairValueLowHand > _iPairValueHighHand){
                return false;
            }
        }
        
        return true;
    };
    
    this.getWinnerComparingHands = function(aHandPlayer,aHandDealer){
        var iHandPlayerValue = _oHandEvaluator.evaluate(aHandPlayer).ret;
        var iHandDealerValue = _oHandEvaluator.evaluate(aHandDealer).ret;

        var szWinner = "dealer";
        if(iHandPlayerValue === iHandDealerValue){
            switch(iHandPlayerValue){
                case STRAIGHT_FLUSH:{
                        if(aHandPlayer[0].suit >= aHandDealer[0].suit){
                            szWinner = "dealer";
                        }else if(aHandPlayer[0].suit < aHandDealer[0].suit){
                            szWinner = "player";
                        }
			break;
                }
                case FOUR_OF_A_KIND:{
                        if(aHandPlayer[1].rank > aHandDealer[1].rank){
                            szWinner = "player"
                        }else if(aHandPlayer[1].rank <= aHandDealer[1].rank){
                            szWinner = "dealer";
                        }
			break;
                }
                case FULL_HOUSE:{
                        if(aHandPlayer[3].rank > aHandDealer[3].rank){
                            szWinner = "player";
                        }else if(aHandPlayer[3].rank <= aHandDealer[3].rank){
                            szWinner = "dealer";
                        }
			break;
                }
                case FLUSH:{
                        if(aHandPlayer[0].suit >= aHandDealer[0].suit){
                            szWinner = "dealer";
                        }else if(aHandPlayer[0].suit < aHandDealer[0].suit){
                            szWinner = "player";
                        }
			break;
                }
                case STRAIGHT:{
                        if(aHandPlayer[3].rank > aHandDealer[3].rank){
                            szWinner = "player";
                        }else if(aHandPlayer[3].rank <= aHandDealer[3].rank){
                            szWinner = "dealer";
                        }
			break;
                }
                case THREE_OF_A_KIND:{
                        if(aHandPlayer[2].rank > aHandDealer[2].rank){
                            szWinner = "player";
                        }else if(aHandPlayer[2].rank <= aHandDealer[2].rank){
                            szWinner = "dealer";
                        }
			break;
                }
                case TWO_PAIR:{
                       var iValue1 = 0;
                        for(var i=aHandPlayer.length-1;i>1;i--){
                            if(aHandPlayer[i].rank === aHandPlayer[i-1].rank){
                                iValue1 = aHandPlayer[i].rank;
                                break;
                            }
                        }
                        
                        var iValue2 = 0;
                        for(var i=aHandDealer.length-1;i>1;i--){
                            if(aHandDealer[i].rank === aHandDealer[i-1].rank){
                                iValue2 = aHandDealer[i].rank;
                                break;
                            }
                        } 

                        if(iValue1 > iValue2){
                            szWinner = "player";
                        }else if (iValue1 <= iValue2){
                            szWinner = "dealer";
                        }
			break;
                }
                case ONE_PAIR:{
                        var iValue1 = 0;
                        for(var i=0;i<aHandPlayer.length-1;i++){
                            if(aHandPlayer[i].rank === aHandPlayer[i+1].rank || (aHandPlayer[i].rank === CARD_ACE && aHandPlayer[i+1].rank === CARD_JOKER)){
                                iValue1 = aHandPlayer[i].rank;
                                break;
                            }
                        }

                        _iPairValueHighHand = iValue1;
                        
                        var iValue2 = 0;
                        for(var i=0;i<aHandDealer.length-1;i++){
                            if(aHandDealer[i].rank === aHandDealer[i+1].rank || (aHandDealer[i].rank === CARD_ACE && aHandDealer[i+1].rank === CARD_JOKER)){
                                iValue2 = aHandDealer[i].rank;
                                break;
                            }
                        }
                        
                        if(iValue1 > iValue2){
                            szWinner = "player";
                        }else{
                            szWinner = "dealer";
                        }
			break;
                }
                case HIGH_CARD:{
                        var iIndexToCompare = aHandDealer.length-1;
                        if(aHandDealer[iIndexToCompare].rank === aHandPlayer[iIndexToCompare].rank 
                                || (aHandDealer[iIndexToCompare].rank === CARD_JOKER &&  aHandPlayer[iIndexToCompare].rank === CARD_ACE) 
                                || (aHandDealer[iIndexToCompare].rank === CARD_ACE &&  aHandPlayer[iIndexToCompare].rank === CARD_JOKER) ){
                            do{
                                iIndexToCompare--;
                            }while(aHandDealer[iIndexToCompare].rank === aHandPlayer[iIndexToCompare].rank && iIndexToCompare >= 0);
                            
                            if(aHandDealer[iIndexToCompare].rank < aHandPlayer[iIndexToCompare].rank){
                                szWinner = "player" ;
                            }else{
                                szWinner = "dealer";
                            }
                        }else if(aHandDealer[aHandDealer.length-1].rank > aHandPlayer[aHandPlayer.length-1].rank){
                            szWinner = "dealer";
                        }else{
                            szWinner = "player";
                        }
                        break;
                }
            }
            return {res:szWinner,player_value:iHandPlayerValue,dealer_value:iHandDealerValue};
        }else{
            szWinner = iHandPlayerValue>iHandDealerValue?"dealer":"player";
            return {res:szWinner,player_value:iHandPlayerValue,dealer_value:iHandDealerValue};
        }
    };
    
    this._showNextDealerCard = function(){
        _aCardsInCurHandForDealer[_iCurDealerCardShown].showCard();
        _iCurDealerCardShown++;
    };
    
    this._generateRandCards = function(){
        var aCards = new Array();
        for(var i=0;i<7;i++){
            aCards.push({fotogram:_aCardDeck[_iCurIndexDeck].fotogram,rank:_aCardDeck[_iCurIndexDeck].rank,suit:_aCardDeck[_iCurIndexDeck].suit,index:i});
            _iCurIndexDeck++;
            this._checkDeckLength();
        }
        
        return aCards;
    };

    
    this._checkDeckLength = function(){
        if(_iCurIndexDeck >= _aCardDeck.length){
            _aCardDeck = s_oGameSettings.getShuffledCardDeck();
            _iCurIndexDeck = 0;
        }
    };
    
    this.clearBets = function(){
        if(_iState !== STATE_GAME_WAITING_FOR_BET){
            return;
        }
        _oInterface.enable(false,false,false);
        
        var iCurBet = _oSeat.getStartingBet();
        if(iCurBet>0){
            _oSeat.clearBet();
            _oSeat.increaseCredit(iCurBet);
            _iGameCash -= iCurBet;
            _oInterface.refreshCredit(_oSeat.getCredit());
            var bRebet = _oSeat.checkIfRebetIsPossible();
            _oInterface.enableBetFiches(bRebet);
        }
    };
    
    this.rebet = function(){
        this.clearBets();
        var iCurBet = _oSeat.rebet();
        _iGameCash -= iCurBet;
        
        _oInterface.enable(true,false,false);
        _oInterface.refreshCredit(_oSeat.getCredit());
        _iTimeElaps = BET_TIME;
    };
           
    this.onExit = function(){
        this.unload();
        
        $(s_oMain).trigger("end_session");
        $(s_oMain).trigger("share_event",_oSeat.getCredit());
        s_oMain.gotoMenu();
        
    };
    
    this.getState = function(){
        return _iState;
    };
    
    this._updateCards = function(){
        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].update();
        }
    };
    
    this._updateFiches = function(){
        _oSeat.updateFichesController();
    };
    
    this._updateShowWinner = function(){
        for(var k=0;k<_aCardsDealing.length;k++){
            _aCardsDealing[k].update();
        }

        _iTimeElaps+=s_iTimeElaps;
        if(_iTimeElaps>TIME_END_HAND){
            _iTimeElaps=0;
            var bRebet = _oSeat.checkIfRebetIsPossible();

            this.reset(bRebet);
            _oInterface.reset();

            if(_oSeat.getCredit()<s_oGameSettings.getFichesValueAt(0)){
                    this._gameOver();
                    this.changeState(-1);
            }else{
                if(_oSeat.getCredit()<s_oGameSettings.getFichesValueAt(0)){
                    this._gameOver();
                    this.changeState(-1);
                }else{
                    //EXECUTE USER ACTION BEFORE END HAND
                    this.changeState(STATE_GAME_WAITING_FOR_BET);
                    _oActionAfterHandReset.call(this,_oInterface.getFicheSelected());
                }
                    
            }
        }
        
    };
    
    this.update = function(){
        if(_bUpdate === false){
            return;
        }

        switch(_iState){
            case STATE_GAME_WAITING_FOR_BET:{
                    _iTimeElaps+=s_iTimeElaps;
                    if( _iTimeElaps > 6000){
                        _iTimeElaps = 0;
                        if(!_oHelpCursorAnte.isVisible() && _oSeat.getBetAnte() === 0){
                            //SHOW IT NEAR ANTE BET
                            _oHelpCursorAnte.show(1);
                        }
                        
                    }
                    break;
            }
            case STATE_GAME_DEALING:{
                    this._updateCards();
                    break;
            }
            case STATE_GAME_SPLIT_HAND:{
                     this._updateCards();
                    break;
            }
            case STATE_GAME_DISTRIBUTE_FICHES:{
                    this._updateFiches();
                    break;
            }
            case STATE_GAME_SHOW_WINNER:{
                    this._updateShowWinner();
                    break;
            }
        }
        
	
    };
    
    s_oGame = this;

    TOTAL_MONEY      = oData.money;
    MIN_BET          = oData.min_bet;
    MAX_BET          = oData.max_bet;
    BET_TIME         = oData.bet_time;
    WIN_OCCURRENCE   = oData.win_occurrence;
    _iGameCash       = oData.game_cash;
    TIME_END_HAND    = oData.time_show_hand;
    ENABLE_FULLSCREEN = oData.fullscreen;
    AD_SHOW_COUNTER  = oData.ad_show_counter; 
    
    this._init();
}

var s_oGame;
var s_oTweenController;