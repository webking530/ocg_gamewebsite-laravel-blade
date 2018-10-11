function CGame(oData){
    
    var _bInitGame;
    
    var _iTimeIdle;
    var _iTimeWin;
    var _iCurAnim;
    var _iGameState;
    var _iSpinMode;
    var _iFreeSpinCounter;
    var _iMultiply;
    var _iCurBet;
    var _iCurCredit;
    var _iCurWin;
    var _iAdCounter;
    var _iBankCash;

    var _aProbability;

    var _oInterface;
    var _oEndPanel = null;
    var _oParent;
    var _oWheelContainer;
    var _oWheel;
    var _oLeds;
    
    this._init = function(){
        _iMultiply = 1;
        _iTimeIdle = 0;
        _iTimeWin = 0;
        _iCurBet = START_BET.toFixed(2)/1;
        _iCurCredit = START_CREDIT.toFixed(2)/1;
        _iCurWin = -1;        
        _iGameState = STATE_IDLE;
        _iSpinMode = SPIN_MODE_NORMAL;
        _iAdCounter = 0;
        _iBankCash = BANK_CASH;
        _iFreeSpinCounter = 0;

        var oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game'));
        s_oStage.addChild(oBg);

        _aProbability = new Array();

        _bInitGame=true;
        
        _oWheelContainer = new createjs.Container();
        _oWheelContainer.scaleX = _oWheelContainer.scaleY = 1.2;
        s_oStage.addChild(_oWheelContainer);

        this.attachWheel();

        _oInterface = new CInterface(); 

        new CHelpPanel();

        this._initProbability();
		
        if(_iCurCredit < START_BET){
            this.gameOver();
            return;
        } 
    };
    
    this.attachWheel = function(){

        var pCenterWheel = {x: 200, y: CANVAS_HEIGHT/2-105};
        s_oWheel.attachWheel(pCenterWheel.x, pCenterWheel.y, _oWheelContainer);
        
        _oLeds = new CLeds(pCenterWheel.x, pCenterWheel.y, _oWheelContainer);
        _iCurAnim = _oLeds.getState();
        
        _oWheel = s_oWheel;
    };
    
    this._initProbability = function(){
       
        var aPrizeLength = new Array();
        
        for(var i=0; i<MONEY_WHEEL_SETTINGS.length; i++){
            aPrizeLength[i] = MONEY_WHEEL_SETTINGS[i].win_occurrence;
        }
        
        for(var i=0; i<aPrizeLength.length; i++){
            for(var j=0; j<aPrizeLength[i]; j++){
                _aProbability.push(i);
            }            
        }            
    };
    
    this.modifyBonus = function(szType){
        if(szType === "plus"){
            //_iCurBet += START_BET;
            _iMultiply++;
        } else {
            //_iCurBet -= START_BET;
            _iMultiply--;
        }
        
        if(_iMultiply > MAX_MULTIPLIER){
            _iMultiply = MAX_MULTIPLIER;
        } else if(_iMultiply < 1) {
            _iMultiply = 1;
        } else if(_iMultiply > _iCurCredit/START_BET){
            _iMultiply = Math.floor(_iCurCredit/START_BET);
        }
        
        
        _iCurBet = (START_BET*_iMultiply).toFixed(2)/1;

		
        _oInterface.refreshBet(_iCurBet);
        _oWheel.setText(_iMultiply);
    };
    
    this.tryShowAd = function(){
        _iAdCounter++;
        if(_iAdCounter === AD_SHOW_COUNTER){
            _iAdCounter = 0;
            $(s_oMain).trigger("show_interlevel_ad");
        }
    };
    
    this._getBetPrize = function(){
        //DETECT ALL POSSIBLE PRIZE LOWER THEN BANK
        var iCurPrize;
        var aAllPossiblePrize = new Array();
        for(var i=0; i<_aProbability.length; i++){
            iCurPrize = MONEY_WHEEL_SETTINGS[_aProbability[i]].prize*_iMultiply;

            if(iCurPrize <= _iBankCash || MONEY_WHEEL_SETTINGS[_aProbability[i]].type === "freespin"){
                aAllPossiblePrize.push({prize:iCurPrize,index:i});
            } 
        }
        var iPrizeToChoose = aAllPossiblePrize[Math.floor(Math.random()*aAllPossiblePrize.length)].index;      
        
        return _aProbability[iPrizeToChoose];
    };
    
    this.spinWheel = function(){
        _oInterface.disableSpin(true);
        _iGameState = STATE_SPIN;
        _iTimeWin = 0;
        

        _oWheel.setText(_iMultiply);

        this.setNewRound();
       
        if(_iSpinMode === SPIN_MODE_FREE){
            _iFreeSpinCounter--;
            
            _oInterface.enterInFreeSpinMode(_iFreeSpinCounter);
            
        } else {
            _oInterface.refreshMoney(0);
            _iCurCredit -= _iCurBet;
            _iBankCash += _iCurBet;

            _oInterface.refreshCredit(_iCurCredit.toFixed(2)/1);
        }

        //SELECT PRIZE      
        _iCurWin = this._getBetPrize();

        

        playSound("start_reel",1,false);
        playSound("reel",0.2,true);

        //SPIN
        _oWheel.spin(_iCurWin);
    };                 
    
    this.setNewRound = function(){
        if(_iCurWin < 0){
            return;
        }
        
        _oInterface.refreshCredit(_iCurCredit.toFixed(2)/1);
        _oInterface.clearMoneyPanel();
        
        _iCurWin = -1;
    };
    
    this.releaseWheel = function(){
        this.tryShowAd();
        _oInterface.disableSpin(false);
        
        stopSound("reel");

        if(MONEY_WHEEL_SETTINGS[_iCurWin].prize > _iCurBet || MONEY_WHEEL_SETTINGS[_iCurWin].type === "freespin"){
            _iGameState = STATE_WIN;
            playSound("win",1,false);

        } else {
            _iGameState = STATE_LOSE;
            playSound("game_over",1,false);
        }

        
        if(MONEY_WHEEL_SETTINGS[_iCurWin].type === "prize"){
            s_oGame.setWinPrize();
        }
        
        this.checkSpinMode();

        if(_iSpinMode === SPIN_MODE_NORMAL){
            if(_iCurCredit < START_BET){
                this.gameOver();
            }        
            if(_iMultiply > _iCurCredit/START_BET ){
                _iMultiply = Math.floor(_iCurCredit/START_BET);
                _iCurBet = (_iMultiply * START_BET).toFixed(2)/1;
                _oInterface.refreshBet(_iCurBet);     
            }
        } else {
            this.spinWheel();
        }
    };

    this.setWinPrize = function(){
        _oInterface.refreshMoney(MONEY_WHEEL_SETTINGS[_iCurWin].prize * _iMultiply);

        _iCurCredit += MONEY_WHEEL_SETTINGS[_iCurWin].prize * _iMultiply;
        _iBankCash -= MONEY_WHEEL_SETTINGS[_iCurWin].prize * _iMultiply;

        $(s_oMain).trigger("save_score",[_iCurCredit]);

        _oInterface.refreshCredit(_iCurCredit.toFixed(2)/1);

        _oInterface.animWin();
    };
    
    this.checkSpinMode = function(){
        
        if(MONEY_WHEEL_SETTINGS[_iCurWin].type === "freespin"){
            _iFreeSpinCounter += MONEY_WHEEL_SETTINGS[_iCurWin].prize;
            _oInterface.enterInFreeSpinMode(_iFreeSpinCounter);
            
            if(_iSpinMode === SPIN_MODE_NORMAL){
                _iSpinMode = SPIN_MODE_FREE;
            }
            
        } else {
            if(_iSpinMode === SPIN_MODE_FREE){
                if(_iFreeSpinCounter === 0){
                    _iSpinMode = SPIN_MODE_NORMAL;
                    
                    if(_iMultiply > _iCurCredit/START_BET ){
                        _iMultiply = Math.floor(_iCurCredit/START_BET);
                        _iCurBet = (_iMultiply * START_BET).toFixed(2)/1;
                        _oInterface.refreshBet(_iCurBet);     
                    }
                    
                    _oInterface.exitFromFreeSpinMode(_iCurBet);
                }
            }
        }
    };
    
    this.unload = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                createjs.Sound.stop();
        }
        _bInitGame = false;
        
        _oInterface.unload();
        if(_oEndPanel !== null){
            _oEndPanel.unload();
        }
        s_oWheel.unload();
        createjs.Tween.removeAllTweens();
        s_oStage.removeAllChildren();
        
    };
 
    this.onExit = function(){
        
        stopSound("reel");
        
        $(s_oMain).trigger("save_score",[_iCurCredit]);
        $(s_oMain).trigger("share_event",_iCurCredit);
        $(s_oMain).trigger("end_session");
        
        this.unload();
        s_oMain.gotoMenu();
        
        
    };
    
    this.gameOver = function(){  
        _oEndPanel = CEndPanel(s_oSpriteLibrary.getSprite('msg_box'));
        _oEndPanel.show();
    };

    
    this._animLedIdle = function(){
        
        _iTimeIdle += s_iTimeElaps;
        
        if(_iTimeIdle > TIME_ANIM_IDLE){
            _iTimeIdle=0;
            
            
            var iRandAnim = Math.floor(Math.random()*_oLeds.getNumAnim());
    
            while(iRandAnim === _iCurAnim){
                iRandAnim = Math.floor(Math.random()*_oLeds.getNumAnim());
            }    
            _oLeds.changeAnim(iRandAnim);
            _iCurAnim = iRandAnim;
           
        }
    };    
    
    this._animLedSpin = function(){
        _oLeds.changeAnim(LED_SPIN);
        _iGameState =-1;
    };
    
    this._animLedWin = function(){
       
        if(_iTimeWin === 0){
            var iRandomWinAnim = LED_SPIN + 1 + Math.round(Math.random())
            _oLeds.changeAnim(iRandomWinAnim);
          
        } else if(_iTimeWin > TIME_ANIM_WIN) {
            _iTimeIdle = TIME_ANIM_IDLE; 
            _iGameState = STATE_IDLE;

            _iTimeWin =0;
        }
        _iTimeWin += s_iTimeElaps;
        
    };
    
    this._animLedLose = function(){
       
        if(_iTimeWin === 0){            
            _oLeds.changeAnim(7);
        
        } else if(_iTimeWin > TIME_ANIM_LOSE) {
            _iTimeIdle = TIME_ANIM_IDLE; 
            _iGameState = STATE_IDLE;

            _iTimeWin =0;
        }
        _iTimeWin += s_iTimeElaps;
        
    };
    
    this.startUpdate = function(){
        _bInitGame = true;
    };
    
    this.stopUpdate = function(){
        _bInitGame = false;
    };
    
    this.update = function(){
	if(_bInitGame){
            
            _oLeds.update();
          
        
            switch(_iGameState) {
                case STATE_IDLE:{
                        this._animLedIdle();
                   break;
                } case STATE_SPIN: {
                        this._animLedSpin();
                   break;              

                } case STATE_WIN: {
                        this._animLedWin();
                   break;                             
                } case STATE_LOSE: {
                        this._animLedLose();
                   break;                             
                }    

            }
            
            _oWheel.update();
            
        }
    };

    s_oGame=this;

    START_CREDIT = oData.start_credit;
    START_BET = oData.start_bet;
    MAX_MULTIPLIER = oData.max_multiplier;
    
    AD_SHOW_COUNTER = oData.ad_show_counter;
    
    BANK_CASH = oData.bank_cash;
	
    
        
    _oParent=this;
    this._init();
}

var s_oGame;
