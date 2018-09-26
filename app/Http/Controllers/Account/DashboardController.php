<?php

namespace App\Http\Controllers\Account;

use DB;
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
        $this->user->closeGameSession($game);

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->back();
    }

    public function closeAllSessions() {
        $this->user->closeAllGameSessions();

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->back();
    }
}
