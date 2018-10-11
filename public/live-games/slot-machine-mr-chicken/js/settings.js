var CANVAS_WIDTH = 1500;
var CANVAS_HEIGHT = 640;
var EDGEBOARD_X = 300;
var EDGEBOARD_Y = 0;

var FONT_GAME = "walibi0615bold";

var FPS_TIME      = 1000/24;
var DISABLE_SOUND_MOBILE = false;

var STATE_LOADING = 0;
var STATE_MENU    = 1;
var STATE_HELP    = 1;
var STATE_GAME    = 3;

var GAME_STATE_IDLE         = 0;
var GAME_STATE_SPINNING     = 1;
var GAME_STATE_SHOW_ALL_WIN = 2;
var GAME_STATE_SHOW_WIN     = 3;

var REEL_STATE_START   = 0;
var REEL_STATE_MOVING = 1;
var REEL_STATE_STOP    = 2;

var ON_MOUSE_DOWN = 0;
var ON_MOUSE_UP   = 1;
var ON_MOUSE_OVER = 2;
var ON_MOUSE_OUT  = 3;
var ON_DRAG_START = 4;
var ON_DRAG_END   = 5;

var REEL_OFFSET_X = 380;
var REEL_OFFSET_Y = 123;

var NUM_REELS = 5;
var NUM_ROWS = 3;
var NUM_SYMBOLS = 10;
var WILD_SYMBOL = 10;
var BONUS_SYMBOL = 9;
var NUM_PAYLINES = 5;
var SYMBOL_SIZE = 140;
var SPACE_BETWEEN_SYMBOLS = 10;
var MAX_FRAMES_REEL_EASE = 16;
var MIN_REEL_LOOPS;
var REEL_DELAY;
var REEL_START_Y = REEL_OFFSET_Y - (SYMBOL_SIZE * 3);
var REEL_ARRIVAL_Y = REEL_OFFSET_Y + (SYMBOL_SIZE * 3);
var TIME_SHOW_WIN;
var TIME_SHOW_ALL_WINS;
var MIN_BET;
var MAX_BET;
var TOTAL_MONEY;
var MAX_NUM_HOLD;
var CHICKEN_WIDTH = 166;
var CHICKEN_HEIGHT = 187;
var NUM_PRIZES = 3;
var NUM_SYMBOLS_FOR_BONUS = 3;
var PERC_WIN_EGG_1;
var PERC_WIN_EGG_2;
var PERC_WIN_EGG_3;
var SOUNDTRACK_VOLUME = 0.5;
var WIN_OCCURRENCE;
var SLOT_CASH;
var MIN_WIN;
var BONUS_OCCURRENCE;
var PAYTABLE_VALUES;

var BONUS_PRIZE = new Array();
BONUS_PRIZE[0] = [5,50,100];     //LIST OF MULTIPLIER IF 3 BONUS ITEM
BONUS_PRIZE[1] = [10,100,200];   //LIST OF MULTIPLIER IF 4 BONUS ITEM
BONUS_PRIZE[2] = [50,200,500];   //LIST OF MULTIPLIER IF 5 BONUS ITEM

var ENABLE_FULLSCREEN;
var ENABLE_CHECK_ORIENTATION;
var SHOW_CREDITS;