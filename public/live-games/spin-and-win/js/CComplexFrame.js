function CComplexFrame(iX, iY, oSprite, oParentContainer, oTextInfo){

    var _bIsLoaded;

    var _iTotalFragment;
    var _iCurFragmentToLoad;
    var _iNumLoadingIteration;

    var _pLabelInfo;

    var _oStrokeText;
    var _oText;

    var _aFragment;
    
    this._init = function(iX, iY, oSprite, oParentContainer, oTextInfo){
        _bIsLoaded = false;
        
        _iCurFragmentToLoad = 0;
        _iNumLoadingIteration = 5;

        _pLabelInfo = {x:0, y: oSprite.height-LABEL_HEIGHT, width: oSprite.width, height: LABEL_HEIGHT, texty: oSprite.height-LABEL_HEIGHT/2};

        _aFragment = new Array();
        _iTotalFragment = 0;
        for(var i=0; i<oSprite.height; i+=PRECISION){
            
            _aFragment[_iTotalFragment] = new createjs.Container();
            _aFragment[_iTotalFragment].x = iX;
            _aFragment[_iTotalFragment].y = iY;
            _aFragment[_iTotalFragment].regX = oSprite.width/2;
            _aFragment[_iTotalFragment].regY = _iTotalFragment*PRECISION;
            _aFragment[_iTotalFragment].visible = false;

            _iTotalFragment++;
        };
    };
    
    this.getFragments = function(){
        return _aFragment;
    };
    
    this.setText = function(oFragment, szText, iSize, szColor, iOutline, szStrokeColor){      

        _oStrokeText = new createjs.Text(szText," "+iSize+"px "+SECONDARY_FONT, szStrokeColor);
        _oStrokeText.x = oSprite.width/2;
        _oStrokeText.y = oSprite.height/2 + 3;
        _oStrokeText.textAlign = "center";
        _oStrokeText.textBaseline = "middle";
        _oStrokeText.outline = iOutline;

        _oText = new createjs.Text(szText," "+iSize+"px "+SECONDARY_FONT, szColor);
        _oText.x = oSprite.width/2;
        _oText.y = oSprite.height/2;
        _oText.textAlign = "center";
        _oText.textBaseline = "middle";

        ////SIZE CONTROL
        var iNewSize = iSize;
        while(_oStrokeText.getBounds().width>WHEEL_TEXT_PIXEL_MAX_SIZE){
            iNewSize--;
            _oStrokeText.font = " "+iNewSize+"px "+SECONDARY_FONT;
            _oText.font = " "+iNewSize+"px "+SECONDARY_FONT;
        };

        oFragment.addChild(_oStrokeText, _oText);

    };
    
    this.setLabel = function(oFragment, szText, iSize, szColor){
        
        var oBackPanel = new createjs.Shape();
        oBackPanel.graphics.beginFill("rgba(0,0,0,0.7)").drawRect(_pLabelInfo.x, _pLabelInfo.y, _pLabelInfo.width, _pLabelInfo.height);
        
        _oText = new createjs.Text(szText," "+iSize+"px "+SECONDARY_FONT, szColor);
        _oText.x = oSprite.width/2;
        _oText.y = _pLabelInfo.texty;
        _oText.textAlign = "center";
        _oText.textBaseline = "middle";

        ////SIZE CONTROL
        var iNewSize = iSize;
        while(_oText.getBounds().width>WHEEL_TEXT_PIXEL_MAX_SIZE){
            iNewSize--;
            _oText.font = " "+iNewSize+"px "+SECONDARY_FONT;
        };

        oFragment.addChild(oBackPanel, _oText);
        
    };
    
    this.isLoaded = function(){
        return _bIsLoaded;
    };
    
    this.loadFragment = function(){
        if(_iCurFragmentToLoad === _iTotalFragment){
            _bIsLoaded = true;
            return;
        };

        for(var i=0; i<_iNumLoadingIteration; i++){
            
            
            
            var oBg = createBitmap(oSprite);
            _aFragment[_iCurFragmentToLoad].addChild(oBg);


            oParentContainer.addChild(_aFragment[_iCurFragmentToLoad]);

            if(oTextInfo.prize !== null && oTextInfo.prize !== undefined){
                if(oTextInfo.type === "prize"){
                    this.setText(_aFragment[_iCurFragmentToLoad], TEXT_CURRENCY + oTextInfo.prize, oTextInfo.size, oTextInfo.color, oTextInfo.stroke, oTextInfo.strokecolor);
                } else {
                    this.setText(_aFragment[_iCurFragmentToLoad], TEXT_FREESPIN +"\n x" + oTextInfo.prize, oTextInfo.size, oTextInfo.color, oTextInfo.stroke, oTextInfo.strokecolor);
                }
            }
            
            if(oTextInfo.label !== null && oTextInfo.label !== undefined && oTextInfo.label !== ""){
                this.setLabel(_aFragment[_iCurFragmentToLoad], oTextInfo.label, 30, "#FFFFFF");
            }
            
            var oBorder = createBitmap(s_oSpriteLibrary.getSprite('borderframe'));
            _aFragment[_iCurFragmentToLoad].addChild(oBorder);
            
            _aFragment[_iCurFragmentToLoad].cache(0,_iCurFragmentToLoad*PRECISION,oSprite.width, PRECISION);
            _iCurFragmentToLoad++;
            

            if(_iCurFragmentToLoad === _iTotalFragment){
                _bIsLoaded = true;
                return;
            };
        }
        
    };
    
    this._init(iX, iY, oSprite, oParentContainer, oTextInfo);
    
}


