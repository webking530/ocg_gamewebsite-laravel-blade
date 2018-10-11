function CBonusPanel(){
    var _bUfoClicked;
    var _iCurBet;
    var _iBonusMoney;
    var _aUfos;
    var _aBonusValue;
    var _aAlienSprites;
    var _aAlienPrizes;
    var _oAlien;
    var _oWinText;
    var _oContainer;
    var _oSoundtrackBonus;
    
    this._init = function(){        
        _oContainer = new createjs.Container();
        s_oStage.addChild(_oContainer);
        
        var oBg = createBitmap(s_oSpriteLibrary.getSprite('bonus_bg'));
        _oContainer.alpha = 0;
        _oContainer.visible= false;
        _oContainer.addChild(oBg);
        
        var oData = {   // image to use
                        framerate: 3,
                        images: [s_oSpriteLibrary.getSprite('bonus_ufo')], 
                        // width, height & registration point of each sprite
                        frames: {width: UFO_WIDTH, height: UFO_HEIGHT,regX: UFO_WIDTH/2, regY:UFO_HEIGHT/2}, 
                        animations: {  idle: [0, 4,"idle"],lay_alien:[5,9,"stop_lay"],idle_rand_0:[1,4,"idle"],
                        idle_rand_1:[2,4,"idle"],idle_rand_2:[3,4,"idle"],right:[3],left:[4],stop_lay:[9]}
        };

        var oSpriteSheet = new createjs.SpriteSheet(oData);

        _aUfos = new Array();
        
        var iXPos = 418;
        var iYPos = 376;
        for(var i=0;i<5;i++){
            var oUfo = createSprite(oSpriteSheet, "idle",UFO_WIDTH/2,UFO_HEIGHT/2,UFO_WIDTH,UFO_HEIGHT);
            oUfo.on("click", this._onUfoReleased, this,false,i);
            oUfo.x = iXPos;
            oUfo.y = iYPos;
            oUfo.stop();
            oUfo.visible = false;
            
            _oContainer.addChild(oUfo);

            iXPos += 164;
            
            _aUfos[i] = oUfo;
        }
        
        var oSprite = s_oSpriteLibrary.getSprite('bonus_prize');
        oData = {   // image to use
                        framerate: 10,
                        images: [oSprite], 
                        // width, height & registration point of each sprite
                        frames: {width: Math.floor(oSprite.width/NUM_ALIEN), height: oSprite.height,regX:Math.floor(oSprite.width/NUM_ALIEN)/2,regY:oSprite.height/2}, 
                        animations: {  alien_0: [0],alien_1:[1],alien_2:[2]}
        };

        oSpriteSheet = new createjs.SpriteSheet(oData);
        
        _oAlien = createSprite(oSpriteSheet, "alien_0",Math.floor(oSprite.width/NUM_ALIEN)/2,oSprite.height/2,Math.floor(oSprite.width/NUM_ALIEN),oSprite.height);
        _oContainer.addChild(_oAlien);
        
        var _oMaskAlien = new createjs.Shape();
        _oMaskAlien.graphics.beginFill("rgba(255,0,0,0.01)").drawRect(348, 260, 800,240);
        _oContainer.addChild(_oMaskAlien);
        
        _oAlien.mask = _oMaskAlien;
        
        _aAlienSprites = new Array();
        _aAlienPrizes = new Array();
        
        _aAlienSprites[0] = createSprite(oSpriteSheet, "alien_0",Math.floor(oSprite.width/NUM_ALIEN)/2,oSprite.height/2,Math.floor(oSprite.width/NUM_ALIEN),oSprite.height);
        _aAlienSprites[0].x = 348;
        _aAlienSprites[0].y = CANVAS_HEIGHT - 75;
        _oContainer.addChild(_aAlienSprites[0]);
        
        var oText = new createjs.Text("100","34px walibi0615bold", "#e7008a");
        oText.textAlign = "left";
        oText.x = _aAlienSprites[0].x + (oSprite.width/NUM_ALIEN)/2 + 6;
        oText.y = _aAlienSprites[0].y + 12;
        oText.textBaseline = "alphabetic";
        _oContainer.addChild(oText);
        _aAlienPrizes.push(oText);
        
        _aAlienSprites[1] = createSprite(oSpriteSheet, "alien_1",Math.floor(oSprite.width/NUM_ALIEN)/2,oSprite.height/2,Math.floor(oSprite.width/NUM_ALIEN),oSprite.height);
        _aAlienSprites[1].x = 638;
        _aAlienSprites[1].y = CANVAS_HEIGHT - 75;
        _oContainer.addChild(_aAlienSprites[1]);
        
        oText = new createjs.Text("200","34px walibi0615bold", "#e7008a");
        oText.textAlign = "left";
        oText.x = _aAlienSprites[1].x + + (oSprite.width/NUM_ALIEN)/2 + 6;
        oText.y = _aAlienSprites[1].y + 12;
        oText.textBaseline = "alphabetic";
        _oContainer.addChild(oText);
        _aAlienPrizes.push(oText);
        
        _aAlienSprites[2] = createSprite(oSpriteSheet, "alien_2",Math.floor(oSprite.width/NUM_ALIEN)/2,oSprite.height/2,Math.floor(oSprite.width/NUM_ALIEN),oSprite.height);
        _aAlienSprites[2].x = 938;
        _aAlienSprites[2].y = CANVAS_HEIGHT - 75;
        _oContainer.addChild(_aAlienSprites[2]);
        
        oText = new createjs.Text("300","34px walibi0615bold", "#e7008a");
        oText.textAlign = "left";
        oText.x = _aAlienSprites[2].x + + (oSprite.width/NUM_ALIEN)/2+ 6;
        oText.y = _aAlienSprites[2].y + 12;
        oText.textBaseline = "alphabetic";
        _oContainer.addChild(oText);
        _aAlienPrizes.push(oText);
        
        _oWinText = new createjs.Text("+ 300$","80px "+FONT_GAME, "#ffff00");
        _oWinText.alpha = 0;
        _oWinText.textAlign = "center";
        _oWinText.shadow = new createjs.Shadow("#000", 2, 2, 2);
        _oWinText.x = CANVAS_WIDTH/2;
        _oWinText.y = 150;
        _oWinText.textBaseline = "alphabetic";
        _oContainer.addChild(_oWinText);
    };
    
    this.unload = function(){
        for(var i=0;i<5;i++){
            _aUfos[i].off("click", this._onUfoReleased);
        }   
    };
    
    this.show = function(iNumUfo,iCurBet){
        _iCurBet = iCurBet;
        _bUfoClicked = false;
        _oWinText.alpha = 0;
        
        switch(iNumUfo){
            case 3:{
                    _aBonusValue = BONUS_PRIZE[0];
                    break;
            }
            case 4:{
                    _aBonusValue = BONUS_PRIZE[1];
                    break;
            }
            case 5:{
                    _aBonusValue = BONUS_PRIZE[2];
                    break;
            }
            default:{
                    _aBonusValue = BONUS_PRIZE[0];
            }
        }
        
        _aAlienPrizes[0].text = "X" + _aBonusValue[0];
        _aAlienPrizes[1].text = "X" + _aBonusValue[1];
        _aAlienPrizes[2].text = "X" + _aBonusValue[2];
        
        _oAlien.x = 118;
        _oAlien.y = 308;
        _oAlien.rotation = 0;
        _oAlien.gotoAndStop("alien_0");
        
        for(var i=0;i<iNumUfo;i++){
            var iRand = Math.floor(Math.random()* 3);
            _aUfos[i].framerate = 3;
            _aUfos[i].visible = true;
            _aUfos[i].gotoAndPlay("idle_rand_"+iRand);
        }
        
        _oContainer.visible = true;
        createjs.Tween.get(_oContainer).to({alpha:1}, 1000);  
		
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                s_oSoundTrack.setVolume(0);
                _oSoundtrackBonus = createjs.Sound.play("soundtrack_bonus",{loop:-1});
        }
    };
    
    this._onUfoReleased = function(event,oData){
        if(_bUfoClicked){
            return;
        }
        
        _bUfoClicked = true;
        var iIndex = oData;
        
        do{
            var iRandAlien = Math.floor(Math.random()* s_aAlienOccurence.length);
        }while(_aBonusValue[s_aAlienOccurence[iRandAlien]]*_iCurBet > SLOT_CASH);

        this.playUfoLayAnim(iIndex,s_aAlienOccurence[iRandAlien]);
		
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                createjs.Sound.play("choose_ufo");
        }
    };
    
    this.playUfoLayAnim = function(iIndex,iRandAlien){
        _iBonusMoney = _aBonusValue[iRandAlien];
		
        _oAlien.gotoAndStop("alien_"+iRandAlien);
        
        for(var i=0;i<5;i++){
            if(i<iIndex){
                _aUfos[i].gotoAndStop("right");
            }else if(i === iIndex){
                _aUfos[iIndex].framerate = 10;
                _aUfos[iIndex].gotoAndPlay("lay_alien");
            }else{
                _aUfos[i].gotoAndStop("left");
            }
        }

	this.layAlien(iIndex);
    };
    
    this.layAlien = function(iIndex){
        _oAlien.x = _aUfos[iIndex].x ;
        var oParent = this;
        createjs.Tween.get(_oAlien).to({y:460}, 300).call(function(){oParent.endBonus();});  
		
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                createjs.Sound.play("reveal_alien");
        }
    };
    
    this.endBonus = function(){
        //SHOW PRIZE WON
        _oWinText.text = "X "+_iBonusMoney;
        createjs.Tween.get(_oWinText).to({alpha:1}, 500);

        setTimeout(function(){_oContainer.alpha = 0;
                                _oContainer.visible= false;
								for(var i=0;i<_aUfos.length;i++){
                                    _aUfos[i].visible = false;
                                }
								s_oSoundTrack.setVolume(SOUNDTRACK_VOLUME);
								_oSoundtrackBonus.stop();
                                s_oGame.endBonus(_iBonusMoney)},4000);
    };
    
    this._init();
}