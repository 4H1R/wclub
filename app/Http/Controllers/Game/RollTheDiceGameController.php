<?php

namespace App\Http\Controllers\Game;

use App\Data\Game\GameData;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RollTheDiceGameController extends Controller
{
    public function __invoke(Request $request): \Inertia\Response
    {
        $game = Game::query()->where('slug', 'roll-the-dice')->first();

        return Inertia::render('games/RollTheDice', [
            'game' => GameData::from($game),
        ]);
    }
}
