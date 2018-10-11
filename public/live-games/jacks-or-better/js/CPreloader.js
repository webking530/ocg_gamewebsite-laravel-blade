function CPreloader(){
    var _iMaskWidth;
    var _oLoadingText;
    var _oProgressBar;
    var _oMaskPreloader;
    var _oContainer;
    
    this._init = function(){
       s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );
       s_oSpriteLibrary.addSprite("bg_preloader",GAME_PATH + "/sprites/bg_preloader.jpg");
       s_oSpriteLibrary.addSprite("progress_bar",GAME_PATH + "/sprites/progress_bar.png");
       s_oSpriteLibrary.loadSprites();
       
       _oContainer = new createjs.Container();
       s_oStage.addChild(_oContainer); 
    };
    
    this.unload = function(){
	_oContainer.removeAllChildren();
    };
    
    this._onImagesLoaded = function(){

    };
    
    this._onAllImagesLoaded = function(){
        this.attachSprites();
        
        s_oMain.preloaderReady();
    };
    
    this.attachSprites = function(){
        var oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_preloader'));
        _oContainer.addChild(oBg);
       
       _oProgressBar  = createBitmap(s_oSpriteLibrary.getSprite('progress_bar'));
       _oProgressBar.x = 761;
       _oProgressBar.y = CANVAS_HEIGHT - 99;
       _oContainer.addChild(_oProgressBar);
       
       _iMaskWidth = 976;
       _oMaskPreloader = new createjs.Shape();
       _oMaskPreloader.graphics.beginFill("rgba(255,0,0,0.01)").drawRect(761, CANVAS_HEIGHT - 99, 1,30);
       _oContainer.addChild(_oMaskPreloader);
       
       _oProgressBar.mask = _oMaskPreloader;
       _oLoadingText = new createjs.Text("0%","30px "+FONT1, "#fff");
       _oLoadingText.x = 800;
       _oLoadingText.y = CANVAS_HEIGHT - 105;
       _oLoadingText.textAlign = "center"; 
       _oLoadingText.textBaseline = "middle";
       _oContainer.addChild(_oLoadingText);
    };
    
    this.refreshLoader = function(iPerc){
        _oLoadingText.text = iPerc+"%";
        
        var iNewMaskWidth = Math.floor((iPerc*_iMaskWidth)/100);
        _oMaskPreloader.graphics.clear();
        _oMaskPreloader.graphics.beginFill("rgba(255,0,0,0.01)").drawRect(561, CANVAS_HEIGHT - 99, iNewMaskWidth,30);
    };
    
    this._init();   
}