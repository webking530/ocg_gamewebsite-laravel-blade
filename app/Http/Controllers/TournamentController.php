<?php

namespace App\Http\Controllers;

use App\Models\Gaming\CustomGameGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Models\Gaming\Tournament;

class TournamentController extends Controller
{
    public function tournaments() {
        $customGroup = CustomGameGroup::CUSTOM_GROUP_START_ID;

        $tournaments = Tournament::active()->orderByRaw(
            "(CASE WHEN `group` >= $customGroup THEN `group` END) DESC,
            (CASE WHEN `group` < $customGroup THEN `group` END) ASC"
        )->get();

        return view('frontend.tournaments.tournaments', compact('tournaments'));
    }

    public function history($group = null) {
        $history = null;

        if ($group !== null) {
            $history = Tournament::where('group', $group)->finished()->orderBy('date_to', 'DESC')->get();
        }

        return view('frontend.tournaments.history', compact('group', 'history'));
    }

    public function details(Tournament $tournament) {
        $group = $tournament->group;

        return view('frontend.tournaments.details', compact('tournament', 'group'));
    }
}
