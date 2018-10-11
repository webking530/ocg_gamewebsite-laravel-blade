function CSeat(){ 
    var _iBetAnte;
    var _iBetPlay;
    var _iBetPairPlus;
    var _iPrevAnte;
    var _iPrevPairPlus;
    var _iCardDealedToPlayer;
    var _iCredit;
    var _aFichesOnTable;
    var _aPotentialWins;
    var _vAttachPos;
    
    var _oGroup;
    var _oCardOffset;
    
    var _aFichesController;
    var _aCbCompleted;
    var _aCbOwner;
    
    this._init = function(){
        _oGroup = new createjs.Container();
        _oGroup.x = CANVAS_WIDTH/2 - 160;
        _oGroup.y = 586;

        s_oStage.addChild(_oGroup);

        _aFichesController = new Array();
        for(var k=0;k<3;k++){
            _aFichesController[k] = new CFichesController();
        }       
        
        _iCredit = 0;
        _iBetAnte = 0;
        _iBetPlay = 0;
        _iBetPairPlus = 0;
        this.reset();
        
        _oCardOffset = new CVector2();
        _oCardOffset.set(81,50);
        _vAttachPos=new CVector2(_oCardOffset.getX(),_oCardOffset.getY());

        _aCbCompleted=new Array();
        _aCbOwner =new Array();
    };
    
    this.unload = function(){
        s_oStage.removeChild(_oGroup);
    };
    
    this.addEventListener = function( iEvent,cbCompleted, cbOwner ){
        _aCbCompleted[iEvent]=cbCompleted;
        _aCbOwner[iEvent] = cbOwner; 
    };
    
    this.reset = function(){
        _iCardDealedToPlayer=0;

        for(var i=0;i<_aFichesController.length;i++){
            _aFichesController[i].reset();
        }

        _aFichesOnTable=new Array();
        
        for(var k=0;k<3;k++){
            _aFichesOnTable[k]=new Array();
        }

    };

    
    this.clearBet = function(){
        _iBetAnte = 0;
        _iBetPlay = 0;
        _iBetPairPlus = 0;
        _aFichesOnTable = new Array();
        for(var k=0;k<_aFichesController.length;k++){
            _aFichesController[k].reset();
            _aFichesOnTable[k] = new Array();
        }
    };
    
    this.resetBet = function(){
        _iBetAnte = 0;
        _iBetPlay = 0;
        _iBetPairPlus = 0;
    };

    this.setCredit = function(iNewCredit){
        _iCredit = iNewCredit;
    };
    
    this.increaseCredit = function(iCreditToAdd){
        _iCredit += iCreditToAdd;
    };

    this.betAnte = function(iFicheValue){
        _iBetAnte += iFicheValue;
        _iBetAnte = parseFloat(_iBetAnte.toFixed(2));
        _aFichesController[BET_ANTE].createFichesPile(_iBetAnte,POS_BET[BET_ANTE].x,POS_BET[BET_ANTE].y);
    };
    
    this.betPlay = function(){
        _iBetPlay = _iBetAnte;
        _iBetPlay = parseFloat(_iBetPlay.toFixed(2));
        _aFichesController[BET_PLAY].createFichesPile(_iBetPlay,POS_BET[BET_PLAY].x,POS_BET[BET_PLAY].y);
    };
    
    this.betPairPlus = function(iFicheValue){
        _iBetPairPlus += iFicheValue;
        _iBetPairPlus = parseFloat(_iBetPairPlus.toFixed(2));
        _aFichesController[BET_PLUS].createFichesPile(_iBetPairPlus,POS_BET[BET_PLUS].x,POS_BET[BET_PLUS].y);
    };
    
    this.setPrevBet = function(){
        _iPrevAnte = _iBetAnte;
        _iPrevAnte = parseFloat(_iPrevAnte.toFixed(2));
        _iPrevPairPlus = _iBetPairPlus;
    };
    
    this.decreaseCredit = function(iCreditToSubtract){
        _iCredit -= iCreditToSubtract;
        _iCredit = parseFloat(_iCredit.toFixed(2));
    };
    
    this.refreshFiches = function(iFicheValue,iFicheIndex,iXPos,iYPos,iTypeBet){
        _aFichesOnTable[iTypeBet].push({value:iFicheValue,index:iFicheIndex});
        _aFichesController[iTypeBet].refreshFiches(_aFichesOnTable[iTypeBet],iXPos,iYPos);
    };
    
    this.initMovement = function(iBetIndex,iEndX,iEndY){
        _aFichesController[iBetIndex].initMovement(iEndX,iEndY);
    };

    this.newCardDealed = function(){
        _iCardDealedToPlayer++;
    };
    
    this.rebet = function(){
        _iBetPlay = 0;
        _iBetAnte = _iPrevAnte;
        _iBetPairPlus = _iPrevPairPlus;
        
        this.decreaseCredit(_iPrevAnte+_iPrevPairPlus);
        _aFichesController[BET_ANTE].createFichesPile(_iPrevAnte,POS_BET[BET_ANTE].x,POS_BET[BET_ANTE].y);
        if(_iBetPairPlus > 0){
            _aFichesController[BET_PLUS].createFichesPile(_iPrevPairPlus,POS_BET[BET_PLUS].x,POS_BET[BET_PLUS].y);
        }

        return _iPrevAnte+_iPrevPairPlus;
    };
     
    this.checkIfRebetIsPossible = function(){
        var iTotBet = 0;
        for(var i=0;i<_aFichesController.length;i++){
            var iValue = parseFloat(_aFichesController[i].getPrevBet().toFixed(2));
            iTotBet+= iValue;
        }
        
        if(iTotBet > _iCredit){
            return false;
        }else{
            return true;
        }
    };

    this.updateFichesController = function(){
        for(var i=0;i<_aFichesController.length;i++){
            _aFichesController[i].update();
        }       
    };
    
    this.getAttachCardOffset = function(){
        _vAttachPos.set(_oGroup.x+_oCardOffset.getX()+((CARD_WIDTH + 14)*_iCardDealedToPlayer),
                                                                _oGroup.y+_oCardOffset.getY());
                
        return _vAttachPos;
    };
    
    this.getBetAnte = function(){
        return _iBetAnte;
    };
    
    this.getBetPlay= function(){
        return _iBetPlay;
    };
    
    this.getBetPlus = function(){
        return _iBetPairPlus;
    };
    
    this.getCredit = function(){
        return _iCredit;
    };

    this.getCardOffset = function(){
        return _oCardOffset;
    };

    this.getPotentialWin = function(iIndex){
        return _aPotentialWins[iIndex];
    };
    
    this.getStartingBet = function(){
        var iValue = 0;
        for(var i=0;i<_aFichesController.length;i++){
            iValue += _aFichesController[i].getValue();
        }
        
        return iValue;
    };
    
    this._init();
}