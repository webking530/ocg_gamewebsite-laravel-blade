<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameMathController extends Controller
{
    public function regenerateMath() {
        $this->flashNotifier->success('Math files generated successfully');

        return redirect()->back();
    }

    public function restartMathServer() {
        exec('cd /web/ocgcasino.com/ocg_math/public && nodejs server.js > /dev/null &');

        $this->flashNotifier->success('Server restarted successfully');

        return redirect()->back();
    }
}
