<?php

namespace App\Http\Controllers\Game;

use App\Data\Game\GameData;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('games/Index', [
            'games' => GameData::collect(Game::all()),
        ]);
    }
}
