<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Auth\User;
use Models\Gaming\Game;

class DashboardController extends Controller
{


    public function index() {
        $user = $this->user;

        return view('user.dashboard', compact('user'));
    }

    public function closeSession(Game $game) {
        $this->user->gameSessions()->detach($game->id);

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->back();
    }

    public function closeAllSessions() {
        $this->user->gameSessions()->detach();

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->back();
    }
}
