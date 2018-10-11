function CHandEvaluator(){
    var _oOrigSortedHand;
    var _aSortedHand;
    var _aCardIndexInCombo;
    
    this.evaluate = function(aHand){
        _aSortedHand = new Array();
        _oOrigSortedHand = new Array();
        for(var i=0;i<aHand.length;i++){
            _aSortedHand[i] = {rank:aHand[i].rank,suit:aHand[i].suit,index:aHand[i].index};
            _oOrigSortedHand[i] = {rank:aHand[i].rank,suit:aHand[i].suit,index:aHand[i].index};
        }
        
        _aSortedHand.sort(this.compareRank);
        _oOrigSortedHand.sort(this.compareRank);

        _aCardIndexInCombo = new Array(0,1,2,3,4);
        return {ret:this.rankHand(),sort_hand:_oOrigSortedHand};
    };
    
    this.rankHand = function(){
        if(this._checkForRoyalFlush()){
            return ROYAL_FLUSH;
        }else if(this._checkForStraightFlush()){
            return STRAIGHT_FLUSH;
        }else if(this._checkForFourOfAKind()){
            return FOUR_OF_A_KIND;
        }else if(this._checkForFullHouse()){
            return FULL_HOUSE;
        }else if(this._checkForFlush()){
            return FLUSH;
        }else if(this._checkForStraight()){
            return STRAIGHT;
        }else if(this._checkForThreeOfAKind()){
            return THREE_OF_A_KIND;
        }else if(this._checkForTwoPair()){
            return TWO_PAIR;
        }else if(this._checkForOnePair()){
            return ONE_PAIR;
        }else{
            return HIGH_CARD;
        }
    };
    
    this._checkForRoyalFlush = function(){
        if(this._isRoyalStraight() && this._isFlush()){
            return true;
        }else{
            return false;
        }
     };

    this._checkForStraightFlush = function(){
        if(this._isStraight() && this._isFlush()){
            return true;
        }else {
            
            return false;
        }
    };

    this._checkForFourOfAKind = function(){
        if(_aSortedHand[0].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(4,1);
            return true;
        }else if(_aSortedHand[1].rank === _aSortedHand[4].rank || (_aSortedHand[1].rank === CARD_ACE && _aSortedHand[4].rank === CARD_JOKER) ){
            _aSortedHand.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else{
            return false;
        }
    };

    this._checkForFullHouse = function(){
        var bJoker = this.isJokerInHand();
        if(bJoker){
            if( (_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[2].rank === _aSortedHand[3].rank) || 
                        (_aSortedHand[0].rank === _aSortedHand[2].rank && _aSortedHand[3].rank === CARD_ACE) ){
                    return true;
            }
                
        }else if( (_aSortedHand[0].rank === _aSortedHand[1].rank && (_aSortedHand[2].rank === _aSortedHand[4].rank) ) || 
                (_aSortedHand[0].rank === _aSortedHand[2].rank && (_aSortedHand[3].rank === _aSortedHand[4].rank ) ) ){
            return true;
        }else{
            return false;
        }
    };

    this._checkForFlush = function(){
        if(this._isFlush()){
            return true;
        } else{
            return false;
        }
    };

    this._checkForStraight = function(){
        if(this._isStraight()){
            return true;
        } else{
            return false;
        }
     };

    this._checkForThreeOfAKind = function() {
        if(_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[0].rank === _aSortedHand[2].rank){
            _aSortedHand.splice(3,1);
            _aSortedHand.splice(3,1);
            
            _aCardIndexInCombo.splice(3,1);
            _aCardIndexInCombo.splice(3,1);
            return true;
        } else if(_aSortedHand[1].rank === _aSortedHand[2].rank && _aSortedHand[1].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(0,1);
            _aSortedHand.splice(3,1);

            _aCardIndexInCombo.splice(0,1);
            _aCardIndexInCombo.splice(3,1);

            return true;
        }else if(_aSortedHand[2].rank === _aSortedHand[3].rank && (_aSortedHand[2].rank === _aSortedHand[4].rank )){
            _aSortedHand.splice(0,1);
            _aSortedHand.splice(0,1);

            _aCardIndexInCombo.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else if(_aSortedHand[4].rank === CARD_JOKER && _aSortedHand[2].rank === CARD_ACE && _aSortedHand[3].rank === CARD_ACE){
            _aSortedHand.splice(0,1);
            _aSortedHand.splice(0,1);

            _aCardIndexInCombo.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else{
            return false;
        }
    };

    this._checkForTwoPair = function(){
        if(_aSortedHand[0].rank === _aSortedHand[1].rank && _aSortedHand[2].rank === _aSortedHand[3].rank){
            _aSortedHand.splice(4,1);
            _aCardIndexInCombo.splice(4,1);
            return true;
        }else if(_aSortedHand[1].rank === _aSortedHand[2].rank && (_aSortedHand[3].rank === _aSortedHand[4].rank )){
            _aSortedHand.splice(0,1);
            _aCardIndexInCombo.splice(0,1);
            return true;
        }else if(_aSortedHand[0].rank === _aSortedHand[1].rank && (_aSortedHand[3].rank === _aSortedHand[4].rank )){
            _aSortedHand.splice(2,1);
            _aCardIndexInCombo.splice(2,1);
            return true;
        }else{
            return false;
        }
    };

    this._checkForOnePair = function(){
        if(_aSortedHand[4].rank === CARD_JOKER && _aSortedHand[3].rank === CARD_ACE){
            return true;
        }
        
        for(var i = 0; i < 4; i++){
            if(_aSortedHand[i].rank === _aSortedHand[i + 1].rank){
                var p1 = _aSortedHand[i];
                var p2 = _aSortedHand[i + 1];
                _aSortedHand = new Array();
                _aSortedHand.push(p1);
                _aSortedHand.push(p2);
                
                _aCardIndexInCombo = new Array(i,i+1);
                return true;
            }
        }
        
        return false;
    };

    this._isFlush = function(){
        if(    (_aSortedHand[3].suit === _aSortedHand[0].suit )
            && (_aSortedHand[3].suit === _aSortedHand[1].suit )
            && (_aSortedHand[3].suit === _aSortedHand[2].suit ) ){
            
            if(_aSortedHand[4].rank === CARD_JOKER){
                return true;
            }else if( _aSortedHand[4].suit === _aSortedHand[3].suit){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    };
    
    this._isRoyalStraight = function(){
        var bJoker = this.isJokerInHand();
        
        if(bJoker && this._isStraight() && (_aSortedHand[0].rank === CARD_TEN || _aSortedHand[3].rank === CARD_ACE) ){
            return true;
        }else if( (     _aSortedHand[0].rank === CARD_TEN)
                    && (_aSortedHand[1].rank === CARD_JACK )
                    && (_aSortedHand[2].rank === CARD_QUEEN )
                    && (_aSortedHand[3].rank === CARD_KING )
                    && (_aSortedHand[4].rank === CARD_ACE)){
            return true;
        }
        
        return false;
    };

    
    this._isStraight = function() {
        var iNumJoker = this.isJokerInHand()?1:0;
        var iUsedJoker = 0;
        for(var i=0;i<_aSortedHand.length-1-iNumJoker;i++){
            
            var iDiff = _aSortedHand[i+1].rank - (_aSortedHand[i].rank + 1);
            if(iDiff > 0){
                iUsedJoker += iDiff;
                if (iUsedJoker > iNumJoker) {
                       return false;
                } 
           }else if(iDiff < 0){
               return false;
           }
        }
        return true;
    };
    
    this.isJokerInHand = function(){
        if(_aSortedHand[4].rank === CARD_JOKER){
            return true;
        }
        
        return false;
    };
    
    this.compareRank = function(a,b) {
        if (a.rank < b.rank)
           return -1;
        if (a.rank > b.rank)
          return 1;
        return 0;
    };
    
    this.sortCards = function(aCards){
        var aSortedCards = new Array();
        for(var i=0;i<aCards.length;i++){
            aSortedCards[i] = aCards[i];
        }
        
        aSortedCards = aSortedCards.sort(this.compareRank);
        return aSortedCards;
    };
    
}