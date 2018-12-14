<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\GameService;

class GameMathController extends Controller
{
    private $gameService;

    public function __construct(GameService $gameService)
    {
        parent::__construct();
        $this->gameService = $gameService;
    }

    public function regenerateMath() {
        $this->gameService->generateMathFiles();

        $this->flashNotifier->success('Math files generated successfully');

        return redirect()->back();
    }

    public function restartMathServer() {
        $this->gameService->restartMathServer();

        $this->flashNotifier->success('Server restarted successfully');

        return redirect()->back();
    }
}
