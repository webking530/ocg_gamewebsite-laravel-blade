<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Models\Location\Language;
use Models\Pricing\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Models\Pricing\Withdrawal;
use Models\Pricing\Country;
use Models\Pricing\Currency;
use Models\Auth\User;


class AdminController extends Controller
{
    public function index() {
        return view('admin.home');
    }
}
