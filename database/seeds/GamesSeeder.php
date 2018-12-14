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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"min_reel_loop":2,"reel_delay":6,"time_show_win":2000,"time_show_all_wins":2000,"paytable_symbol_1":[0,0,100,150,200],"paytable_symbol_2":[0,0,50,100,150],"paytable_symbol_3":[0,10,25,50,100],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,5,15,25,50],"paytable_symbol_6":[0,2,10,20,35],"paytable_symbol_7":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"ad_show_counter":3}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"min_bet":1,"max_bet":300,"bet_time":10000,"blackjack_payout":1.5,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":3}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"min_reel_loop":2,"reel_delay":6,"time_show_win":2000,"time_show_all_wins":2000,"paytable_symbol_1":[0,0,100,150,200],"paytable_symbol_2":[0,0,50,100,150],"paytable_symbol_3":[0,10,25,50,100],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,5,15,25,50],"paytable_symbol_6":[0,2,10,20,35],"paytable_symbol_7":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"ad_show_counter":3}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"casino_cash","live":{"min_bet":0.1,"max_bet":1000,"time_bet":0,"time_winner":3000,"win_occurrence":30,"fullscreen":true,"check_orientation":true,"show_credits":false,"num_hand_before_ads":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"bonus_occurrence":15,"min_reel_loop":1,"reel_delay":0,"time_show_win":2000,"time_show_all_wins":2000,"min_bet":0.05,"max_bet":0.5,"max_hold":3,"perc_win_egg_1":50,"perc_win_egg_2":35,"perc_win_egg_3":15,"paytable_symbol_1":[0,0,150,250,500],"paytable_symbol_2":[0,0,100,150,200],"paytable_symbol_3":[0,0,50,100,150],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,10,25,50,100],"paytable_symbol_6":[0,5,15,25,50],"paytable_symbol_7":[0,2,10,20,35],"paytable_symbol_8":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"num_spin_ads_showing":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"bets":[0.2,0.3,0.5,1,2,3,5],"combo_prizes":[250,50,25,9,6,4,3,2,1],"recharge":true,"fullscreen":true,"check_orientation":true,"show_credits":false,"num_hand_before_ads":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"bonus_occurrence":15,"min_reel_loop":1,"reel_delay":0,"time_show_win":2000,"time_show_all_wins":2000,"min_bet":0.05,"max_bet":0.5,"max_hold":3,"perc_win_bonus_prize_1":50,"perc_win_bonus_prize_2":35,"perc_win_bonus_prize_3":15,"paytable_symbol_1":[0,0,150,250,500],"paytable_symbol_2":[0,0,100,150,200],"paytable_symbol_3":[0,0,50,100,150],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,10,25,50,100],"paytable_symbol_6":[0,5,15,25,50],"paytable_symbol_7":[0,2,10,20,35],"paytable_symbol_8":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"num_spin_ads_showing":10}}',
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
            'settings' => '{"user_cash_key":"player_credit","game_cash_key":"cash_credit","live":{"fullscreen":true,"check_orientation":true,"show_credits":false,"bet_to_play":[1,2,3],"prize":[1,2.5,5,15,40,90,170,400,1000],"prizeprob":[30,22,17,10,8,6,4,2,1],"win_occurrence":30,"multiple_win_percentage":[70,25,5],"scratch_tolerance_per_cell":50,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"starting_money","game_cash_key":"starting_cash","live":{"win_occurrence":40,"fiches_value":[1,5,10,25,100],"turn_card_speed":400,"showtext_timespeed":3500,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":10}}',
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
            'settings' => '{"user_cash_key":"start_credit","game_cash_key":"bank_cash","live":{"start_bet":10,"bet_offset":10,"max_bet":100,"wheel_settings":[{"prize":10,"win_occurence":7},{"prize":30,"win_occurence":6},{"prize":60,"win_occurence":6},{"prize":90,"win_occurence":6},{"prize":0,"win_occurence":5},{"prize":20,"win_occurence":6},{"prize":60,"win_occurence":5},{"prize":120,"win_occurence":4},{"prize":200,"win_occurence":3},{"prize":0,"win_occurence":5},{"prize":40,"win_occurence":5},{"prize":30,"win_occurence":5},{"prize":20,"win_occurence":6},{"prize":10,"win_occurence":7},{"prize":0,"win_occurence":5},{"prize":80,"win_occurence":4},{"prize":60,"win_occurence":4},{"prize":40,"win_occurence":5},{"prize":1000,"win_occurence":1},{"prize":0,"win_occurence":5}],"anim_idle_change_frequency":10000,"led_anim_idle1_timespeed":2000,"led_anim_idle2_timespeed":100,"led_anim_idle3_timespeed":150,"led_anim_spin_timespeed":50,"led_anim_win_duration":5000,"led_anim_win1_timespeed":300,"led_anim_win2_timespeed":50,"led_anim_lose_duration":5000,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"start_player_money","game_cash_key":"bank_money","live":{"win_occurrence":["-",65,60,55,50,45,40,35,30,25],"payouts":[{"hits":["-"],"pays":["-"],"occurrence":[0]},{"hits":[2,1],"pays":[9,1],"occurrence":[20,80]},{"hits":[3,2],"pays":[47,2],"occurrence":[20,80]},{"hits":[4,3,2],"pays":[91,5,2],"occurrence":[10,30,60]},{"hits":[5,4,3],"pays":[820,12,3],"occurrence":[10,30,60]},{"hits":[6,5,4,3],"pays":[1600,70,4,3],"occurrence":[10,20,30,40]},{"hits":[7,6,5,4,3],"pays":[7000,400,21,2,1],"occurrence":[5,10,20,30,35]},{"hits":[8,7,6,5,4],"pays":[10000,1650,100,12,2],"occurrence":[5,10,20,30,35]},{"hits":[9,8,7,6,5,4],"pays":[10000,4700,335,44,6,1],"occurrence":[1,4,10,20,30,35]},{"hits":[10,9,8,7,6,5],"pays":[10000,4500,1000,142,24,5],"occurrence":[1,4,10,15,30,40]}],"animation_speed":300,"fullscreen":true,"check_orientation":true,"show_credits":false,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"bonus_occurrence":15,"min_reel_loop":1,"reel_delay":0,"time_show_win":2000,"time_show_all_wins":2000,"min_bet":0.05,"max_bet":0.5,"max_hold":3,"bonus_prize_for_3_symbol":[5,50,100],"bonus_prize_for_4_symbol":[10,100,200],"bonus_prize_for_5_symbol":[50,200,500],"perc_win_prize_1":50,"perc_win_prize_2":35,"perc_win_prize_3":15,"paytable_symbol_1":[0,0,150,250,500],"paytable_symbol_2":[0,0,100,150,200],"paytable_symbol_3":[0,0,50,100,150],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,10,25,50,100],"paytable_symbol_6":[0,5,15,25,50],"paytable_symbol_7":[0,2,10,20,35],"paytable_symbol_8":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"num_spin_ads_showing":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"bonus_occurrence":15,"min_reel_loop":1,"reel_delay":0,"time_show_win":2000,"time_show_all_wins":2000,"min_bet":0.05,"max_bet":0.5,"max_hold":3,"perc_win_bonus_prize_1":50,"perc_win_bonus_prize_2":35,"perc_win_bonus_prize_3":15,"paytable_symbol_1":[0,0,150,250,500],"paytable_symbol_2":[0,0,100,150,200],"paytable_symbol_3":[0,0,50,100,150],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,10,25,50,100],"paytable_symbol_6":[0,5,15,25,50],"paytable_symbol_7":[0,2,10,20,35],"paytable_symbol_8":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"num_spin_ads_showing":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"min_reel_loop":0,"reel_delay":6,"time_show_win":2000,"time_show_all_wins":2000,"freespin_occurrence":15,"bonus_occurrence":15,"freespin_symbol_num_occur":[50,30,20],"num_freespin":[4,6,8],"bonus_prize":[10,30,60,90,0,20,60,120,200,0,40,30,20,10,0,80,60,40,1000,0],"bonus_prize_occur":[6,6,6,5,6,5,4,3,1,5,5,6,7,5,4,4,5,5,1,4],"coin_bet":[0.05,0.1,0.15,0.2,0.25,0.3,0.35,0.4,0.45,0.5],"paytable_symbol_1":[0,0,90,150,200],"paytable_symbol_2":[0,0,80,110,160],"paytable_symbol_3":[0,0,70,100,150],"paytable_symbol_4":[0,0,50,80,110],"paytable_symbol_5":[0,0,40,60,80],"paytable_symbol_6":[0,0,30,50,70],"paytable_symbol_7":[0,0,20,30,50],"fullscreen":false,"check_orientation":true,"show_credits":false,"num_spin_ads_showing":10}}',
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
            'settings' => '{"user_cash_key":"start_player_money","game_cash_key":"bank_money","live":{"starting_bet":0.25,"coin_bet":[0.25,0.5,1],"win_occurrence":[40,50,60],"time_extraction":1500,"paytable":[[5,50,100],[2,10,50],[1,2,20]],"fullscreen":true,"check_orientation":true,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"bet_occurrence":[20,30,50],"min_bet":0.1,"max_bet":300,"multiplier":[8,1.95,2],"time_show_hand":2500,"fullscreen":true,"check_orientation":true,"ad_show_counter":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"casino_cash","live":{"min_bet":1,"max_bet":100,"win_occurrence":30,"time_show_dice_result":3000,"show_credits":false,"fullscreen":false,"check_orientation":true,"num_hand_before_ads":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"min_bet":0.1,"max_bet":300,"payout":[100,50,20,7,5,4,3,2,1],"time_show_hand":1500,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"min_bet":1,"max_bet":300,"time_show_hand":1500,"fullscreen":true,"check_orientation":true,"show_credits":false,"ad_show_counter":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"double_occurrence":30,"double_half_occurrence":60,"bets":[0.2,0.3,0.5,1,2,3,5],"combo_prizes":[250,200,100,50,17,7,5,3,2,1,1],"recharge":true,"fullscreen":true,"check_orientation":true,"show_credits":false,"num_hand_before_ads":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"game_cash","live":{"win_occurrence":40,"min_bet":1,"max_bet":300,"ante_payout":[5,4,1],"plus_payouts":[40,30,6,4,1],"time_show_hand":1500,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":10}}',
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
            'settings' => '{"user_cash_key":"start_credit","game_cash_key":"bank_cash","live":{"start_bet":10,"max_multiplier":5,"wheel_spin_time":12,"money_wheel_settings":[{"prize":1000,"type":"prize","background":"bg_0","textcolor":"#ff7800","textstrokecolor":"#FFFFFF","win_occurrence":1},{"prize":0,"type":"prize","background":"bg_1","textcolor":"#FFFFFF","textstrokecolor":"#a20303","win_occurrence":16},{"prize":30,"type":"prize","background":"bg_2","textcolor":"#FFFFFF","textstrokecolor":"#c203e3","win_occurrence":4},{"prize":50,"type":"prize","background":"bg_3","textcolor":"#FFFFFF","textstrokecolor":"#6a25c9","win_occurrence":2},{"prize":0,"type":"prize","background":"bg_1","textcolor":"#FFFFFF","textstrokecolor":"#a20303","win_occurrence":16},{"prize":5,"type":"freespin","background":"bg_0","textcolor":"#a20303","textstrokecolor":"#FFFFFF","win_occurrence":16},{"prize":10,"type":"prize","background":"bg_4","textcolor":"#FFFFFF","textstrokecolor":"#018ab9","win_occurrence":12},{"prize":20,"type":"prize","background":"bg_5","textcolor":"#FFFFFF","textstrokecolor":"#0b8a02","win_occurrence":7},{"prize":0,"type":"prize","background":"bg_1","textcolor":"#FFFFFF","textstrokecolor":"#a20303","win_occurrence":16},{"prize":15,"type":"prize","background":"bg_6","textcolor":"#FFFFFF","textstrokecolor":"#cf6906","win_occurrence":10},{"prize":0,"type":"prize","background":"bg_1","textcolor":"#FFFFFF","textstrokecolor":"#a20303","win_occurrence":16}],"total_money_backgrounds_in_folder":7,"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"start_credit","game_cash_key":"bank_cash","live":{"start_bet":10,"max_multiplier":5,"prize":[0,20,100,50,0,10],"prize_probability":[10,8,1,4,10,10],"show_credits":false,"fullscreen":true,"check_orientation":true,"ad_show_counter":5}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"casino_cash","live":{"min_bet":0.1,"max_bet":1000,"time_bet":0,"time_winner":1500,"win_occurrence":30,"fullscreen":true,"check_orientation":true,"show_credits":false,"num_hand_before_ads":10}}',
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
            'settings' => '{"user_cash_key":"money","game_cash_key":"casino_cash","live":{"min_bet":0.1,"max_bet":1000,"time_bet":0,"time_winner":1500,"win_occurrence":40,"fullscreen":true,"check_orientation":true,"show_credits":false,"num_hand_before_ads":10}}',
            'enabled' => true
        ]);

        Game::create([
            'id' => 999,
            'slug' => 'slot-machine-dummy',
            'icon_url' => 'img/games/1.jpg',
            'credits' => 0,
            'type' => GAME::TYPE_NORMAL,
            'group' => Game::GROUP_SLOT,
            'has_jackpot' => true,
            'settings' => '{"user_cash_key":"money","game_cash_key":"slot_cash","live":{"win_occurrence":30,"min_reel_loop":2,"reel_delay":6,"time_show_win":2000,"time_show_all_wins":2000,"paytable_symbol_1":[0,0,100,150,200],"paytable_symbol_2":[0,0,50,100,150],"paytable_symbol_3":[0,10,25,50,100],"paytable_symbol_4":[0,10,25,50,100],"paytable_symbol_5":[0,5,15,25,50],"paytable_symbol_6":[0,2,10,20,35],"paytable_symbol_7":[0,1,5,10,15],"fullscreen":true,"check_orientation":true,"show_credits":false,"ad_show_counter":3}}',
            'enabled' => true
        ]);
    }
}
