function CWheel(){
    
    var _bIsLoaded;
    
    var _iState;
    var _iCntFrames;
    var _iMaxFrames;
    var _iStartRotationToAdd;
    var _iFinalRotationToAdd;
    
    var _iCurReelVisualized;
    var _iCurRotation;
    
    var _oListenerMouseDown;
    var _oListenerMouseMove;
    var _oListenerMouseUp;
    var _iMouseStartY;
    var _iMouseCurY;
    var _iStrenght;
    
    
    var _aReels;
    
    var _oWheel;
    
    var _pWheelPos;
    
    this._init = function(iX, iY){
        
        _bIsLoaded = false;
        
        _iState = WHEEL_IDLE;
        _iCntFrames = 0;
        _iMaxFrames = Math.floor(FPS*WHEEL_SPIN_TIME); /// 10 seconds
        
        _iCurRotation = 0;
        
        _pWheelPos = {cur:_iCurRotation};
        
        if(s_bMobile){
            PRECISION = 3;
        }else {
            PRECISION = 1;
        }
        
        _oWheel = new createjs.Container();
        _oWheel.visible = false;
        
        var oSprite = s_oSpriteLibrary.getSprite('wheel_back');
        var oBg = createBitmap(oSprite);
        oBg.y = 16;
        oBg.regX = oSprite.width/2;
        oBg.regY = oSprite.height/2;
        _oWheel.addChild(oBg);
        
        var iIndex = 0;
        _aReels = new Array();

        var aInfo = new Array();
        for(var i=0; i<MONEY_WHEEL_SETTINGS.length; i++){
            aInfo.push({ "sprite" : MONEY_WHEEL_SETTINGS[i].background, "prize" : MONEY_WHEEL_SETTINGS[i].prize, "type": MONEY_WHEEL_SETTINGS[i].type, "size": 80, "color":MONEY_WHEEL_SETTINGS[i].textcolor, "stroke":10, "strokecolor":MONEY_WHEEL_SETTINGS[i].textstrokecolor});
        }
        var aListInfo = new Array();
        for(var i=0; i<MAX_MULTIPLIER; i++){
            aListInfo[i] = new Array();
            for(var j=0; j<aInfo.length;j++){
                
                var iPrize;
                if(aInfo[j].type === "prize"){
                    iPrize = (aInfo[j].prize*(i+1)).toFixed(2)/1;
                } else {
                    iPrize = (aInfo[j].prize).toFixed(2)/1;
                }
                
                aListInfo[i][j] = { 
                    "sprite" : aInfo[j].sprite, 
                    "prize" : iPrize,         //////////PRE-CALCULATE MULTIPLIER PRIZE
                    "type" : aInfo[j].type,
                    "size": aInfo[j].size, 
                    "color":aInfo[j].color, 
                    "stroke":aInfo[j].stroke, 
                    "strokecolor":aInfo[j].strokecolor
                }
            }
            
            var oElements = new CReel(0, 0, aListInfo[i], NUM_SEGMENT_TO_RENDER/PRECISION -PRECISION, _oWheel, iIndex);
            _aReels[iIndex] = {element: oElements, loaded: false};
            iIndex++;
        }

        /*
        var aInfo = new Array();
        for(var i=0; i<INSTANT_WHEEL_SETTINGS.length; i++){
            aInfo.push({ "sprite" : INSTANT_WHEEL_SETTINGS[i].background, "label": INSTANT_WHEEL_SETTINGS[i].label});
        }
        
        var oElements = new CReel(0, 0, aInfo, NUM_SEGMENT_TO_RENDER/PRECISION -PRECISION, _oWheel, iIndex);
        _aReels[iIndex] = {element: oElements, loaded: false};
        iIndex++;
        */
        
        var oSprite = s_oSpriteLibrary.getSprite('wheel_shadow');
        var oShadow = createBitmap(oSprite);
        oShadow.regX = oSprite.width/2;
        oShadow.regY = oSprite.height/2;
        _oWheel.addChild(oShadow);
        
        var oSprite = s_oSpriteLibrary.getSprite('arrow');
        var oArrow = createBitmap(oSprite);
        oArrow.x = -70;
        oArrow.regX = oSprite.width;
        oArrow.regY = oSprite.height/2;
        _oWheel.addChild(oArrow);
    };
    
    this.unload = function(){
        for(var i=0; i<_aReels.length;i++){
            _aReels[i].element.setVisible(false);
        }
        
        _iState = WHEEL_IDLE;
        _iCntFrames = 0;
        
        _iCurRotation = 0;
        
        _oWheel.off("mousedown", _oListenerMouseDown);
        _oWheel.off("pressmove", _oListenerMouseMove);
        _oWheel.off("pressup", _oListenerMouseUp);
        
    };
    
    this.attachWheel = function(iX, iY, oParentContainer){

        _iCurReelVisualized = 0;


        _oWheel.x = iX;
        _oWheel.y = iY;
        _oWheel.visible = true;
        oParentContainer.addChild(_oWheel);

        _aReels[_iCurReelVisualized].element.setVisible(true);
        _aReels[_iCurReelVisualized].element.render();
        
        _oListenerMouseDown = _oWheel.on("mousedown", this._onMouseDown);
        _oListenerMouseMove = _oWheel.on("pressmove", this._onMouseMove);
        _oListenerMouseUp = _oWheel.on("pressup", this._onMouseUp);
    };
    
    this._onMouseDown = function(evt){
        if(_iState === WHEEL_MOVEMENT){
            return;
        }
        
        _iMouseStartY = evt.localY;
        _iMouseCurY = evt.localY;
        
        _iStartRotationToAdd = _iCurRotation;
    };
    
    this._onMouseMove = function(evt){
        if(_iState === WHEEL_MOVEMENT){
            return;
        }
        
        _iStrenght = _iMouseCurY - evt.localY;
        
        _iCurRotation = s_oWheel.getRotation(_iStartRotationToAdd + (_iMouseStartY - evt.localY)/PRECISION);
        
        _iMouseCurY = evt.localY; 
    };
    
    this._onMouseUp = function(evt){
        if(_iState === WHEEL_MOVEMENT){
            return;
        }
        
        if(_iStrenght < -WHEEL_STRENGHT_ACTIVATION){
            s_oGame.spinWheel();
        }
    };
    
    this.elementLoaded = function(iIndex){
        _aReels[iIndex].loaded = true;

        for(var i=0; i<_aReels.length; i++){
            if(!_aReels[i].loaded){
                return;
            }
        }
        
        _bIsLoaded = true;
        
        if(s_oLoadingPanel){
            s_oLoadingPanel.unload();
            s_oMain.gotoGame();
        }
        
    };
    
    this.isLoaded = function(){
        return _bIsLoaded;
    };
    
    this.loading = function(){
        for(var i=0; i<_aReels.length; i++){
            _aReels[i].element.loading();
        }
    };
    
    this.setText = function(iMultiply){

        _aReels[_iCurReelVisualized].element.setVisible(false);
        
        _iCurReelVisualized = iMultiply-1;
        
        _aReels[_iCurReelVisualized].element.clear();
        _aReels[_iCurReelVisualized].element.update(_iCurRotation);
        _aReels[_iCurReelVisualized].element.render();
        _aReels[_iCurReelVisualized].element.setVisible(true);
        
    };
    
    this.getNumSegmentsOfASingleFrame = function(){
        return _aReels[_iCurReelVisualized].element.getNumSegmentsOfASingleFrame();
    };
    
    this.getTotalSegments = function(){
        return _aReels[_iCurReelVisualized].element.getNumSegments();
    };
    
    this.getDegree = function(){
        return _iCurRotation;
    };

    this.getRotation = function(iValue){
        var iRot = Math.floor(iValue%this.getTotalSegments());
        
        if(iRot<0){
            iRot = this.getTotalSegments() + iRot;
        }
        
        return iRot;
    };
    
    this.spin = function(iFrameToReach){

        //CALCULATE ROTATION
        var iFrameHeight = this.getNumSegmentsOfASingleFrame();
        var iWheelHeight = this.getTotalSegments();
        
        var iNumSpinFake = MIN_FAKE_SPIN + Math.floor(Math.random()*3);
        var iBorderSegmentsToAvoid = 16;
        var iOffsetFrame = iBorderSegmentsToAvoid + Math.random()*(iFrameHeight - 2*iBorderSegmentsToAvoid);
        
        /////////FORWARD ROTATION
        /*
        var iTrueRotation = (iFrameToReach * iFrameHeight + iOffsetFrame);
        var iRotValue = iWheelHeight*iNumSpinFake + iTrueRotation;
        _iFinalRotationToAdd = iRotValue;
        */
        /////////BACKWARD ROTATION
        var iTrueRotation = iWheelHeight - (iFrameToReach * iFrameHeight + iOffsetFrame);
        var iRotValue = iWheelHeight*iNumSpinFake + iTrueRotation;
        _iFinalRotationToAdd = -iRotValue;      /// BACKWARD ROTATION 
        

        _iState = WHEEL_MOVEMENT;
        _iStartRotationToAdd = _iCurRotation;   
        
        var iTime = WHEEL_SPIN_TIME*1000;

        _pWheelPos.cur = _iStartRotationToAdd;
        createjs.Tween.get(_pWheelPos).to({cur:_iFinalRotationToAdd},iTime, createjs.Ease.cubicOut).call(function(){
            _iState = WHEEL_IDLE;
            s_oGame.releaseWheel();
        }).addEventListener("change", s_oWheel._onWheelMove);
    };
    
    this._onWheelMove = function(){
        _iCurRotation = s_oWheel.getRotation(_pWheelPos.cur);
    };
    
    this.update = function(){
        
        

        for(var i=0; i<_aReels.length;i++){
            _aReels[i].element.update(_iCurRotation);
        }

        _aReels[_iCurReelVisualized].element.render();
        

    };
    
    this._init();
    s_oWheel = this;
}

var s_oWheel = null;
