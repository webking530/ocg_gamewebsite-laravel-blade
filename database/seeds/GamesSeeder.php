<?php

use Models\Gaming\Game;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([
            'id' => 1,
            'slug' => 'slot-machine-the-fruits',
            'icon_url' => 'img/games/1.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'TheFruits',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HELP_WILD',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',
                    'TEXT_SHARE_IMAGE',
                    'TEXT_SHARE_TITLE',
                    'TEXT_SHARE_MSG1',
                    'TEXT_SHARE_MSG2',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 80, 400],
                        [0, 0, 20, 40, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 5, 20, 50],
                        [0, 0, 5, 10, 25]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000
                ]
            ],
            'enabled' => true,
        ]);
        Game::create([
            'id' => 2,
            'slug' => '3d-blackjack',
            'icon_url' => 'img/games/2.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 3,
            'slug' => 'slot-machine-ultimate-soccer',
            'icon_url' => 'img/games/3.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'TheFruits',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HELP_WILD',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',

                    'TEXT_SHARE_IMAGE',
                    'TEXT_SHARE_TITLE',
                    'TEXT_SHARE_MSG1',
                    'TEXT_SHARE_MSG2',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 80, 400],
                        [0, 0, 20, 40, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 5, 20, 50],
                        [0, 0, 5, 10, 25]
                    ],
                    'bets' => [10, 25, 50, 100, 200, 300, 500],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 4,
            'slug' => '3d-roulette',
            'icon_url' => 'img/games/4.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_ROULETTE,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 5,
            'slug' => 'slot-machine-mr-chicken',
            'icon_url' => 'img/games/5.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'SpaceAdventure',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 6,
            'slug' => 'jacks-or-better',
            'icon_url' => 'img/games/6.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 7,
            'slug' => 'slot-machine-space-adventure',
            'icon_url' => 'img/games/7.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'SpaceAdventure',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 8,
            'slug' => 'scratch-fruit',
            'icon_url' => 'img/games/8.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_INSTANT_WIN,
            'group' => Game::GROUP_OTHER,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 9,
            'slug' => '3-cards-monte',
            'icon_url' => 'img/games/9.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => false
        ]);
        Game::create([
            'id' => 10,
            'slug' => 'high-or-low',
            'icon_url' => 'img/games/10.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_INSTANT_WIN,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 11,
            'slug' => 'wheel-of-fortune',
            'icon_url' => 'img/games/11.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_INSTANT_WIN,
            'group' => Game::GROUP_OTHER,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 12,
            'slug' => 'keno',
            'icon_url' => 'img/games/12.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_BINGO,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 13,
            'slug' => 'slot-machine-ramses-treasure',
            'icon_url' => 'img/games/13.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'SpaceAdventure',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 14,
            'slug' => 'slot-machine-lucky-christmas',
            'icon_url' => 'img/games/14.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'SpaceAdventure',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 15,
            'slug' => 'slot-machine-arabian-nights',
            'icon_url' => 'img/games/15.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'ArabianNights',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_AUTOSPIN',
                    'TEXT_WIN',
                    'TEXT_OK',
                    'TEXT_STOP_AUTO',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS1',
                    'TEXT_HELP_BONUS2',
                    'TEXT_HELP_FREESPIN',
                    'TEXT_BONUS_HELP',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_NO_MAX_BET',
                    'TEXT_CONNECTION_LOST',
                    'TEXT_NOT_ENOUGH_MONEY',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 80, 400],
                        [0, 0, 20, 40, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 5, 20, 50],
                        [0, 0, 5, 10, 25]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [1, 2, 5, 10, 0, 2, 5, 10, 20, 0, 5, 10, 20, 50, 0, 25, 50, 75, 100, 0],
                        [1, 5, 10, 20, 0, 5, 10, 20, 40, 0, 10, 25, 50, 100, 0, 50, 100, 150, 200, 0],
                        [1, 10, 20, 40, 0, 10, 20, 25, 50, 0, 25, 50, 100, 200, 0, 100, 200, 250, 500, 0]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 16,
            'slug' => 'bingo',
            'icon_url' => 'img/games/16.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_BINGO,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 17,
            'slug' => 'baccarat',
            'icon_url' => 'img/games/17.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 18,
            'slug' => 'craps',
            'icon_url' => 'img/games/18.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_OTHER,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 19,
            'slug' => 'caribbean-stud',
            'icon_url' => 'img/games/19.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 20,
            'slug' => 'pai-gow-poker',
            'icon_url' => 'img/games/20.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 21,
            'slug' => 'joker-poker',
            'icon_url' => 'img/games/21.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 22,
            'slug' => 'three-card-poker',
            'icon_url' => 'img/games/22.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 23,
            'slug' => 'spin-and-win',
            'icon_url' => 'img/games/23.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_INSTANT_WIN,
            'group' => Game::GROUP_OTHER,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 24,
            'slug' => 'plinko',
            'icon_url' => 'img/games/24.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_OTHER,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 25,
            'slug' => 'roulette-royale',
            'icon_url' => 'img/games/25.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_ROULETTE,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 26,
            'slug' => 'american-roulette-royale',
            'icon_url' => 'img/games/26.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_ROULETTE,
            'has_jackpot' => false,
            'settings' => [
                'config_name' => 'TheFruits'
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 27,
            'slug' => 'slot-machine-zodiac-space-adventure',
            'icon_url' => 'img/games/7.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'ZodiacSpaceAdventure',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        Game::create([
            'id' => 28,
            'slug' => 'slot-machine-zodiac-space-adventure-deluxe',
            'icon_url' => 'img/games/7.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'ZodiacSpaceAdventureDeluxe',
                'language' => [
                    'TEXT_MONEY',
                    'TEXT_PLAY',
                    'TEXT_BET',
                    'TEXT_COIN',
                    'TEXT_MAX_BET',
                    'TEXT_INFO',
                    'TEXT_LINES',
                    'TEXT_SPIN',
                    'TEXT_WIN',
                    'TEXT_HOLD',
                    'TEXT_HELP_WILD',
                    'TEXT_HELP_BONUS',
                    'TEXT_CREDITS_DEVELOPED',
                    'TEXT_CURRENCY',
                    'TEXT_PRELOADER_CONTINUE',

                    'TEXT_CONGRATULATIONS',
                    'TEXT_SHARE_SHARE1',
                    'TEXT_SHARE_SHARE2',
                    'TEXT_MSG_SHARING1',
                    'TEXT_MSG_SHARING2'
                ],
                'configuration' => [
                    'paytable' => [
                        [0, 0, 40, 400, 1000],
                        [0, 0, 20, 100, 500],
                        [0, 0, 20, 50, 400],
                        [0, 0, 20, 50, 400],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 30, 200],
                        [0, 0, 10, 20, 100],
                        [0, 0, 10, 20, 100]
                    ],
                    'bets' => [10, 50, 100, 200, 500, 1000],
                    'fullscreen' => true,
                    'checkOrientation' => true,
                    'maxFramesReelEase' => 10,
                    'minReelLoops' => 0,
                    'reelDelay' => 0,
                    'timeShowWins' => 1000,
                    'bonus' => [
                        [5, 10, 25],
                        [10, 25, 50],
                        [25, 50, 100]
                    ]
                ]
            ],
            'enabled' => true
        ]);
        /*Game::create([
            'id' => 999,
            'slug' => 'slot-machine-dummy',
            'icon_url' => 'img/games/1.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => [
                'config_name' => 'Dummy'
            ],
            'enabled' => true
        ]);*/
    }
}
