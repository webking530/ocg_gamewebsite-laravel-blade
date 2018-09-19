////////////////////////////////////////////////////////////
// CANVAS LOADER
////////////////////////////////////////////////////////////

 /*!
 * 
 * START CANVAS PRELOADER - This is the function that runs to preload canvas asserts
 * 
 */
function initPreload(){
	toggleLoader(true);
	
	checkMobileEvent();
	
	$(window).resize(function(){
		resizeGameFunc();
	});
	resizeGameFunc();
	
	loader = new createjs.LoadQueue(false);
	manifest=[
			{src:'/lottery-game/assets/background.png', id:'background'},
			{src:'/lottery-game/assets/logo.png', id:'logo'},
			{src:'/lottery-game/assets/button_start.png', id:'buttonStart'},
			
			{src:'/lottery-game/assets/item_ball.png', id:'itemBall'},
			{src:'/lottery-game/assets/item_ball_dim.png', id:'itemBallDim'},
			{src:'/lottery-game/assets/item_ball_guess.png', id:'itemBallGuess'},
			{src:'/lottery-game/assets/item_ball_bonus.png', id:'itemBallBonus'},
			{src:'/lottery-game/assets/item_ball_hit.png', id:'itemBallHit'},
			
			{src:'/lottery-game/assets/item_ball_bg.png', id:'itemBallBg'},
			{src:'/lottery-game/assets/item_ball_shadow.png', id:'itemBallShadow'},
			
			{src:'/lottery-game/assets/item_sphere.png', id:'itemSphere'},
			{src:'/lottery-game/assets/item_stick.png', id:'itemStick'},
			{src:'/lottery-game/assets/item_shine.png', id:'itemShine'},
			{src:'/lottery-game/assets/item_bar.png', id:'itemBar'},
			{src:'/lottery-game/assets/item_bar_bonus.png', id:'itemBarBonus'},
			
			{src:'/lottery-game/assets/item_card.png', id:'itemCard'},
			{src:'/lottery-game/assets/item_number_bg.png', id:'itemNumberBg'},
			{src:'/lottery-game/assets/item_number_select_bg.png', id:'itemNumberSelectBg'},
			{src:'/lottery-game/assets/button_lucky.png', id:'buttonLucky'},
			{src:'/lottery-game/assets/button_sphere.png', id:'buttonSphereStart'},
			{src:'/lottery-game/assets/item_table.png', id:'itemTable'},
			
			{src:'/lottery-game/assets/item_prize_bg.png', id:'itemPrizeBg'},
			{src:'/lottery-game/assets/item_prize_select_bg.png', id:'itemPrizeSelectBg'},
			
			{src:'/lottery-game/assets/button_confirm.png', id:'buttonConfirm'},
			{src:'/lottery-game/assets/button_cancel.png', id:'buttonCancel'},
			{src:'/lottery-game/assets/item_exit.png', id:'itemExit'},
			
			{src:'/lottery-game/assets/item_result.png', id:'itemResult'},
			{src:'/lottery-game/assets/button_continue.png', id:'buttonContinue'},
			{src:'/lottery-game/assets/button_facebook.png', id:'buttonFacebook'},
			{src:'/lottery-game/assets/button_twitter.png', id:'buttonTwitter'},
			{src:'/lottery-game/assets/button_google.png', id:'buttonGoogle'},
			{src:'/lottery-game/assets/button_fullscreen.png', id:'buttonFullscreen'},
			{src:'/lottery-game/assets/button_sound_on.png', id:'buttonSoundOn'},
			{src:'/lottery-game/assets/button_sound_off.png', id:'buttonSoundOff'},
			{src:'/lottery-game/assets/button_exit.png', id:'buttonExit'}];
	
	soundOn = true;
	if($.browser.mobile || isTablet){
		if(!enableMobileSound){
			soundOn=false;
		}
	}
	
	if(soundOn){
		manifest.push({src:'/lottery-game/assets/sounds/click.ogg', id:'soundClick'});
		manifest.push({src:'/lottery-game/assets/sounds/balls.ogg', id:'soundBalls'});
		manifest.push({src:'/lottery-game/assets/sounds/reveal.ogg', id:'soundReveal'});
		manifest.push({src:'/lottery-game/assets/sounds/startspin.ogg', id:'soundStartSpin'});
		manifest.push({src:'/lottery-game/assets/sounds/win.ogg', id:'soundWin'});
		manifest.push({src:'/lottery-game/assets/sounds/suck.ogg', id:'soundSuck'});
		manifest.push({src:'/lottery-game/assets/sounds/complete.ogg', id:'soundComplete'});
		manifest.push({src:'/lottery-game/assets/sounds/number.ogg', id:'soundNumber'});
		manifest.push({src:'/lottery-game/assets/sounds/random.ogg', id:'soundRandom'});
		manifest.push({src:'/lottery-game/assets/sounds/cage.ogg', id:'soundCage'});
		manifest.push({src:'/lottery-game/assets/sounds/fail.ogg', id:'soundFail'});
		
		createjs.Sound.alternateExtensions = ["mp3"];
		loader.installPlugin(createjs.Sound);
	}
	
	loader.addEventListener("complete", handleComplete);
	loader.addEventListener("fileload", fileComplete);
	loader.addEventListener("error",handleFileError);
	loader.on("progress", handleProgress, this);
	loader.loadManifest(manifest);
}

/*!
 * 
 * CANVAS FILE COMPLETE EVENT - This is the function that runs to update when file loaded complete
 * 
 */
function fileComplete(evt) {
	var item = evt.item;
	//console.log("Event Callback file loaded ", evt.item.id);
}

/*!
 * 
 * CANVAS FILE HANDLE EVENT - This is the function that runs to handle file error
 * 
 */
function handleFileError(evt) {
	console.log("error ", evt);
}

/*!
 * 
 * CANVAS PRELOADER UPDATE - This is the function that runs to update preloder progress
 * 
 */
function handleProgress() {
	$('#mainLoader span').html(Math.round(loader.progress/1*100)+'%');
}

/*!
 * 
 * CANVAS PRELOADER COMPLETE - This is the function that runs when preloader is complete
 * 
 */
function handleComplete() {
	toggleLoader(false);
	initMain();
};

/*!
 * 
 * TOGGLE LOADER - This is the function that runs to display/hide loader
 * 
 */
function toggleLoader(con){
	if(con){
		$('#mainLoader').show();
	}else{
		$('#mainLoader').hide();
	}
}