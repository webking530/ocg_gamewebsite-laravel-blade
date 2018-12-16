<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\GameMathService;
use Models\Gaming\GameService;

class GameMathController extends Controller
{
    public function regenerateMath() {
        GameMathService::generateMathFiles();

        $this->flashNotifier->success('Math files generated successfully');

        return redirect()->back();
    }

    public function restartMathServer() {
        GameMathService::restartMathServer();

        $this->flashNotifier->success('Server restarted successfully');

        return redirect()->back();
    }
}
