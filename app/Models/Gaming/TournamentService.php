<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 08/10/18
 * Time: 06:24 PM
 */

namespace Models\Gaming;


use Carbon\Carbon;
use DB;
use Models\Auth\User;

class TournamentService
{
    private $tpaLevels;

    public function __construct() {
        $this->tpaLevels = json_decode(settings('tournament_tpa_levels'));
    }

    public function createInitialTournaments() {
        foreach (Game::GROUP_LIST as $group) {
            $this->createTournament($group, 0);
        }
    }

    public function createTournamentFromPrevious(Tournament $tournament) {
        // Max tournament level reached. Next tournaments won't go higher than this
        if ($tournament->level == Tournament::MAX_LEVEL) {
            $this->createTournament($tournament->group, Tournament::MAX_LEVEL);
            return;
        }

        // If previous tournament was extended. Create the new one with the same level.
        if ($tournament->isExtended()) {
            $this->createTournament($tournament->group, $tournament->level);
            return;
        }

        // Only proceed to the next level tournament if the previous one finished and it was not extended
        $this->createTournament($tournament->group, $tournament->level + 1);
    }

    // Enrolls newly registered users, or users who recently met the requirements to enter a tournament
    public function enrollNewUsers(Tournament $tournament) {
        $now = Carbon::now();

        $users = User::users()->enabled()->verified()->hasCredits()
                ->whereNotIn('id', function($query) use ($tournament) {
                    $query->select('user_id')->from('tournament_user')->where('tournament_id', $tournament->id);
                })->get();

        foreach ($users as $user) {
            DB::table('tournament_user')->insert([
                'tournament_id' => $tournament->id,
                'user_id' => $user->id,
                'total_win' => 0,
                'total_lose' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }

    public function createTournament($group, $level) {
        $now = Carbon::now();

        $tournament = Tournament::create([
            'group' => $group,
            'prizes' => $this->tpaLevels[$level]['prizes'],
            'date_from' => Carbon::now(),
            'date_to' => Carbon::now()->addDays(settings('tournament_base_days')),
            'status' => Tournament::STATUS_PENDING,
            'level' => $level,
        ]);

        $games = Game::enabled()->where('group', $group)->select('id')->get();

        foreach ($games as $game) {
            DB::table('tournament_game')->insert([
                'tournament_id' => $tournament->id,
                'game_id' => $game->id,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        $users = User::users()->enabled()->verified()->hasCredits()->select('id')->get();

        foreach ($users as $user) {
            DB::table('tournament_user')->insert([
                'tournament_id' => $tournament->id,
                'user_id' => $user->id,
                'total_win' => 0,
                'total_lose' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}