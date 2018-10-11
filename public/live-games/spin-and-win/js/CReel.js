function CReel (iX, iY, aInfo, iWindowHeight, oParentContainer, iIndex){

    var _bLoaded;

    var _iCurReelPos;
    var _iRenderWindow;
    
    var _aFirstHalfWindowParams;
    var _aSecondHalfWindowParam;
    
    var _aText;
    var _aColors;
    var _aFrames;
    
    var _oCircularList;
    
    var _oReelContainer;
    
    this._init = function(iX, iY, aInfo, iWindowHeight, oParentContainer, iIndex){    
        
        _bLoaded = false;
        
        _aText = new Array();
        _aColors = new Array();
        
        
        this._initColors();
  
        
        _oReelContainer = new createjs.Container();
        this.setVisible(false);

        oParentContainer.addChild(_oReelContainer);
        
        this._initReel();

    };
 
    this.unload = function(){
        s_oStage.removeChild(_oReelContainer);
        
    };
    
    this._initReel = function(){
        _oCircularList = new CCircularList();
        _aFrames = new Array();
        for(var i=0; i<aInfo.length; i++){
            this._addFrame(aInfo[i], i);
        }
        
        _oCircularList.setCircularList();
        
        this._setReelParameters();

    };
    
    this._addFrame = function(oInfo, iIndex){
        var oSprite = s_oSpriteLibrary.getSprite(oInfo.sprite);
        var iX = 0;
        var iY = 0;     //THIS WILL UPDATE IN RENDER, SO NO MATTER
        
        var oFrame = new CComplexFrame(iX, iY, oSprite, _oReelContainer, oInfo);
        _aFrames.push(oFrame);
        
        var aSegment = oFrame.getFragments();
        for(var i=0; i<aSegment.length; i++){
            aSegment[i].visible = false;            
            _oCircularList.addElement(aSegment[i], iIndex);
        }
    };
    
    this._setReelParameters = function(){
        
        _iCurReelPos = 0;
        _iRenderWindow = iWindowHeight;

        var iFirstHalfWindow = Math.floor(_iRenderWindow/2);
        _aFirstHalfWindowParams = new Array();
        for(var i=0; i<iFirstHalfWindow; i++){
            var iScale = Math.sqrt(1-Math.pow(i/iFirstHalfWindow,2));
            _aFirstHalfWindowParams.push({scalex:iScale, scaley:iScale*2, y:i*PRECISION*iScale}); /////// MULTIPLY scaley WITH SOME NUMBER > 1 WILL INCREASE Y HEIGHT, AND PREVENT SOME ARTIFACT
            
            if(iScale < Math.sqrt(0.5)){
                break;           ////// OPTIMIZATION!!!! WHEN SCALE IS LESS THEN SQRT(1/2) THE WHEEL CURVE IS BEHIND THE RENDERING, SO WE WILL CUT-OFF ITERATION IN RENDER CYCLE
            }
        }
        
        var iSecondHalfWindow = _iRenderWindow - iFirstHalfWindow;
        _aSecondHalfWindowParam = new Array();
        for(var i=0; i<iSecondHalfWindow; i++){
            var iScale = Math.sqrt(1-Math.pow(i/iSecondHalfWindow,2));
            _aSecondHalfWindowParam.push({scalex:iScale, scaley:iScale*2, y:(-i-1)*PRECISION*iScale}); /////// MULTIPLY scaley WITH SOME NUMBER > 1 WILL INCREASE Y HEIGHT, AND PREVENT SOME ARTIFACT
            
            if(iScale < Math.sqrt(0.5)){
                break;           ////// OPTIMIZATION!!!! WHEN SCALE IS LESS THEN SQRT(1/2) THE WHEEL CURVE IS BEHIND THE RENDERING, SO WE WILL CUT-OFF ITERATION IN RENDER CYCLE
            }
        }
    };

    this.render = function(){
        this.clear();
        
        ///////FIRST HALF REEL
        var oCurElement = _oCircularList.getElement(_iCurReelPos);
        //var iCurY = 0;
        
        var iNewY;
        for(var i=0; i<_aFirstHalfWindowParams.length - PRECISION; i++){
            iNewY = _aFirstHalfWindowParams[i].y;

            oCurElement.object.visible = true;

            oCurElement.object.scaleX = _aFirstHalfWindowParams[i].scalex;
            oCurElement.object.scaleY = _aFirstHalfWindowParams[i].scaley;

            oCurElement.object.y = iNewY;

            oCurElement = oCurElement.next;

        }
        ////PREVENT ARTEFACT DUE TO CHILD DEEP IN INDEX
        for(var i=0; i<PRECISION; i++){     
            oCurElement.object.visible = false;
            oCurElement = oCurElement.next;
        };
        
        ///////SECOND HALF REEL
        var oCurElement = _oCircularList.getElement(_iCurReelPos).prev;

        for(var i=0; i<_aSecondHalfWindowParam.length; i++){
            iNewY = _aSecondHalfWindowParam[i].y;

            oCurElement.object.visible = true;

            oCurElement.object.scaleX = _aSecondHalfWindowParam[i].scalex;
            oCurElement.object.scaleY = _aSecondHalfWindowParam[i].scaley;

            oCurElement.object.y = iNewY;

            oCurElement = oCurElement.prev;

        }
        oCurElement.object.visible = false;

    };
    
    this.clear = function(){
        var oCurElement = _oCircularList.getElement(0);
        for(var i=0; i<_oCircularList.getLength(); i++){
            oCurElement.object.visible = false;
            oCurElement = oCurElement.next;
        };
    };
    
    this.getNumSegmentsOfASingleFrame = function(){
        return _aFrames[0].getFragments().length;
    };
    
    this.getNumSegments = function(){
        return _oCircularList.getLength();
    };
    
    this.getFrameIndex = function(iSegmentIndex){
        return _oCircularList.getElement(iSegmentIndex).index;
    };  
    
    this._initColors = function(){
        
    };
    
    this.setText = function(oFrame, oInfo){
        oFrame.setText(TEXT_CURRENCY + oInfo.prize, oInfo.size, oInfo.color, oInfo.stroke, oInfo.strokecolor);
    };
    
    this.setVisible = function(bVal){
        _oReelContainer.visible = bVal;
    };
    
    this.updateText = function(iMult){
        for(var i=0; i<_aFrames.length; i++){      
            var iNewPrize = aInfo[i].prize*iMult;
            _aFrames[i].setText(TEXT_CURRENCY + iNewPrize, aInfo[i].size, aInfo[i].color, aInfo[i].stroke, aInfo[i].strokecolor);
        };
    };
    
    this.getDegree = function(){
        return _iCurReelPos;
    };
    
    this.setDegree = function(iDeg){
        _iCurReelPos = iDeg;
    };

    this.loading = function(){
        if(_bLoaded){
            return;
        }
        
        _bLoaded = true;
        for(var i=0; i<_aFrames.length; i++){
            _aFrames[i].loadFragment();
            
            if(!_aFrames[i].isLoaded()){
                _bLoaded = false;
            }
        }
        
        if(_bLoaded){
            s_oWheel.elementLoaded(iIndex);
        }
        
    };
    
    this.update = function(iRotation){
       
        _iCurReelPos = iRotation;

    };    
        
    this._init(iX, iY, aInfo, iWindowHeight, oParentContainer, iIndex);
    
}