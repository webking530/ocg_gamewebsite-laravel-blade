function CCircularList(){

    var _aList;
    
    this._init = function(){

        _aList = new Array();
        
    };

    this.addElement = function(oObject, iIndex){
        
        _aList.push({object: oObject, index:iIndex, next: null, prev: null});
    };
    
    this.getElement = function(iIndex){
        return _aList[iIndex];
    };
    
    this.getLength = function(){
        return _aList.length;
    };
    
    this.setCircularList = function(){
        
        for(var i=0; i<_aList.length; i++){
            switch(i){
                    case 0:{
                            _aList[0].next = _aList[1];
                            _aList[0].prev = _aList[_aList.length-1];
                            
                            break;
                    }
                    case _aList.length-1:{
                            _aList[_aList.length-1].next = _aList[0];
                            _aList[_aList.length-1].prev = _aList[_aList.length-2];
                            
                            break;
                    }
                    default: {
                            _aList[i].next = _aList[i+1];
                            _aList[i].prev = _aList[i-1];
                            
                            break;
                    }
                }
        }
    };
    
    this._set1Element = function(){
        _aList[0] = {object: _aList[0].object, next: _aList[0], prev: _aList[0]};
    };
    
    this._setNElements = function(){
        for(var i=0; i<_aList.length; i++){
                switch(i){
                    
                    case 0:{
                            
                            _aList[0] = {object: _aList[0].object, next: _aList[1], prev: _aList[_aList.length-1]};
                            
                            break;
                    }
                    case _aList.length-1:{
                            
                            _aList[_aList.length-1] = {object: _aList[_aList.length-1].object, next: _aList[0], prev: _aList[_aList.length-2]};
                            
                            break;
                    }
                    default: {
                            
                            _aList[i] = {object: _aList[i].object,  prev: _aList[i-1]};
                            

                            _aList[i-i] = {object: _aList[i-1].object, next: _aList[i], prev: _aList[i-2]};

                            
                            
                            break;
                    }
                }
            }
    };
    
    this._init();
    
}


