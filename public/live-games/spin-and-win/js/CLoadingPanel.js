function CLoadingPanel(){
    var _bStart;
    
    var _iTimeElaps;
    
    var _aDots;
    
    var _oGroup;
    var _oRect;
    var _oListener;
    
    this._init = function(){
        _bStart = true;
      
        _iTimeElaps=0;
      
        _oGroup = new createjs.Container();
        
        var graphics = new createjs.Graphics().beginFill("rgba(0,0,0,0.3)").drawRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        _oRect = new createjs.Shape(graphics);
        _oListener = _oRect.on("click", function(){});
  
        var oSprite = s_oSpriteLibrary.getSprite('logo_game');
        var oLogo = createBitmap(oSprite);
        oLogo.regX = oSprite.width/2;
        oLogo.regY = oSprite.height/2;
        oLogo.x = CANVAS_WIDTH*0.5
        oLogo.y = 500;
        
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
        _aDots = new Array();
        for(var i=0; i<3; i++ ){
            _aDots[i] = createSprite(oSpriteSheet,"violet",0,0,iLedWidth,iLedHeight);            
            _aDots[i].x = CANVAS_WIDTH*0.5 - 72 + i*70;
            _aDots[i].y = CANVAS_HEIGHT*0.5 +50;
        }
        
        
        _oGroup.addChild(_oRect, oLogo, _aDots[0], _aDots[1], _aDots[2]);
        
        s_oStage.addChild(_oGroup);
    };
    
    this.unload = function(){
        _bStart =false;
        _oRect.off("click", _oListener);
        s_oStage.removeChild(_oGroup);
        s_oLoadingPanel = null;
    };
    
    this.update = function(){
        if(_bStart){
            _iTimeElaps += s_iTimeElaps;
        
            if(_iTimeElaps >= 0 && _iTimeElaps < TIME_LOOP_WAIT/4){
                _aDots[0].visible = false;
                _aDots[1].visible = false;
                _aDots[2].visible = false;
            } else if (_iTimeElaps >= TIME_LOOP_WAIT/4 && _iTimeElaps < TIME_LOOP_WAIT*2/4){
                _aDots[0].visible = true;
            } else if (_iTimeElaps >= TIME_LOOP_WAIT*2/4 && _iTimeElaps < TIME_LOOP_WAIT*3/4){
                _aDots[1].visible = true;
            } else if (_iTimeElaps >= TIME_LOOP_WAIT*3/4 && _iTimeElaps < TIME_LOOP_WAIT){
                 _aDots[2].visible = true;
            } else {
                _iTimeElaps = 0;
            }  
        }
    };
    
    this._init();
    
    s_oLoadingPanel = this;
    
}; 

var s_oLoadingPanel = null;