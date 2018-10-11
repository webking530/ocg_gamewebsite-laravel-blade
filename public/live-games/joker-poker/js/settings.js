var CANVAS_WIDTH = 1920;
var CANVAS_HEIGHT = 768;

var EDGEBOARD_X = 400;
var EDGEBOARD_Y = 0;

var FONT1 = "OpenSans-BoldItalic";
var FONT2 = "Digital-7";

var FPS_TIME      = 1000/24;
var DISABLE_SOUND_MOBILE = false;

var STATE_LOADING = 0;
var STATE_MENU    = 1;
var STATE_HELP    = 1;
var STATE_GAME    = 3;

var STATE_GAME_WAITING_FOR_BET  = 0;
var STATE_GAME_DEAL             = 1;
var STATE_GAME_CHOOSE_HOLD      = 2;
var STATE_GAME_DRAW             = 3;
var STATE_GAME_EVALUATE         = 4;

var ON_CARD_SHOWN = "ON_CARD_SHOWN";
var ON_CARD_HIDE = "ON_CARD_HIDE";
var ON_CARD_SELECTED = "ON_CARD_SELECTED";

var ON_MOUSE_DOWN  = 0;
var ON_MOUSE_UP    = 1;
var ON_MOUSE_OVER  = 2;
var ON_MOUSE_OUT   = 3;
var ON_DRAG_START  = 4;
var ON_DRAG_END    = 5;

var NATURAL_ROYAL_FLUSH   = 0;
var FIVE_OF_A_KIND        = 1;
var ROYAL_FLUSH           = 2;
var STRAIGHT_FLUSH        = 3;
var FOUR_OF_A_KIND        = 4;
var FULL_HOUSE            = 5;
var FLUSH                 = 6;
var STRAIGHT              = 7;
var THREE_OF_A_KIND       = 8;
var TWO_PAIR              = 9;
var KINGS_OR_BETTER       = 10;
var HIGH_CARD             = 11;

var CARD_TWO = 2;
var CARD_THREE = 3;
var CARD_FOUR = 4;
var CARD_FIVE = 5;
var CARD_SIX = 6;
var CARD_SEVEN = 7;
var CARD_EIGHT = 8;
var CARD_NINE = 9;
var CARD_TEN = 10;
var CARD_JACK = 11;
var CARD_QUEEN = 12;
var CARD_KING = 13;
var CARD_ACE = 14;
var CARD_JOKER = 15;

var SUIT_HEARTS = 0;
var SUIT_DIAMONDS = 1;
var SUIT_CLUBS = 2;
var SUIT_SPADES = 3;

var CARD_WIDTH = 154;
var CARD_HEIGHT = 240;
var BET_TYPE;
var TOTAL_MONEY;
var NUM_BETS = 5;
var WIN_COMBINATIONS = 11;
var COMBO_PRIZES;
var AUTOMATIC_RECHARGE;
var WIN_OCCURRENCE;
var DOUBLE_OCCURRENCE;
var DOUBLE_HALF_OCCURRENCE;
var GAME_CASH;
var MIN_WIN;
var NUM_HAND_FOR_ADS;
var ENABLE_FULLSCREEN;
var ENABLE_CHECK_ORIENTATION;
var SHOW_CREDITS;
