function CSeat(){ 
    var _iBetAnte;
    var _iPrevAnte;
    var _iCardDealedToPlayer;
    var _iCredit;
    var _aFichesOnTable;
    var _aPotentialWins;
    var _vAttachPos;
    
    var _oGroup;
    var _oPlayerHighHandOffset;
    var _oPlayerLowHandOffset;
    
    var _aFichesController;
    var _aCbCompleted;
    var _aCbOwner;
    
    this._init = function(){
        _oGroup = new createjs.Container();
        _oGroup.x = CANVAS_WIDTH/2 - 100;
        _oGroup.y = 570;

        s_oStage.addChild(_oGroup);

        _aFichesController = new Array();
        for(var k=0;k<2;k++){
            _aFichesController[k] = new CFichesController();
        }       
        
        _iCredit = 0;
        _iBetAnte = 0;
        this.reset();
        
        _oPlayerHighHandOffset = new CVector2(_oGroup.x - 80,_oGroup.y);
        _oPlayerLowHandOffset = new CVector2(_oGroup.x + 200,_oGroup.y);
        _vAttachPos = new CVector2();

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
        _aFichesOnTable = new Array();
        for(var k=0;k<_aFichesController.length;k++){
            _aFichesController[k].reset();
            _aFichesOnTable[k] = new Array();
        }
    };
    
    this.resetBet = function(){
        _iBetAnte = 0;
    };

    this.setCredit = function(iNewCredit){
        _iCredit = iNewCredit;
    };
    
    this.increaseCredit = function(iCreditToAdd){
        _iCredit += iCreditToAdd;
    };

    this.betAnte = function(iFicheValue){
        _iBetAnte += iFicheValue;
        _aFichesController[0].createFichesPile(_iBetAnte,POS_BET.x,POS_BET.y);
    };
    
    this.setPrevBet = function(){
        _iPrevAnte = _iBetAnte;
    };
    
    this.decreaseCredit = function(iCreditToSubtract){
        _iCredit -= iCreditToSubtract;
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
        _iBetAnte = _iPrevAnte;
        this.decreaseCredit(_iPrevAnte);
        _aFichesController[0].createFichesPile(_iPrevAnte,POS_BET.x,POS_BET.y);
        
        return _iPrevAnte;
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
        _vAttachPos.set(_oGroup.x+((CARD_WIDTH/2)*_iCardDealedToPlayer),
                                                                _oGroup.y);
                
        return _vAttachPos;
    };
    
    this.getHighHandAttach = function(){
        return _oPlayerHighHandOffset;
    };
    
    this.getLowHandAttach = function(){
        return _oPlayerLowHandOffset;
    };
    
    this.getBetAnte = function(){
        return _iBetAnte;
    };
    
    this.getCredit = function(){
        return _iCredit;
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