function CGame(oData){
    var _bUpdate = false;
    var _iCurState;
    var _iCurReelLoops;
    var _iNextColToStop;
    var _iNumReelsStopped;
    var _iLastLineActive;
    var _iTimeElaps;
    var _iCurWinShown;
    var _iCurBet;
    var _iTotBet;
    var _iMoney;
    var _iTotWin;
    var _iNumSpinCont;
    var _iAdsShowingCont;
    var _aMovingColumns;
    var _aStaticSymbols;
    var _aWinningLine;
    var _aReelSequence;
    var _aFinalSymbolCombo;
    var _oReelSound;
    var _oCurSymbolWinSound;
    var _oBg;
    var _oFrontSkin;
    var _oInterface;
    var _oPayTable = null;
    
    this._init = function(){
        _iCurState = GAME_STATE_IDLE;
        _iCurReelLoops = 0;
        _iNumReelsStopped = 0;
        _iNumSpinCont = 0;
        _aReelSequence = new Array(0,1,2,3,4);
        _iNextColToStop = _aReelSequence[0];
        _iLastLineActive = NUM_PAYLINES;
        _iMoney = TOTAL_MONEY;
        _iCurBet = MIN_BET;
        _iTotBet = _iCurBet * _iLastLineActive;
        
        s_oTweenController = new CTweenController();
        
        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game'));
        s_oStage.addChild(_oBg);

        this._initReels();

        _oFrontSkin = new createjs.Bitmap(s_oSpriteLibrary.getSprite('mask_slot'));
        s_oStage.addChild(_oFrontSkin);

        _oInterface = new CInterface(_iCurBet,_iTotBet,_iMoney);
        this._initStaticSymbols();
        _oPayTable = new CPayTablePanel();
		
        if(_iMoney < _iTotBet){
                _oInterface.disableSpin();
        }
        
        _bUpdate = true;
    };
    
    this.unload = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.stop();
        }

        _oInterface.unload();
        _oPayTable.unload();
        
        for(var k=0;k<_aMovingColumns.length;k++){
            _aMovingColumns[k].unload();
        }
        
        for(var i=0;i<NUM_ROWS;i++){
            for(var j=0;j<NUM_REELS;j++){
                _aStaticSymbols[i][j].unload();
            }
        }
        
        s_oStage.removeAllChildren();
    };
    
    this._initReels = function(){  
        var iXPos = REEL_OFFSET_X;
        var iYPos = REEL_OFFSET_Y;
        
        var iCurDelay = 0;
        _aMovingColumns = new Array();
        for(var i=0;i<NUM_REELS;i++){ 
            _aMovingColumns[i] = new CReelColumn(i,iXPos,iYPos,iCurDelay);
            _aMovingColumns[i+NUM_REELS] = new CReelColumn(i+NUM_REELS,iXPos,iYPos + (SYMBOL_SIZE*NUM_ROWS),iCurDelay );
            iXPos += SYMBOL_SIZE + SPACE_BETWEEN_SYMBOLS;
            iCurDelay += REEL_DELAY;
        }
        
    };
    
    this._initStaticSymbols = function(){
        var iXPos = REEL_OFFSET_X;
        var iYPos = REEL_OFFSET_Y;
        _aStaticSymbols = new Array();
        for(var i=0;i<NUM_ROWS;i++){
            _aStaticSymbols[i] = new Array();
            for(var j=0;j<NUM_REELS;j++){
                var oSymbol = new CStaticSymbolCell(i,j,iXPos,iYPos);
                _aStaticSymbols[i][j] = oSymbol;
                
                iXPos += SYMBOL_SIZE + SPACE_BETWEEN_SYMBOLS;
            }
            iXPos = REEL_OFFSET_X;
            iYPos += SYMBOL_SIZE;
        }
    };
    
    var _iJackpot = 0;
    on(`play`, data => {
        _aFinalSymbolCombo = data.combination;
        _aWinningLine = data.wins;
        _iTotWin = data.win;
        _iJackpot = data.jackpotData / 100;
    });

    on(`error`, data => {
        _iMoney += _iCurBet * _iLastLineActive;
        _oInterface.refreshMoney(_iMoney);
    });
    
    this._generateRandSymbols = function() {
        var aRandSymbols = new Array();
        for (var i = 0; i < NUM_ROWS; i++) {
                var iRandIndex = Math.floor(Math.random()* s_aRandSymbols.length);
                aRandSymbols[i] = s_aRandSymbols[iRandIndex];
        }

        return aRandSymbols;
    };
    
    this.reelArrived = function(iReelIndex,iCol) {
        if(_iCurReelLoops>MIN_REEL_LOOPS ){
            if (_iNextColToStop === iCol && lastPlay) {
                if (_aMovingColumns[iReelIndex].isReadyToStop() === false) {
                    var iNewReelInd = iReelIndex;
                    if (iReelIndex < NUM_REELS) {
                            iNewReelInd += NUM_REELS;
                            
                            _aMovingColumns[iNewReelInd].setReadyToStop();
                            
                            _aMovingColumns[iReelIndex].restart(new Array(_aFinalSymbolCombo[0][iReelIndex],
                                                                        _aFinalSymbolCombo[1][iReelIndex],
                                                                        _aFinalSymbolCombo[2][iReelIndex]), true);
                            
                    }else {
                            iNewReelInd -= NUM_REELS;
                            _aMovingColumns[iNewReelInd].setReadyToStop();
                            
                            _aMovingColumns[iReelIndex].restart(new Array(_aFinalSymbolCombo[0][iNewReelInd],
                                                                          _aFinalSymbolCombo[1][iNewReelInd],
                                                                          _aFinalSymbolCombo[2][iNewReelInd]), true);
                            
                            
                    }
                    
                }
            }else {
                    _aMovingColumns[iReelIndex].restart(this._generateRandSymbols(),false);
            }
            
        }else {
            
            _aMovingColumns[iReelIndex].restart(this._generateRandSymbols(), false);
            if(iReelIndex === 0){
                _iCurReelLoops++;
            }
            
        }
    };
    
    this.stopNextReel = function() {
        _iNumReelsStopped++;

        if(_iNumReelsStopped%2 === 0){
            
            playSound("reel_stop", 1,0);
            
            _iNextColToStop = _aReelSequence[_iNumReelsStopped/2];
            if (_iNumReelsStopped === (NUM_REELS*2) ) {
                    this._endReelAnimation();
            }
        }    
    };
    
    this._endReelAnimation = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oReelSound.stop();
        }
        
        _oInterface.disableBetBut(false);
        
        _iCurReelLoops = 0;
        _iNumReelsStopped = 0;
        _iNextColToStop = _aReelSequence[0];
        
        //var iTotWin = 0;
        //INCREASE MONEY IF THERE ARE COMBOS
        if(_aWinningLine.length > 0){
            //HIGHLIGHT WIN COMBOS IN PAYTABLE
            for(var i=0;i<_aWinningLine.length;i++){
                _oPayTable.highlightCombo(_aWinningLine[i].value,_aWinningLine[i].num_win);
                _oInterface.showLine(_aWinningLine[i].line);
                var aList = _aWinningLine[i].list;
                for(var k=0;k<aList.length;k++){
                    _aStaticSymbols[aList[k].row][aList[k].col].show(aList[k].value);
                }
                
                //iTotWin += _aWinningLine[i].amount;
            }

            _iTotWin *=_iCurBet;
            _iMoney += _iTotWin;
            SLOT_CASH -= _iTotWin;
            
            if(_iTotWin>0){
                    _oInterface.refreshMoney(_iMoney);
                    _oInterface.refreshWinText(_iTotWin);
            }
			
            _iTimeElaps = 0;
            _iCurState = GAME_STATE_SHOW_ALL_WIN;
            
            if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                _oCurSymbolWinSound = playSound("win", 0.3,0);
            }
        }else if(_iJackpot > 0){
            _iMoney += _iJackpot;
            for(var i=0;i<3;i++){
                for(var j=0;j<5;j++){
                    _aStaticSymbols[i][j].show(1);
                }
            }
            _oInterface.refreshMoney(_iMoney);
            _oInterface.refreshWinText(_iJackpot);
            _oCurSymbolWinSound = playSound("win", 0.3,0);
        }else{
            _iCurState = GAME_STATE_IDLE;
        }
        
        _oInterface.enableGuiButtons();
		
        if(_iMoney < _iTotBet){
                _oInterface.disableSpin();
        }

        _iNumSpinCont++;
        if(_iNumSpinCont === _iAdsShowingCont){
            _iNumSpinCont = 0;
            
            $(s_oMain).trigger("show_interlevel_ad");
        }

        $(s_oMain).trigger("save_score",_iMoney);
    };

    this.hidePayTable = function(){
        _oPayTable.hide();
    };
    
    this._showWin = function(){
        var iLineIndex;
        if(_iCurWinShown>0){ 
            stopSound(_oCurSymbolWinSound);
            
            
            iLineIndex = _aWinningLine[_iCurWinShown-1].line;
            _oInterface.hideLine(iLineIndex);
            
            var aList = _aWinningLine[_iCurWinShown-1].list;
            for(var k=0;k<aList.length;k++){
                _aStaticSymbols[aList[k].row][aList[k].col].stopAnim();
            }
        }
        
        if(_iCurWinShown === _aWinningLine.length){
            _iCurWinShown = 0;
        }
        
        iLineIndex = _aWinningLine[_iCurWinShown].line;
        _oInterface.showLine(iLineIndex);

        var aList = _aWinningLine[_iCurWinShown].list;
        for(var k=0;k<aList.length;k++){
            _aStaticSymbols[aList[k].row][aList[k].col].show(aList[k].value);
        }
            

        _iCurWinShown++;
        
    };
    
    this._hideAllWins = function(){
        for(var i=0;i<_aWinningLine.length;i++){
            var aList = _aWinningLine[i].list;
            for(var k=0;k<aList.length;k++){
                _aStaticSymbols[aList[k].row][aList[k].col].stopAnim();
            }
        }
        
        _oInterface.hideAllLines();

        _iTimeElaps = 0;
        _iCurWinShown = 0;
        _iTimeElaps = TIME_SHOW_WIN;
        _iCurState = GAME_STATE_SHOW_WIN;
    };
	
	this.activateLines = function(iLine){
        _iLastLineActive = iLine;
        this.removeWinShowing();
		
		var iNewTotalBet = _iCurBet * _iLastLineActive;

		_iTotBet = iNewTotalBet;
		_oInterface.refreshTotalBet(_iTotBet);
		_oInterface.refreshNumLines(_iLastLineActive);
		
		
		if(iNewTotalBet>_iMoney){
			_oInterface.disableSpin();
		}else{
			_oInterface.enableSpin();
		}
    };
	
	this.addLine = function(){
        if(_iLastLineActive === NUM_PAYLINES){
            _iLastLineActive = 1;  
        }else{
            _iLastLineActive++;    
        }
		
		var iNewTotalBet = _iCurBet * _iLastLineActive;

		_iTotBet = iNewTotalBet;
		_oInterface.refreshTotalBet(_iTotBet);
		_oInterface.refreshNumLines(_iLastLineActive);
		
		
		if(iNewTotalBet>_iMoney){
			_oInterface.disableSpin();
		}else{
			_oInterface.enableSpin();
		}
    };
    
    this.changeCoinBet = function(){
        ++_iBetIndex;
        _iBetIndex %= BETS.length;
        var iNewBet = BETS[_iBetIndex];
        var iNewTotalBet = iNewBet * _iLastLineActive;
        iNewTotalBet = parseFloat(iNewTotalBet.toFixed(2));
        
        _iCurBet = iNewBet;
        _iCurBet = Math.floor(_iCurBet * 100)/100;
        _iTotBet = iNewTotalBet;
        _oInterface.refreshBet(_iCurBet);
        _oInterface.refreshTotalBet(_iTotBet);  

        if(iNewTotalBet>_iMoney){
			_oInterface.disableSpin();
		}else{
			_oInterface.enableSpin();
		}
		
    };
	
	this.onMaxBet = function(){
        _iBetIndex = BETS.length - 1;
        var iNewBet = MAX_BET;
		_iLastLineActive = NUM_PAYLINES;
        
        var iNewTotalBet = iNewBet * _iLastLineActive;

		_iCurBet = MAX_BET;
		_iTotBet = iNewTotalBet;
		_oInterface.refreshBet(_iCurBet);
		_oInterface.refreshTotalBet(_iTotBet);
		_oInterface.refreshNumLines(_iLastLineActive);
        
		if(iNewTotalBet>_iMoney){
			_oInterface.disableSpin();
		}else{
			_oInterface.enableSpin();
			this.onSpin();
		}
    };
    
    this.removeWinShowing = function(){
        _oPayTable.resetHighlightCombo();
        
        _oInterface.resetWin();
        
        for(var i=0;i<NUM_ROWS;i++){
            for(var j=0;j<NUM_REELS;j++){
                _aStaticSymbols[i][j].hide();
            }
        }
        
        for(var k=0;k<_aMovingColumns.length;k++){
            _aMovingColumns[k].activate();
        }
        
        _iCurState = GAME_STATE_IDLE;
    };
    
    this.onSpin = function(){
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            if(_oCurSymbolWinSound){
                stopSound(_oCurSymbolWinSound);
            }
            _oReelSound = playSound("reels", 1,0);
        }
        
        
        _oInterface.disableBetBut(true);
        this.removeWinShowing();
        
        _iMoney -= _iTotBet;
        _oInterface.refreshMoney(_iMoney);
        SLOT_CASH += _iTotBet;
        
        $(s_oMain).trigger("bet_placed",{bet:_iCurBet,tot_bet:_iTotBet});
        
        _oInterface.hideAllLines();
        _oInterface.disableGuiButtons();
        
        
        _iCurState = GAME_STATE_SPINNING;

        play(_iBetIndex, _iLastLineActive);
    };
    
    this.onInfoClicked = function(){
        if(_iCurState === GAME_STATE_SPINNING){
            return;
        }
        
        if(_oPayTable.isVisible()){
            _oPayTable.hide();
        }else{
            _oPayTable.show();
        }
    };

    this.onExit = function(){
        close();
        // this.unload();
        // $(s_oMain).trigger("end_session");
        // $(s_oMain).trigger("share_event", _iMoney);
            
        // s_oMain.gotoMenu();
    };
    
    this.getState = function(){
        return _iCurState;
    };
    
    this.update = function(){
        if(_bUpdate === false){
            return;
        }
        
        switch(_iCurState){
            case GAME_STATE_SPINNING:{
                for(var i=0;i<_aMovingColumns.length;i++){
                    _aMovingColumns[i].update();
                }
                break;
            }
            case GAME_STATE_SHOW_ALL_WIN:{
                    _iTimeElaps += s_iTimeElaps;
                    if(_iTimeElaps> TIME_SHOW_ALL_WINS){  
                        this._hideAllWins();
                    }
                    break;
            }
            case GAME_STATE_SHOW_WIN:{
                _iTimeElaps += s_iTimeElaps;
                if(_iTimeElaps > TIME_SHOW_WIN){
                    _iTimeElaps = 0;

                    this._showWin();
                }
                break;
            }
        }
        
	
    };
    
    s_oGame = this;
    
    // SERVER-SIDE SETTINGS
    // WIN_OCCURRENCE = oData.win_occurrence;
    // MIN_REEL_LOOPS = oData.min_reel_loop;
    // REEL_DELAY = oData.reel_delay;
    // TIME_SHOW_WIN = oData.time_show_win;
    // TIME_SHOW_ALL_WINS = oData.time_show_all_wins;
    // TOTAL_MONEY = oData.money;
    // SLOT_CASH = oData.slot_cash;
    // _iAdsShowingCont = oData.ad_show_counter;

    // BETS ARE ALSO SERVER-SIDE SETTINGS
    // SO THEY ARE SET FROM A GIVEN ARRAY
    var _iBetIndex = 0;
    
    this._init();
}

var s_oGame;
var s_oTweenController;