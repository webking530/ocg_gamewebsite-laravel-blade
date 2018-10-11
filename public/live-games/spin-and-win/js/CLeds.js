function CLeds (iX, iY, oParentContainer){
    var _szWinColor;
    var _szAnimColor;
    
    var _iLedState;
    var _iTimeElaps;
    var _iNumIdleAnim;
    var _iCurLed;
    var _iCurLed2;
    
    var _aLeds;
    var _aColors;
    var _aLeftList;
    var _aRightList;
    var _aCircularList;
    var _aInverseCircular;
    
    var _oLedsContainer;
    
    this._init = function(iX, iY, oParentContainer){    

        _iNumIdleAnim = 4;
        _iLedState = Math.floor(Math.random()*_iNumIdleAnim);
        _iTimeElaps = 0;
        

        _aLeds = new Array();
        _aColors = new Array();
        _aColors = ["green", "red", "blue", "violet", "yellow"];

        _oLedsContainer = new createjs.Container();
        _oLedsContainer.x = iX;
        _oLedsContainer.y = iY;
        oParentContainer.addChild(_oLedsContainer);

        var oSprite = s_oSpriteLibrary.getSprite('leds');
        var iLedWidth = 70;
        var iLedHeight = 70;
        var oData = {   // image to use
                        images: [oSprite],
                        //framerate:15,
                        // width, height & registration point of each sprite
                        frames: {width: iLedWidth, height: iLedHeight, regX: iLedWidth/2, regY: iLedHeight/2}, 
                        animations: {  off: [0], green: [1], red: [2], blue: [3], violet: [4], yellow: [5], white: [5]}
                        
        };
        var oSpriteSheet = new createjs.SpriteSheet(oData);        

        
        var aLedPos = [
            {x:-143, y:319}, {x:142, y:319},
            {x:-143, y:234}, {x:142, y:234},
            {x:-143, y:149}, {x:142, y:149},
            {x:-143, y:54}, {x:142, y:54},
            {x:-143, y:-46}, {x:142, y:-46},
            {x:-143, y:-150}, {x:142, y:-150},
            {x:-143, y:-260}, {x:142, y:-260},
            {x:-143, y:-360}, {x:142, y:-360},
            {x:-46, y:-360}, {x:51, y:-360},
        ];
        
        for(var i=0; i<aLedPos.length; i++ ){
            _aLeds[i] = createSprite(oSpriteSheet,"off",0,0,iLedWidth,iLedHeight);            
            _aLeds[i].x = aLedPos[i].x;
            _aLeds[i].y = aLedPos[i].y;
            _oLedsContainer.addChild(_aLeds[i]);
        }
        _aLeds[6].visible = false;
        _aLeds[8].visible = false;

        _aLeftList = new Array();
        _aRightList = new Array();
        for(var i=0; i<_aLeds.length; i++ ){
            if(i%2 === 0){
                _aLeftList.push(_aLeds[i]);
            }else {
                _aRightList.push(_aLeds[i]);
            }
        }
        _aCircularList = new Array();
        for(var i=0; i<_aLeds.length; i++){
            if(i<_aLeds.length/2){
                _aCircularList[i] = _aLeftList[i];
            } else {
                _aCircularList[i] = _aRightList[Math.abs(_aLeds.length - i-1)];
            }
        }
        _aInverseCircular = new Array();
        for(var i=0; i<_aLeds.length; i++){
            _aInverseCircular[i] = _aCircularList[_aCircularList.length-1-i];
        }

    };

 
    this.unload = function(){
        oParentContainer.removeChild(_oLedsContainer);
    };
    this.setWinColor = function(szColor){
        _szWinColor = szColor;
    };
    
    this.getState = function(){
        return _iLedState;
    };
    
    this.getNumAnim = function(){
        return _iNumIdleAnim;
    };
    
    this.changeAnim = function(iState){
        _iTimeElaps = 0;
        _iLedState = iState;
        this.turnOffLights();
    };
    
    this.turnOffLights = function(){
        for(var i=0; i<_aLeds.length; i++){
            _aLeds[i].gotoAndStop("off");
        }   
    };
    
    this.animIdle0 = function(){

        if(_iTimeElaps === 0){
            _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)]
            _iCurLed = 0;
        }

        _iTimeElaps += s_iTimeElaps;


        if(_iTimeElaps > ANIM_IDLE1_TIMESPEED){
            
            if(_iCurLed > _aLeftList.length-1){
                _iCurLed = 0;
                this.turnOffLights();
                return;
            }
            
            _aLeftList[_iCurLed].gotoAndStop(_szAnimColor);
            _aRightList[_iCurLed].gotoAndStop(_szAnimColor);
            
            _iCurLed++;
            
            _iTimeElaps = 1;
        }
    };
    
    
    this.animIdle1 = function(){
      
        if(_iTimeElaps === 0){
            _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
            _iCurLed = 0;
            _iCurLed2 = 0;
        }
      
        _iTimeElaps += s_iTimeElaps;
        
        if(_iTimeElaps > ANIM_IDLE2_TIMESPEED){
            
            if(_iCurLed > _aCircularList.length-1){
                
                _aCircularList[_iCurLed2].gotoAndStop("off");
                
                _iCurLed2++;
            
                _iTimeElaps = 1;
                
                if(_iCurLed2 > _aCircularList.length-1){
                    _iTimeElaps = 0;
                }
                
                return;
            }
            
            _aCircularList[_iCurLed].gotoAndStop(_szAnimColor);
            
            _iCurLed++;
            
            _iTimeElaps = 1;
        }
    };
    
    this.animIdle2 = function (){
        
        if(_iTimeElaps === 0){
            _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
            _iCurLed = 0;
            _iCurLed2 = 0;
        }
      
        _iTimeElaps += s_iTimeElaps;
        
        if(_iTimeElaps > ANIM_IDLE2_TIMESPEED){
            
            if(_iCurLed > _aInverseCircular.length-1){
                
                _aInverseCircular[_iCurLed2].gotoAndStop("off");
                
                _iCurLed2++;
            
                _iTimeElaps = 1;
                
                if(_iCurLed2 > _aInverseCircular.length-1){
                    _iTimeElaps = 0;
                }
                
                return;
            }
            
            _aInverseCircular[_iCurLed].gotoAndStop(_szAnimColor);
            
            _iCurLed++;
            
            _iTimeElaps = 1;
        }
    };
 
    this.animIdle3 = function (){
        
        if(_iTimeElaps === 0){
            _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
            _iCurLed = 0;
        }
      
        _iTimeElaps += s_iTimeElaps;
        
        if(_iTimeElaps > ANIM_IDLE3_TIMESPEED){
            if(_iCurLed%2 === 0){
                for(var i=0; i<_aLeftList.length; i++){
                    if(i%2 === 0){
                        _aLeftList[i].gotoAndStop(_szAnimColor);
                        _aRightList[i].gotoAndStop("off");
                    } else {
                        _aLeftList[i].gotoAndStop("off");
                        _aRightList[i].gotoAndStop(_szAnimColor);
                    }
                }   
            }else {
                for(var i=0; i<_aLeftList.length; i++){
                    if(i%2 === 0){
                        _aLeftList[i].gotoAndStop("off");
                        _aRightList[i].gotoAndStop(_szAnimColor);
                    } else {
                        _aLeftList[i].gotoAndStop(_szAnimColor);
                        _aRightList[i].gotoAndStop("off");
                    }
                }   
            }
            
            _iCurLed++;
            _iTimeElaps = 1;
        }
    };
 
    this.animSpin0 = function(){
        if(_iTimeElaps === 0){
            _iCurLed = Math.floor(Math.random()*_aLeftList.length);
            _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
        }
        
        _iTimeElaps += s_iTimeElaps;
        
        if(_iTimeElaps > ANIM_SPIN_TIMESPEED){
            if(_iCurLed < 0){         
                _iCurLed = _aLeftList.length -1;
                _iTimeElaps=1;
            }
            
            if(_iCurLed === _aLeftList.length -1){
                _aLeftList[0].gotoAndStop("off");
                _aLeftList[_aLeftList.length - 1].gotoAndStop(_szAnimColor);
                _aRightList[0].gotoAndStop("off");
                _aRightList[_aLeftList.length - 1].gotoAndStop(_szAnimColor);
                
            }  else {
                _aLeftList[_iCurLed + 1].gotoAndStop("off");
                _aLeftList[_iCurLed].gotoAndStop(_szAnimColor);
                _aRightList[_iCurLed + 1].gotoAndStop("off");
                _aRightList[_iCurLed].gotoAndStop(_szAnimColor);
            }
            
            _iCurLed--;
            _iTimeElaps=1;
        }
    };

    this.animWin0 = function(){
        
        _iTimeElaps += s_iTimeElaps;
        
        if(_iTimeElaps > ANIM_WIN1_TIMESPEED){
            for(var i=0; i<_aLeds.length; i++){
                _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
                _aLeds[i].gotoAndStop(_szAnimColor);
            };
            
            _iTimeElaps=1;
        }
    };
    
    this.animWin1 = function (){
        
        _iTimeElaps += s_iTimeElaps;
        
        _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
        if(_iTimeElaps > ANIM_WIN2_TIMESPEED){
            for(var i=0; i<_aLeds.length; i++){
                _aLeds[i].gotoAndStop(_szAnimColor);
            };

            _iTimeElaps=1;
        }
        
    };
    
    this.animLose = function(){
        _szAnimColor = _aColors[Math.floor(Math.random()*_aColors.length)];
        for(var i=0; i<_aLeds.length; i++){
            _aLeds[i].gotoAndStop(_szAnimColor);
        }
        _iLedState = -1;
    };
    
    this.update = function(){
        
        switch(_iLedState) {
            case 0:{
                    this.animIdle0();
               break;
            } case 1: {
                    this.animIdle1();
               break;              
               
            } case 2: {
                    this.animIdle2();
               break;              
               
            } case 3: {
                    this.animIdle3();
               break;              
               
            } case 4: {
                    this.animSpin0();
               break;              
               
            } case 5: {
                    this.animWin0();
               break;              
               
            } case 6: {
                    this.animWin1();
               break;              
               
            } case 7: {
                    this.animLose();
               break;              
               
            }  

        } 
        
    };
    
    this._init(iX, iY, oParentContainer);
    
}