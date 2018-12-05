<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gaming\CustomGameGroup;
use Models\Gaming\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Models\Gaming\Tournament;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TournamentController extends Controller {

    public function index() {
        return view('admin.tournament.index');
    }

    public function showdata(Request $request) {
        $input = $request->all();
        $customGroup = CustomGameGroup::CUSTOM_GROUP_START_ID;
        $tournaments = Tournament::select('id', 'group', 'prizes', 'date_from', 'date_to', 'status', 'level', 'updated_at')->active()->orderByRaw(
                "(CASE WHEN `group` >= $customGroup THEN `group` END) DESC,
            (CASE WHEN `group` < $customGroup THEN `group` END) ASC"
        );
        $tournaments->orderBy('id', 'desc');
        $data = $tournaments->get()->toArray();
        foreach ($tournaments->get() as $key => $tournament) {
            $data[$key]['recreate'] = null;
            $timediff = strtotime(date('Y-m-d H:i:s')) - strtotime($tournament->updated_at);
            if ($tournament->status == Tournament::STATUS_CANCELLED && $timediff > 86400) {
                $data[$key]['recreate'] = 1;
            } else if ($tournament->status == Tournament::STATUS_PENDING) {
                $data[$key]['recreate'] = 0;
            }
            $data[$key]['users'] = $tournament->users()->count();
            $data[$key]['tournamentends'] = '';
            if (!$tournament->isCancelled()) {
                if ($tournament->isExtended()) {
                    $data[$key]['tournamentends'] = trans('frontend/tournaments.tournament_extended', ['date_to' => $tournament->date_to->format('l, F j, Y, g:i a'), 'date_extended' => $tournament->extended_at->format('l, F j, Y, g:i a')]);
                } else {
                    $data[$key]['tournamentends'] = $tournament->date_to->diffForHumans();
                }
            }
            $data[$key]['group'] = $tournament->formattedGroup;
            $data[$key]['FormattedStatus'] = $tournament->formatted_status;
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            if ($request->has('status') && $request->status != null) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    return Str::contains(Str::lower($row['status']), Str::lower($request->get('status'))) ? true : false;
                                });
                            }
                            if ($request->has('level') && $request->level != null) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    return Str::contains(Str::lower($row['level']), Str::lower($request->get('level'))) ? true : false;
                                });
                            }
                        })->make(true);
    }

    public function cancel($id) {

        $tournament = Tournament::findOrFail($id);
        $tournament->status = Tournament::STATUS_CANCELLED;
        if ($tournament->save()) {
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->back();
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function create() {
        $this->flashNotifier->success(trans('app.common.operation_success'));
        Artisan::call('tournaments:init');
        return redirect()->route('tournament.index');
    }

    public function editSettings() {
        return view('admin.tournament.editSettings');
    }

    public function updateSettings(Request $request) {
        $data = $request->except('_token');
        settings($data);
        $this->flashNotifier->success(trans('app.common.operation_success'));
        return redirect()->route('tournament.index');
    }

    public function recreate($id) {
        $tournament = Tournament::find($id);
        if ($tournament->isCustom()) {
            $games = Game::get();
        } else {
            $games = Game::where('group', $tournament->group)->get();
        }
        $tournamentGames = array_column($tournament->games->toArray(), 'id');
        return view('admin.tournament.create', compact('tournament', 'games', 'tournamentGames'));
    }

    public function store(Request $request) {
        $tournamentServie = new \Models\Gaming\TournamentService();
        $games = Game::select('id')->whereIn('id', $request->get('game'))->get();
        $createTournamanet = $tournamentServie->createTournament($request->get('group'), $request->get('level'), $games);
        $this->flashNotifier->success(trans('app.common.operation_success'));
        return redirect()->route('tournament.index');
    }

    public function edit($id) {
        $tournament = Tournament::findOrFail($id);
        if ($tournament->isCustom()) {
            $games = Game::get();
        } else {
            $games = Game::where('group', $tournament->group)->get();
        }
        $tournamentGames = array_column($tournament->games->toArray(), 'id');

        return view('admin.tournament.edit', compact('tournament', 'games', 'tournamentGames'));
    }

    public function update(Request $request, $id) {
        $tournament = Tournament::findOrFail($id);
        $tpaLevels = json_decode(settings('tournament_tpa_levels'));
        $tournament->prizes = $tpaLevels[$request->get('level')]->prizes;
        $tournament->level = $request->get('level');
        if ($tournament->save()) {
            $games = $request->get('game');
            $now = Carbon::now();
            DB::table('tournament_game')->where('tournament_id', $tournament->id)->delete();
            foreach ($games as $game) {
                DB::table('tournament_game')->insert([
                    'tournament_id' => $tournament->id,
                    'game_id' => $game,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('tournament.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function customTournamentCreate() {
        $games = Game::select('id')->get();
        $languages = \Models\Location\Language::get();
        return view('admin.tournament.customCreate', compact('games', 'languages'));
    }

    public function customTournamentStore(Request $request) {
        $languages = $request->get('languages');
        $games = Game::select('id')->whereIn('id', $request->get('game'))->get();
        DB::beginTransaction();
        try {
            $customGroup = new CustomGameGroup();
            $now = Carbon::now();
            $group = CustomGameGroup::max('group');
            foreach ($languages as $key => $language) {
                $data[] = array(
                    'group' => $group + 1,
                    'locale' => $key,
                    'name' => $language,
                    'created_at' => $now,
                    'updated_at' => $now
                );
            }
            $customGroup->insert($data);

            $tournamentServie = new \Models\Gaming\TournamentService();
            $createTournamanet = $tournamentServie->createTournament($group + 1, $request->get('level'), $games);
            DB::commit();
            $this->flashNotifier->success(trans('app.common.operation_success'));
            return redirect()->route('tournament.index');
        } catch (\Exception $e) {
            DB::rollback();
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

}
