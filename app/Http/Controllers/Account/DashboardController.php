<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $user = \Auth::user();

        return view('user.dashboard', compact('user'));
    }
}
