<?php

use App\Models\Gaming\Game;
use App\Models\Gaming\Tournament;
use Illuminate\Database\Seeder;
use Models\Auth\User;

class UserAndTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'nickname' => 'username001',
            'name' => 'Player',
            'lastname' => '01',
            'gender' => User::GENDER_FEMALE,
            'mobile_number' => 584265461179,
            'email' => 'alexplay03@gmail.com',
            'password' => bcrypt('123456'),
            'credits' => 150,
            'country_code' => 'DE',
            'currency_code' => 'EUR',
            'low_balance_threshold' => 0,
            'role' => User::ROLE_USER,
            'locale' => 'en',
            'verified_identification' => true,
            'notifications' => true,
            'lottery_sms_notification_minutes' => 0,
        ]);

        $user2 = User::create([
            'nickname' => 'username002',
            'name' => 'Player',
            'lastname' => '02',
            'gender' => User::GENDER_MALE,
            'mobile_number' => 584265461178,
            'email' => 'alexplay04@gmail.com',
            'password' => bcrypt('123456'),
            'credits' => 150,
            'country_code' => 'DE',
            'currency_code' => 'EUR',
            'low_balance_threshold' => 0,
            'role' => User::ROLE_USER,
            'locale' => 'en',
            'verified_identification' => true,
            'notifications' => true,
            'lottery_sms_notification_minutes' => 0,
        ]);

        $user3 = User::create([
            'nickname' => 'username003',
            'name' => 'Player',
            'lastname' => '03',
            'gender' => User::GENDER_FEMALE,
            'mobile_number' => 584265461177,
            'email' => 'alexplay05@gmail.com',
            'password' => bcrypt('123456'),
            'credits' => 150,
            'country_code' => 'DE',
            'currency_code' => 'EUR',
            'low_balance_threshold' => 0,
            'role' => User::ROLE_USER,
            'locale' => 'en',
            'verified_identification' => true,
            'notifications' => true,
            'lottery_sms_notification_minutes' => 0,
        ]);

        $user4 = User::create([
            'nickname' => 'username004',
            'name' => 'Player',
            'lastname' => '04',
            'gender' => User::GENDER_MALE,
            'mobile_number' => 584265461175,
            'email' => 'alexplay73@gmail.com',
            'password' => bcrypt('123456'),
            'credits' => 150,
            'country_code' => 'DE',
            'currency_code' => 'EUR',
            'low_balance_threshold' => 0,
            'role' => User::ROLE_USER,
            'locale' => 'en',
            'verified_identification' => true,
            'notifications' => true,
            'lottery_sms_notification_minutes' => 0,
        ]);

        $user5 = User::create([
            'nickname' => 'username005',
            'name' => 'Player',
            'lastname' => '05',
            'gender' => User::GENDER_MALE,
            'mobile_number' => 584265461159,
            'email' => 'alexplay55@gmail.com',
            'password' => bcrypt('123456'),
            'credits' => 150,
            'country_code' => 'DE',
            'currency_code' => 'EUR',
            'low_balance_threshold' => 0,
            'role' => User::ROLE_USER,
            'locale' => 'en',
            'verified_identification' => true,
            'notifications' => true,
            'lottery_sms_notification_minutes' => 0,
        ]);

        $tournament = Tournament::create([
            'group' => Game::GROUP_SLOT,
            'prizes' => [2500, 1500, 500],
            'date_from' => \Carbon\Carbon::now(),
            'date_to' => \Carbon\Carbon::now()->addWeek(),
        ]);

        $tournament2 = Tournament::create([
            'group' => Game::GROUP_BINGO,
            'prizes' => [2500, 1500, 500],
            'date_from' => \Carbon\Carbon::now(),
            'date_to' => \Carbon\Carbon::now()->addWeek(),
        ]);

        DB::table('tournament_game')->insert([
            'tournament_id' => $tournament->id,
            'game_id' => 1
        ]);

        DB::table('tournament_game')->insert([
            'tournament_id' => $tournament->id,
            'game_id' => 3
        ]);

        DB::table('tournament_game')->insert([
            'tournament_id' => $tournament->id,
            'game_id' => 5
        ]);

        DB::table('tournament_game')->insert([
            'tournament_id' => $tournament2->id,
            'game_id' => 16
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament->id,
            'user_id' => $user1->id,
            'total_win' => 2500
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament->id,
            'user_id' => $user2->id,
            'total_win' => 2000
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament->id,
            'user_id' => $user3->id,
            'total_win' => 1750
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament->id,
            'user_id' => $user4->id,
            'total_win' => 1000
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament->id,
            'user_id' => $user5->id,
            'total_win' => 500
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament2->id,
            'user_id' => $user3->id,
            'total_win' => 1750
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament2->id,
            'user_id' => $user4->id,
            'total_win' => 1000
        ]);

        DB::table('tournament_user')->insert([
            'tournament_id' => $tournament2->id,
            'user_id' => $user5->id,
            'total_win' => 500
        ]);
    }
}
