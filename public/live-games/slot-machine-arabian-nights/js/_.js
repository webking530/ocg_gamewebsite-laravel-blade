// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// Initialization
let session;
let game;

(() => {
    const init = isProd => {
        isProd ? initProd() : initDev();
        initLang(game.language);
        initConfig(session.credits, game.configuration);
        initPlay(session, game);
        initUi();
    };

    const initProd = () => {
        session = JSON.parse(sessionStorage.getItem(`session`));
        game = JSON.parse(sessionStorage.getItem(`game`));
    };

    const initDev = () => {
        session = {
            token: `555eee`,
            credits: 100000000,
            freeSpins: {
                games: 8,
                bet: 10,
                lines: 10
            }
        };
        game = {
            id: 15,
            serverUrl: 'https://www.ocgcasino.com',
            sessionCloseUrl: 'http://www.google.com',
            language: {
                TEXT_MONEY: "MONEY",
                TEXT_PLAY: "PLAY",
                TEXT_BET: "BET",
                TEXT_COIN: "COIN",
                TEXT_MAX_BET: "MAX BET",
                TEXT_INFO: "INFO",
                TEXT_LINES: "LINES",
                TEXT_SPIN: "SPIN",
                TEXT_AUTOSPIN: "AUTO\nPLAY",
                TEXT_WIN: "WIN",
                TEXT_OK: "OK",
                TEXT_STOP_AUTO: "STOP\nAUTO",
                TEXT_HELP_WILD: "THIS SIMBOL IS A JOLLY WHICH \nCAN REPLACE ANY OTHER \nSYMBOL TO MAKE UP A COMBO",
                TEXT_HELP_BONUS1: "3 OR MORE ON ANY REELS, WILL TRIGGER WHEEL OF FORTUNE BONUS!!",
                TEXT_HELP_BONUS2: "CLICK SPIN BUTTON TO GET YOUR PRIZE!!",
                TEXT_HELP_FREESPIN: "GET 3 OR MORE FREESPIN SYMBOL ON ANY REEL TO TRIGGER FREESPINS",
                TEXT_BONUS_HELP: "SPIN THE WHEEL!!",
                TEXT_CREDITS_DEVELOPED: "DEVELOPED BY",
                TEXT_CURRENCY: "$",
                TEXT_PRELOADER_CONTINUE: "START",

                TEXT_NO_MAX_BET: "NOT ENOUGH MONEY FOR MAX BET!!",
                TEXT_CONNECTION_LOST: "CONNECTION DOWN! PLEASE TRY AGAIN",
                TEXT_NOT_ENOUGH_MONEY: "NOT ENOUGH MONEY FOR THE CURRENT BET!",

                TEXT_CONGRATULATIONS: "Congratulations!",
                TEXT_MSG_SHARE1: "You collected <strong>",
                TEXT_MSG_SHARE2: " points</strong>!<br><br>Share your score with your friends!",
                TEXT_MSG_SHARING1: "My score is ",
                TEXT_MSG_SHARING2: " points! Can you do better?"
            },
            configuration: {
                // From CMain.js
                paytable: [
                    [0, 0, 40, 400, 1000],
                    [0, 0, 20, 100, 500],
                    [0, 0, 20, 80, 400],
                    [0, 0, 20, 40, 200],
                    [0, 0, 10, 20, 100],
                    [0, 0, 5, 20, 50],
                    [0, 0, 5, 10, 25]
                ],
                bets: [10, 50, 100, 200, 500, 1000],
                fullscreen: true,
                checkOrientation: true,
                // From CGame.js
                maxFramesReelEase: 10,
                minReelLoops: 0,
                reelDelay: 0,
                timeShowWins: 1000,
                // Other
                bonus: [
                    [1, 2, 5, 10, 0, 2, 5, 10, 20, 0, 5, 10, 20, 50, 0, 25, 50, 75, 100, 0],
                    [1, 5, 10, 20, 0, 5, 10, 20, 40, 0, 10, 25, 50, 100, 0, 50, 100, 150, 200, 0],
                    [1, 10, 20, 40, 0, 10, 20, 25, 50, 0, 25, 50, 100, 200, 0, 100, 200, 250, 500, 0]
                ]
            }
        };
    };

    // Localization init
    const initLang = lang => {
        TEXT_MONEY = lang.TEXT_MONEY;
        TEXT_PLAY = lang.TEXT_PLAY;
        TEXT_BET = lang.TEXT_BET;
        TEXT_COIN = lang.TEXT_COIN;
        TEXT_MAX_BET = lang.TEXT_MAX_BET;
        TEXT_INFO = lang.TEXT_INFO;
        TEXT_LINES = lang.TEXT_LINES;
        TEXT_SPIN = lang.TEXT_SPIN;
        TEXT_AUTOSPIN = lang.TEXT_AUTOSPIN
        TEXT_WIN = lang.TEXT_WIN;
        TEXT_OK = lang.TEXT_OK;
        TEXT_STOP_AUTO = lang.TEXT_STOP_AUTO;
        TEXT_HELP_WILD = lang.TEXT_HELP_WILD;
        TEXT_HELP_BONUS1 = lang.TEXT_HELP_BONUS1;
        TEXT_HELP_BONUS2 = lang.TEXT_HELP_BONUS2;
        TEXT_HELP_FREESPIN = lang.TEXT_HELP_FREESPIN;
        TEXT_BONUS_HELP = lang.TEXT_BONUS_HELP;
        TEXT_CREDITS_DEVELOPED = lang.TEXT_CREDITS_DEVELOPED;
        TEXT_CURRENCY = lang.TEXT_CURRENCY;
        TEXT_PRELOADER_CONTINUE = lang.TEXT_PRELOADER_CONTINUE;

        TEXT_NO_MAX_BET = lang.TEXT_NO_MAX_BET;
        TEXT_CONNECTION_LOST = lang.TEXT_CONNECTION_LOST;
        TEXT_NOT_ENOUGH_MONEY = lang.TEXT_NOT_ENOUGH_MONEY;

        TEXT_CONGRATULATIONS = lang.TEXT_CONGRATULATIONS;
        TEXT_MSG_SHARE1 = lang.TEXT_MSG_SHARE1;
        TEXT_MSG_SHARE2 = lang.TEXT_MSG_SHARE2;
        TEXT_MSG_SHARING1 = lang.TEXT_MSG_SHARING1;
        TEXT_MSG_SHARING2 = lang.TEXT_MSG_SHARING2;
    };

    // Settings init
    const initConfig = (credits, config) => {
        // From CMain.js
        PAYTABLE_VALUES = config.paytable;
        COIN_BET = config.bets.map(bet => bet / 100);
        MIN_BET = config.bets[0] / 100;
        MAX_BET = config.bets[config.bets.length - 1] / 100;
        ENABLE_FULLSCREEN = config.fullscreen;
        ENABLE_CHECK_ORIENTATION = config.checkOrientation;
        SHOW_CREDITS = false;
        // From CGame.js
        MAX_FRAMES_REEL_EASE = config.maxFramesReelEase;
        MIN_REEL_LOOPS = config.minReelLoops;
        REEL_DELAY = config.reelDelay;
        TIME_SHOW_WIN = config.timeShowWins;
        TIME_SHOW_ALL_WINS = config.timeShowWins;
        TOTAL_MONEY = credits / 100;
        // Other
        BONUS_PRIZE = config.bonus;
    };

    // Play init
    const initPlay = (session, game) => {
        playUrl = `${game.serverUrl}/account/game/play/${game.id}?bet={bet}&lines={lines}&token=${session.token}`;
        freeSpins = session.freeSpins;
    };

    // UI init
    const initUi = () => {
        new CMain();
        if (isIOS()) {
            setTimeout(function () { sizeHandler(); }, 200);
        } else {
            sizeHandler();
        }
    };

    window.addEventListener(`load`, () => init(sessionStorage.getItem(`session`) && sessionStorage.getItem(`game`)));
})();

// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// Playing
let playUrl;
let lastPlay;

const play = (betIndex, lines) => {
    const errorPlay = getErrorData(lastPlay ? lastPlay.data : { credits: session.credits, freeSpinsData: 0 });
    lastPlay = undefined;
    const url = playUrl.replace(`{bet}`, game.configuration.bets[betIndex]).replace('{lines}', lines);
    const request = new XMLHttpRequest();
    request.open(`GET`, url, true);
    request.addEventListener(`load`, () => {
        processResponse(JSON.parse(request.responseText));
    });
    request.addEventListener(`error`, () => {
        processResponse(errorPlay);
    });
    request.addEventListener(`abort`, () => {
        processResponse(errorPlay);
    });
    request.send();
};

const getErrorData = data => ({
    data: {
        combination: [
            [1, 2, 3, 4, 5],
            [1, 2, 3, 4, 5],
            [1, 2, 3, 4, 5]
        ],
        win: 0,
        wins: [],
        credits: data.credits,
        bonus: false,
        numItemInBonus: 0,
        bonusData: {
            id: -1,
            amount: -1
        },
        freeSpins: false,
        freeSpinsData: data.freeSpinsData,
        jackpot: false,
        jackpotData: 0
    },
    error: {
        code: 'custom',
        message: ''
    }
});

const processResponse = data => {
    lastPlay = data;
    emit(`play`, lastPlay.data);
    emit(`bonus`, lastPlay.data);
    if (lastPlay.error.code !== `success`) {
        emit('error', lastPlay.error);
        if (lastPlay.error.code === `invalid_token`) {
            close();
        }
    }
};

// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// Closing
const close = () => {
    parent.window.location.href = game.sessionCloseUrl;
};

// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// Events
const events = {};

const on = (event, callback) => {
    events[event] = callback;
};

const emit = (event, data) => {
    if (events[event]) {
        events[event](data);
    }
};

// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
// Free spins
let freeSpins;