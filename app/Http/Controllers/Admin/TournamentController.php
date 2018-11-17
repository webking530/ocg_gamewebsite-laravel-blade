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
            $data[$key]['status'] = $tournament->formatted_status;
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
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
        $games = Game::enabled()->where('group', $id)->get();
        return view('admin.tournament.create', compact('tournament', 'games'));
    }

    public function store(Request $request) {
        $tournamentServie = new \Models\Gaming\TournamentService();
        $createTournamanet = $tournamentServie->createTournament($request->get('group'), $request->get('level'));
        $this->flashNotifier->success(trans('app.common.operation_success'));
        return redirect()->route('tournament.index');
    }

}
