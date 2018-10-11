function CGameSettings(){
    var _aDeckForDoubleBet;
    var _aCardDeck;
    var _aShuffledCardDecks;
    var _aCardValue;
    
    this._init = function(){
        var iSuit = -1;
        _aCardDeck=new Array();
        _aDeckForDoubleBet = new Array();
        for(var j=0;j<52;j++){
            
            var iRest=(j+1)%13;
            if(iRest === 1){
                iRest=14;
                iSuit++;
            }else if(iRest === 0){
                iRest = 13;
            }
            _aCardDeck.push({fotogram:j,rank:iRest,suit:iSuit});
            _aDeckForDoubleBet.push({fotogram:j,rank:iRest,suit:iSuit});
        }
        
        //ADD JOKER
        _aCardDeck.push({fotogram:j,rank:15,suit:0});
    };
	
    this.timeToString = function( iMillisec ){		
        iMillisec = Math.round((iMillisec/1000));

        var iMins = Math.floor(iMillisec/60);
        var iSecs = iMillisec-(iMins*60);

        var szRet = "";

        if ( iMins < 10 ){
                szRet += "0" + iMins + ":";
        }else{
                szRet += iMins + ":";
        }

        if ( iSecs < 10 ){
                szRet += "0" + iSecs;
        }else{
                szRet += iSecs;
        } 

        return szRet;   
    };
		
    this.getShuffledCardDeck = function(){
        var aTmpDeck=new Array();

        for(var i=0;i<_aCardDeck.length;i++){
                aTmpDeck[i]=_aCardDeck[i];
        }

        _aShuffledCardDecks = new Array();
        while (aTmpDeck.length > 0) {
                _aShuffledCardDecks.push(aTmpDeck.splice(Math.round(Math.random() * (aTmpDeck.length - 1)), 1)[0]);
        }
        //_aShuffledCardDecks.unshift({fotogram:46,rank:8,suit:3},{fotogram:48,rank:10,suit:3},{fotogram:32,rank:7,suit:2},{fotogram:31,rank:6,suit:2},{fotogram:30,rank:5,suit:2})
        //_aShuffledCardDecks.unshift({fotogram:30,rank:5,suit:2},{fotogram:48,rank:10,suit:3},{fotogram:32,rank:7,suit:2},{fotogram:31,rank:6,suit:2},{fotogram:52,rank:15,suit:2})
        
        
        return _aShuffledCardDecks;
    };
    
    this.getShuffledDeckForDouble = function(){
        var aTmpDeck=new Array();

        for(var i=0;i<_aDeckForDoubleBet.length;i++){
                aTmpDeck[i]=_aDeckForDoubleBet[i];
        }

        _aDeckForDoubleBet = new Array();
        while (aTmpDeck.length > 0) {
                _aDeckForDoubleBet.push(aTmpDeck.splice(Math.round(Math.random() * (aTmpDeck.length - 1)), 1)[0]);
        }
        
        return _aDeckForDoubleBet;
    };
    
    this.getCardValue = function(iId){
            return _aCardValue[iId];
    };
                
    this._init();
}