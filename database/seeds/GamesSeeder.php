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
            'settings' => '',
            'enabled' => true
        ]);
        Game::create([
            'id' => 2,
            'slug' => '3d-blackjack',
            'icon_url' => 'img/games/2.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_CARD,
            'has_jackpot' => false,
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
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
            'settings' => '',
            'enabled' => true
        ]);
    }
}
