<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\GameMathService;
use Models\Gaming\GameService;

class GameMathController extends Controller
{
    public function regenerateMath() {
        $output = GameMathService::generateMathFiles();

        $this->flashNotifier->success(
            'Command output: <br><br>' .
            implode($output, '<br>')
        );

        return redirect()->back();
    }

    public function restartMathServer() {
        $output = GameMathService::restartMathServer();

        $this->flashNotifier->success(
            'Command output: <br><br>' .
            implode($output, '<br>')
        );

        return redirect()->back();
    }
}
